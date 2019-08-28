<?php
$layouts_pages = pearl_pli_get_pages();
?>

<div class="pearl_add_pli__pages_overlay"></div>
<div class="pearl_add_pli__pages">
    <div id="pearl-pli-import">
        <div class="pearl-pli-head">
            <h3>Select a demo to view the pages you can import</h3>
        </div>
        <div class="pearl-pli-content">
            <div class="pearl-pli-layout">
                <select name="pearl_pli_layout">
                    <?php foreach($layouts_pages as $layout => $page): ?>
                        <option value="<?php echo sanitize_title(esc_attr($layout)); ?>">
                            <?php echo esc_attr(ucfirst(str_replace(array('_', 'medicall'), array(' ', 'medical'), $layout))); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <p>
                    <?php esc_html_e('Importing a single demo page is to receive the skeleton layout only. Please note you will not receive demo images or sliders so there will be differences in style and layout compared to the online demos. The items that import are the builder layout, page template, pearl page options and image placeholders from unsplash photostock. If you wish to import everything from a demo, you need to import the full demo on the Pearl > Demo Import tab. The content of the current page will be replaced after the page import. Page settings will be changed with the settings of the imported page.', 'pearl'); ?>
                </p>

                <div class="pearl-pli-layout-pages">
                    <?php
                    $images_path = 'https://stylemixthemes.scdn2.secure.raxcdn.com/mockups/page_importer/';
                    foreach($layouts_pages as $layout => $pages):
                        $active = ($layout == 'business') ? 'active' : '';
                        if(empty($pages)) continue;
                        $pages = array_keys($pages);
						$image_num = 0;
                        ?>
                        <div class="pearl-pli-layout-page <?php echo esc_attr($active); ?>"
                             id="<?php echo sanitize_title(esc_attr($layout)); ?>">
                            <?php foreach($pages as $page):
								$image_num++; ?>
                                <div class="pearl-pli-select_page"
                                     data-layout="<?php echo esc_attr($layout); ?>"
                                     data-page="<?php echo esc_attr($page); ?>">
                                    <div class="pearl_pli_img_preview">
                                        <img src="<?php echo "{$images_path}{$layout}/{$image_num}" ?>.jpg">
                                    </div>
                                    <span><?php echo esc_attr(ucfirst(str_replace('-', ' ', $page))); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>