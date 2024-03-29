<?php

if (isset($_GET['dsm'])) {
    delete_option('stm_fonts');
    delete_option('stm_fonts_layout');
}


if (!class_exists('STM_Custom_Icons')) {
    class STM_Custom_Icons
    {
        var $paths = array();
        var $svg_file;
        var $json_file;
        var $vc_fonts;
        var $vc_fonts_dir;
        var $font_name = 'unknown';
        var $svg_config = array();
        var $json_config = array();
        static $iconlist = array();

        function __construct()
        {
            $this->paths = wp_upload_dir();
            $this->paths['fonts'] = 'stm_fonts';
            $this->paths['temp'] = trailingslashit($this->paths['fonts']) . 'stm_temp';
            $this->paths['fontdir'] = trailingslashit($this->paths['basedir']) . $this->paths['fonts'];
            $this->paths['tempdir'] = trailingslashit($this->paths['basedir']) . $this->paths['temp'];
            $this->paths['fonturl'] = set_url_scheme(trailingslashit($this->paths['baseurl']) . $this->paths['fonts']);
            $this->paths['tempurl'] = trailingslashit($this->paths['baseurl']) . trailingslashit($this->paths['temp']);
            $this->paths['config'] = 'charmap.php';
            $this->vc_fonts = trailingslashit($this->paths['basedir']) . $this->paths['fonts'] . '/stmicons';
            $this->vc_fonts_dir = get_template_directory() . '/assets/fonts/stmicons/';
            add_action('wp_ajax_stm_ajax_add_zipped_font', array($this, 'add_zipped_font'));
            add_action('wp_ajax_stm_ajax_remove_zipped_font', array($this, 'remove_zipped_font'));
            $defaults = get_option('stm_fonts');

            if (!$defaults) {
                add_action('admin_init', array($this, 'STM_move_fonts'));
            }
        }

        function admin_scripts()
        {
            wp_enqueue_script('stm-admin-media', STM_CONFIGURATIONS_URL . 'assets/js/admin-media.js', array('jquery'), '1.1');
            wp_enqueue_script('media-upload');
            wp_enqueue_media();
            wp_enqueue_style('stm-icon-manager-admin', STM_CONFIGURATIONS_URL . 'assets/css/icon-manager-admin.css');
            $this->enqueue_admin_scripts();
			$this->enqueue_admin_scripts('stm_fonts_layout');
        }

        function enqueue_admin_scripts($option = 'stm_fonts') {
			$upload_paths = wp_upload_dir();
			$custom_fonts = get_option($option);
			if (is_array($custom_fonts)) {
				foreach ($custom_fonts as $font => $info) {
					if (strpos($info['style'], 'http://') !== false) {
						wp_enqueue_style('stm-' . $font, $info['style'], null, '1.0', 'all');
					} else {
						wp_enqueue_style('stm-' . $font, trailingslashit($upload_paths['baseurl'] . '/stm_fonts/') . $info['style'], null, '1.0', 'all');
					}
				}
			}
        }

        function icon_manager_dashboard()
        {
            ?>
            <div class="wrap">
            <h2>
                <?php esc_html_e('Pearl Custom Icons', 'stm_domain'); ?>
                <a href="#stm_upload_icon" class="add-new-h2 stm_upload_icon" data-target="iconfont_upload"
                   data-title="<?php echo esc_html__("Upload/Select Fontello Font Zip", "stm-configurations") ?>"
                   data-type="application/octet-stream, application/zip"
                   data-button="<?php echo esc_html__("Insert Fonts Zip File", "stm-configurations"); ?>"
                   data-trigger="stm_insert_zip"
                   data-class="media-frame ">
                    <?php esc_html_e('Upload New Icons', 'stm_domain'); ?>
                </a> &nbsp;<span class="spinner"></span></h2>
            <div id="msg"></div>
            <?php
            $fonts = get_option('stm_fonts');
            if (is_array($fonts)) :
                ?>

                <?php $this->get_font_set(); ?>
                </div>
            <?php else: ?>
                <div class="error">
                    <p>
                        <?php esc_html_e('No font icons uploaded. Upload some font icons to display here.', 'stm_domain'); ?>
                    </p>
                </div>
                <?php
            endif;
        }

        // Generate Icon Set Preview and settings page
        function get_font_set($option = 'stm_fonts')
        {
            $fonts = get_option($option);

            if(!empty($fonts)) {
				foreach ($fonts as $font => $info) {
					$icon_set = array();
					$upload_dir = wp_upload_dir();
					$url = trailingslashit($upload_dir['baseurl']);
					$basedir = trailingslashit($upload_dir['basedir']);

					/*Read json and get fontprefix*/
					global $wp_filesystem;

					if (empty($wp_filesystem)) {
						require_once ABSPATH . '/wp-admin/includes/file.php';
						WP_Filesystem();
					}

					$json_file = $basedir . $info['include'] . '/' . 'selection.json';
					$json_file = json_decode($wp_filesystem->get_contents($json_file), true);

					$set_name = $json_file['metadata']['name'];
					$font_prefix = $json_file['preferences']['fontPref']['prefix'];

					if(empty($json_file['icons'])) continue;

					foreach ($json_file['icons'] as $icon) {
						$icon_set[$set_name][] = $font_prefix . $icon['properties']['name'];
					}

					$output = '<div class="icon_set-' . $font . ' metabox-holder">';
					$output .= '<div class="postbox">';


					if ($font == 'stmicons') {
						$output .= '<h3 class="icon_font_name"><strong>' . esc_html__('Default Icons', 'stm_domain') . '</strong>';
					} elseif (strpos($font, 'stmicons_') !== false) {
						$output .= '<h3 class="icon_font_name"><strong>' . esc_html(ucfirst(str_replace('stmicons_', '', $font))) . '</strong>';
						if (empty($info['enabled'])) {
							$output .= '<button class="button button-primary button-small stm_layout_font_enabler" data-font=' . esc_attr($font) . ' data-title="' . esc_attr__('Enable Icon Set', 'stm_domain') . '">' . esc_html__('Enable Icon Set', 'stm_domain') . '</button>';
						} else {
							$output .= '<button class="button button-secondary button-small stm_layout_font_enabler" data-font=' . esc_attr($font) . ' data-title="' . esc_attr__('Disable Icon Set', 'stm_domain') . '">' . esc_html__('Disable Icon Set', 'stm_domain') . '</button>';
						}
					} else {
						$output .= '<h3 class="icon_font_name"><strong>' . esc_html(ucfirst($font)) . '</strong>';
						$output .= '<button class="button button-secondary button-small stm_del_icon" data-delete=' . esc_attr($font) . ' data-title="' . esc_attr__('Delete Icon Set', 'stm_domain') . '">' . esc_html__('Delete Icon Set', 'stm_domain') . '</button>';
					}

					$output .= '</h3>';
					$output .= '<div class="inside"><div class="icon_actions">';
					$output .= '</div>';
					$output .= '<div class="icon_search"><ul class="icons-list fi_icon">';
					foreach ($icon_set as $icons) {
						foreach ($icons as $icon) {
							$output .= '<li>';
							$output .= '<i class="' . esc_attr($icon) . '"></i><label class="icon">' . esc_html($icon) . '</label></li>';
						}
					}
					$output . '</ul>';
					$output .= '</div><!-- .icon_search-->';
					$output .= '</div><!-- .inside-->';
					$output .= '</div><!-- .postbox-->';
					$output .= '</div><!-- .icon_set-' . esc_html($font) . ' -->';
					echo $output;
					if ($font == 'stmicons') {
						$this->STM_layout_fonts();
					}

				}
			}
            $script = '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".search-icon").keyup(function(){
						jQuery(".fonts-count").hide();
						// Retrieve the input field text and reset the count to zero
						var filter = jQuery(this).val(), count = 0;
						// Loop through the icon list
						jQuery(".icons-list li").each(function(){
							// If the list item does not contain the text phrase fade it out
							if (jQuery(this).attr("data-icons-tag").search(new RegExp(filter, "i")) < 0) {
								jQuery(this).fadeOut();
							} else {
								jQuery(this).show();
								count++;
							}
							if(count == 0)
								jQuery(".search-count").html(" ' . esc_js(__('Can\'t find the icon?', 'stm_domain')) . ' <a href=\'#stm_upload_icon\' class=\'add-new-h2 stm_upload_icon\' data-target=\'iconfont_upload\' data-title=\' ' . esc_js(__('Upload/Select Fontello Font Zip', 'stm_domain')) . ' \' data-type=\'application/octet-stream, application/zip\' data-button=\' ' . esc_js(__('Insert Fonts Zip File', 'stm_domain')) . ' \' data-trigger=\'stm_insert_zip\' data-class=\'media-frame\'>' . esc_js(__('Click here to upload', 'stm_domain')) . '</a>");
							else
								jQuery(".search-count").html(count+" ' . esc_js(__('Icons found.', 'stm_domain')) . '");
							if(filter == "")
								jQuery(".fonts-count").show();
						});
					});
				});
			</script>';
            echo $script;
        }

		function STM_layout_fonts() {
            $this->get_font_set('stm_fonts_layout');
		}

		function STM_layouts() {
            $layouts = array(
                'beauty',
                'church',
            );
            return $layouts;
        }

        function add_zipped_font()
        {
            $cap = apply_filters('avf_file_upload_capability', 'update_plugins');
            if (!current_user_can($cap)) {
                die(esc_html__("Using this feature is reserved for Super Admins. You unfortunately don't have the necessary permissions.", "stm-configurations"));
            }
            //get the file path of the zip file
            $attachment = $_POST['values'];
            $path = realpath(get_attached_file($attachment['id']));
            $unzipped = $this->zip_flatten($path, array('\.eot', '\.svg', '\.ttf', '\.woff', '\.json', '\.css'));
            // if we were able to unzip the file and save it to our temp folder extract the svg file
            if ($unzipped) {
                $this->create_config();
            }
            //if we got no name for the font dont add it and delete the temp folder
            if ($this->font_name == 'unknown') {
                $this->delete_folder($this->paths['tempdir']);
                die(esc_html__('Was not able to retrieve the Font name from your Uploaded Folder', 'stm_domain'));
            }
            die(esc_html__('stm_font_added:', 'stm_domain') . $this->font_name);
        }

        function remove_zipped_font()
        {
            //get the file path of the zip file
            $font = $_POST['del_font'];
            $list = self::load_iconfont_list();
            $delete = isset($list[$font]) ? $list[$font] : false;
            if ($delete) {
                $this->delete_folder($delete['include']);
                $this->remove_font($font);
                die(esc_html__('stm_font_removed', 'stm_domain'));
            }
            die(esc_html__('Was not able to remove Font', 'stm_domain'));
        }

        //extract the zip file to a flat folder and remove the files that are not needed
        function zip_flatten($zipfile, $filter)
        {
            if (is_dir($this->paths['tempdir'])) {
                $this->delete_folder($this->paths['tempdir']);
                $tempdir = stm_backend_create_folder($this->paths['tempdir'], false);
            } else {
                $tempdir = stm_backend_create_folder($this->paths['tempdir'], false);
            }
            if (!$tempdir) {
                die(esc_html__('Wasn\'t able to create temp folder', 'stm_domain'));
            }
            $zip = new ZipArchive;
            if ($zip->open($zipfile)) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $entry = $zip->getNameIndex($i);
                    if (!empty($filter)) {
                        $delete = true;
                        $matches = array();
                        foreach ($filter as $regex) {
                            preg_match("!" . $regex . "!", $entry, $matches);
                            if (!empty($matches)) {
                                $delete = false;
                                break;
                            }
                        }
                    }
                    if (substr($entry, -1) == '/' || !empty($delete)) {
                        continue;
                    } // skip directories and non matching files
                    $fp = $zip->getStream($entry);
                    $ofp = fopen($this->paths['tempdir'] . '/' . basename($entry), 'w');
                    if (!$fp) {
                        die(esc_html__('Unable to extract the file.', 'stm_domain'));
                    }
                    while (!feof($fp)) {
                        fwrite($ofp, fread($fp, 8192));
                    }
                    fclose($fp);
                    fclose($ofp);
                }
                $zip->close();
            } else {
                die(esc_html__("Wasn't able to work with Zip Archive", 'stm_domain'));
            }

            return true;
        }

        //iterate over xml file and extract the glyphs for the font
        function create_config()
        {
            $this->json_file = $this->find_json();
            $this->svg_file = $this->find_svg();
            if (empty($this->json_file) || empty($this->svg_file)) {
                $this->delete_folder($this->paths['tempdir']);
                die(esc_html__('selection.json or SVG file not found. Was not able to create the necessary config files', 'stm_domain'));
            }
            //$response 	= wp_remote_get( $this->paths['tempurl'].$this->svg_file );
            $response = wp_remote_fopen(trailingslashit($this->paths['tempurl']) . $this->svg_file);
            //if wordpress wasnt able to get the file which is unlikely try to fetch it old school
            $json = file_get_contents(trailingslashit($this->paths['tempdir']) . $this->json_file);
            if (empty($response)) {
                $response = file_get_contents(trailingslashit($this->paths['tempdir']) . $this->svg_file);
            }
            if (!is_wp_error($json) && !empty($json)) {
                $xml = simplexml_load_string($response);
                $font_attr = $xml->defs->font->attributes();
                $glyphs = $xml->defs->font->children();
                $this->font_name = (string)$font_attr['id'];
                $font_folder = trailingslashit($this->paths['fontdir']) . $this->font_name;
                if (is_dir($font_folder)) {
                    $this->delete_folder($this->paths['tempdir']);
                    die(esc_html__("It seems that the font with the same name is already exists! Please upload the font with different name.", "stm-configurations"));
                }
                $file_contents = json_decode($json);
                if (!isset($file_contents->IcoMoonType)) {
                    $this->delete_folder($this->paths['tempdir']);
                    die(esc_html__('Uploaded font is not from IcoMoon. Please upload fonts created with the IcoMoon App Only.', 'stm_domain'));
                }
                $icons = $file_contents->icons;
                $n = 1;
                foreach ($icons as $icon) {
                    $icon_name = $icon->properties->name;
                    $icon_class = str_replace(' ', '', $icon_name);
                    $icon_class = str_replace(',', ' ', $icon_class);
                    $tags = implode(",", $icon->icon->tags);
                    $this->json_config[$this->font_name][$icon_name] = array(
                        "class" => $icon_class,
                        "tags" => $tags
                    );
                    $n++;
                }
                if (!empty($this->json_config) && $this->font_name != 'unknown') {
                    $this->write_config();
                    $this->re_write_css();
                    $this->rename_files();
                    $this->rename_folder();
                    $this->add_font();
                }
            }

            return false;
        }

        //writes the php config file for the font
        function write_config()
        {
            $charmap = $this->paths['tempdir'] . '/' . $this->paths['config'];
            $handle = @fopen($charmap, 'w');
            if ($handle) {
                fwrite($handle, '<?php $icons = array();');
                foreach ($this->json_config[$this->font_name] as $icon => $info) {
                    if (!empty($info)) {
                        $delimiter = "'";
                        fwrite($handle, "\r\n" . '$icons[\'' . $this->font_name . '\'][' . $delimiter . $icon . $delimiter . '] = array("class"=>' . $delimiter . $info["class"] . $delimiter . ',"tags"=>' . $delimiter . $info["tags"] . $delimiter . ');');
                    } else {
                        $this->delete_folder($this->paths['tempdir']);
                        die(esc_html__('Was not able to write a config file', 'stm_domain'));
                    }
                }
                fclose($handle);
            } else {
                $this->delete_folder($this->paths['tempdir']);
                die(esc_html__('Was not able to write a config file', 'stm_domain'));
            }
        }

        //re-writes the php config file for the font
        function re_write_css()
        {
            $style = $this->paths['tempdir'] . '/style.css';
            $file = @file_get_contents($style);
            if ($file) {
                $str = str_replace('fonts/', '', $file);
                $str = str_replace('.icon {', '[class^="' . $this->font_name . '-"], [class*=" ' . $this->font_name . '-"] {', $str);
                $str = str_replace('i {', '[class^="' . $this->font_name . '-"], [class*=" ' . $this->font_name . '-"] {', $str);

                /* remove comments */
                $str = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $str);

                /* remove tabs, spaces, newlines, etc. */
                $str = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $str);

                @file_put_contents($style, $str);
            } else {
                die(esc_html__('Unable to write css. Upload icons downloaded only from icomoon', 'stm_domain'));
            }
        }

        function rename_files()
        {
            $extensions = array('eot', 'svg', 'ttf', 'woff', 'css');
            $folder = trailingslashit($this->paths['tempdir']);
            foreach (glob($folder . '*') as $file) {
                $path_parts = pathinfo($file);
                if (strpos($path_parts['filename'], '.dev') === false && in_array($path_parts['extension'], $extensions)) {
                    if ($path_parts['filename'] !== $this->font_name) {
                        rename($file, trailingslashit($path_parts['dirname']) . $this->font_name . '.' . $path_parts['extension']);
                    }
                }
            }
        }

        //rename the temp folder and all its font files
        function rename_folder()
        {
            $new_name = trailingslashit($this->paths['fontdir']) . $this->font_name;
            //delete folder and contents if they already exist
            $this->delete_folder($new_name);
            if (rename($this->paths['tempdir'], $new_name)) {
                return true;
            } else {
                $this->delete_folder($this->paths['tempdir']);
                die(esc_html__("Unable to add this font. Please try again.", "stm-configurations"));
            }
        }

        //delete a folder
        function delete_folder($new_name)
        {
            //delete folder and contents if they already exist
            if (is_dir($new_name)) {
                $objects = scandir($new_name);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        unlink($new_name . "/" . $object);
                    }
                }
                reset($objects);
                rmdir($new_name);
            }
        }

        function add_font()
        {
            $fonts = get_option('stm_fonts');
            if (empty($fonts)) {
                $fonts = array();
            }
            $fonts[$this->font_name] = array(
                'include' => trailingslashit($this->paths['fonts']) . $this->font_name,
                'folder' => trailingslashit($this->paths['fonts']) . $this->font_name,
                'style' => $this->font_name . '/' . $this->font_name . '.css',
                'config' => $this->paths['config']
            );
            update_option('stm_fonts', $fonts);
        }

        function remove_font($font)
        {
            $fonts = get_option('stm_fonts');
            if (isset($fonts[$font])) {
                unset($fonts[$font]);
                update_option('stm_fonts', $fonts);
            }
        }

        //finds the json file we need to create the config
        function find_json()
        {
            $files = scandir($this->paths['tempdir']);
            foreach ($files as $file) {
                if (strpos(strtolower($file), '.json') !== false && $file[0] != '.') {
                    return $file;
                }
            }
        }

        //finds the svg file we need to create the config
        function find_svg()
        {
            $files = scandir($this->paths['tempdir']);
            foreach ($files as $file) {
                if (strpos(strtolower($file), '.svg') !== false && $file[0] != '.') {
                    return $file;
                }
            }
        }

        static function load_iconfont_list()
        {
            if (!empty(self::$iconlist)) {
                return self::$iconlist;
            }
            $extra_fonts = get_option('stm_fonts');
            if (empty($extra_fonts)) {
                $extra_fonts = array();
            }
            $font_configs = $extra_fonts;//array_merge(stmBuilder::$default_iconfont, $extra_fonts);
            //if we got any include the charmaps and add the chars to an array
            $upload_dir = wp_upload_dir();
            $path = trailingslashit($upload_dir['basedir']);
            $url = trailingslashit($upload_dir['baseurl']);
            foreach ($font_configs as $key => $config) {
                if (empty($config['full_path'])) {
                    $font_configs[$key]['include'] = $path . $font_configs[$key]['include'];
                    $font_configs[$key]['folder'] = $url . $font_configs[$key]['folder'];
                }
            }
            //cache the result
            self::$iconlist = $font_configs;

            return $font_configs;
        }

        function STM_move_fonts()
        {
            // Make destination directory
            if (!is_dir($this->vc_fonts)) {
                wp_mkdir_p($this->vc_fonts);
            }

            $layouts = array();

            @chmod($this->vc_fonts, 0777);
            foreach (glob($this->vc_fonts_dir . '*') as $file) {
                $new_file = basename($file);
                if(!is_dir($file)) {
					@copy($file, $this->vc_fonts . '/' . $new_file);
				} else {
					if (!is_dir($this->vc_fonts . '/' . $new_file)) {
						wp_mkdir_p($this->vc_fonts . '/' . $new_file);
					}
					foreach (glob($this->vc_fonts_dir . $new_file . '/*') as $layout_file) {
					    $new_layout_file = basename($layout_file);
						@copy($layout_file, $this->vc_fonts . '/' . $new_file . '/' . $new_layout_file);
                    }

                    $layout_icons = array(
						'include' => trailingslashit($this->paths['fonts']) . 'stmicons/' . $new_file,
						'folder' => trailingslashit($this->paths['fonts']) . 'stmicons/' . $new_file,
						'style' => 'stmicons' . '/' . $new_file . '/stmicons' . '.css',
						'config' => $new_file . '/' . $this->paths['config']
					);

					$default_icons = array(
                        'linear',
                        'vicons',
                        'feather',
                        'icomoon'
                    );

					if(in_array($new_file, $default_icons)) {
						$layout_icons['enabled'] = true;
                    }

                     $layouts['stmicons_' . $new_file] = $layout_icons;
                }
            }
            $fonts['stmicons'] = array(
                'include' => trailingslashit($this->paths['fonts']) . 'stmicons',
                'folder' => trailingslashit($this->paths['fonts']) . 'stmicons',
                'style' => 'stmicons' . '/' . 'stmicons' . '.css',
                'config' => $this->paths['config']
            );

            $defaults = get_option('stm_fonts');
            if (!$defaults) {
                update_option('stm_fonts', $fonts);
            }

            $default_layouts = get_option('stm_fonts_layout');
			if (!$default_layouts) {
				update_option('stm_fonts_layout', $layouts);
			}

        }// end STM_move_fonts
    }// End class
    /*
    * creates a folder for the theme framework
    */
    if (!function_exists('stm_backend_create_folder')) {
        function stm_backend_create_folder(&$folder, $addindex = true)
        {
            if (is_dir($folder) && $addindex == false) {
                return true;
            }
            $created = wp_mkdir_p(trailingslashit($folder));
            @chmod($folder, 0777);
            if ($addindex == false) {
                return $created;
            }
            $index_file = trailingslashit($folder) . 'index.php';
            if (file_exists($index_file)) {
                return $created;
            }
            $handle = @fopen($index_file, 'w');
            if ($handle) {
                fwrite($handle, "<?php\r\necho 'Sorry, browsing the directory is not allowed!';\r\n?>
");
                fclose($handle);
            }

            return $created;
        }
    }
    // Instantiate the Icon Manager
    new STM_Custom_Icons;
}

add_action('admin_menu', 'pearl_register_menu', 99);

if (!function_exists('pearl_register_menu')) {
    function pearl_register_menu()
    {
        add_submenu_page(
            'my-pearl',
            esc_html__("Pearl Icon Manager", "stm-configurations"),
            esc_html__("Pearl Icon Manager", "stm-configurations"),
            "manage_options",
            "pearl-icon-manager",
            "stm_custom_icons_menu"
        );
        $STM_Custom_Icons = new STM_Custom_Icons;
        add_action('admin_enqueue_scripts', array($STM_Custom_Icons, 'admin_scripts'));
    }
}

function stm_custom_icons_menu()
{
    $STM_Custom_Icons = new STM_Custom_Icons;
    $STM_Custom_Icons->icon_manager_dashboard();
}

function stm_custom_fonts()
{
    $upload_paths = wp_upload_dir();
    $custom_fonts = get_option('stm_fonts');
    if (is_array($custom_fonts)) {
        foreach ($custom_fonts as $font => $info) {
            if (strpos($info['style'], 'http://') !== false) {
                wp_enqueue_style('stm-' . $font, $info['style'], null, '1.0.1', 'all');
            } else {
                wp_enqueue_style('stm-' . $font, trailingslashit($upload_paths['baseurl'] . '/stm_fonts/') . $info['style'], null, '1.0.1', 'all');
            }
        }
    }

	$custom_layout_fonts = get_option('stm_fonts_layout');
	if (is_array($custom_layout_fonts)) {
		foreach ($custom_layout_fonts as $font => $info) {
		    if(!empty($info['enabled'])) {
				if (strpos($info['style'], 'http://') !== false) {
					wp_enqueue_style('stm-' . $font, $info['style'], null, '1.0.1', 'all');
				} else {
					wp_enqueue_style('stm-' . $font, trailingslashit($upload_paths['baseurl'] . '/stm_fonts/') . $info['style'], null, '1.0.1', 'all');
				}
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'stm_custom_fonts');

function stm_icons_load() {
	$font = sanitize_title($_GET['font']);
	$fonts = get_option('stm_fonts_layout');

	$r = array(
		'text' => esc_html__('Enable icon set', 'pearl'),
		'class' => 'button-primary',
		'r_class' => 'button-secondary',
	);

	if(!empty($fonts) and !empty($fonts[$font])) {
		$current_font = $fonts[$font];
		if(empty($current_font['enabled'])) {
			$r = array(
				'text' => esc_html__('Disable icon set', 'pearl'),
				'class' => 'button-secondary',
				'r_class' => 'button-primary',
			);
			$fonts[$font]['enabled'] = true;
		} else {
			$fonts[$font]['enabled'] = false;
		}
	}

	update_option('stm_fonts_layout', $fonts);

	wp_send_json($r);
}

add_action('wp_ajax_stm_icons_load', 'stm_icons_load');