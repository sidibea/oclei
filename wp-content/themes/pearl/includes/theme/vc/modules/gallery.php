<?php
add_action('init', 'pearl_gallery_VC');


function pearl_gallery_VC()
{

	$post_types = pearl_get_post_types();
	$projects_categories = (is_admin()) ? pearl_get_terms_vc('project_category') : array();

	$terms = pearl_autocomplete_terms();

	vc_map(array(
		'name'        => esc_html__('Pearl Gallery', 'pearl'),
		'base'        => 'stm_gallery',
		'icon'        => 'stmicon-post',
		'category'    => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Image gallery grid', 'pearl'),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Link', 'pearl'),
				'param_name' => 'link',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show category', 'pearl'),
				'param_name' => 'category',
				'value'      => $projects_categories,
				'std'        => 'all',
				'dependency' => array(
					'element' => 'source',
					'value'   => 'posts'
				)
			),
			array(
				'type'       => 'autocomplete',
				'heading'    => esc_html__('Select taxonomy', 'pearl'),
				'param_name' => 'taxonomy',
				'settings'   => array(
					'multiple'       => true,
					'sortable'       => true,
					'min_length'     => 1,
					'no_hide'        => true,
					'unique_values'  => true,
					'display_inline' => true,
					'values'         => $terms
				),
				'dependency' => array(
					'element' => 'source',
					'value'   => 'posts'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Select source', 'pearl'),
				'param_name' => 'source',
				'value'      => array(
					esc_html__('Custom images', 'pearl') => 'images',
					esc_html__('Post type', 'pearl')     => 'posts'
				),
				'std'        => 'posts'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Select Post Type', 'pearl'),
				'param_name' => 'post_type',
				'value'      => $post_types,
				'std'        => 'stm_gallery',
				'dependency' => array(
					'element' => 'source',
					'value'   => 'posts'
				),
				'std'        => 'stm_services'
			),
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__('Images', 'pearl'),
				'param_name' => 'images',
				'value'      => urlencode(json_encode(array(
					array(
						'label'       => esc_html__('Images Category', 'pearl'),
						'admin_label' => true
					),
					array(
						'label'       => esc_html__('Select images', 'pearl'),
						'admin_label' => false
					),
				))),
				'params'     => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Images category', 'pearl'),
						'param_name'  => 'category',
						'admin_label' => true,
					),
					array(
						'type'        => 'attach_images',
						'heading'     => esc_html__('Select images', 'pearl'),
						'param_name'  => 'images_array',
						'admin_label' => false,
					),
				),
				'dependency' => array(
					'element' => 'source',
					'value'   => 'images'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Show number', 'pearl'),
				'param_name' => 'number',
				'std'        => 9
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable "Load more button"', 'pearl'),
				'param_name' => 'load_more_button',
				'std'        => 'true'
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image size', 'pearl'),
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
				'param_name'  => 'img_size',
				'value'       => '350x240',
				'std'         => '350x240'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Fullwidth', 'pearl'),
				'param_name' => 'fullwidth',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'enable',
					esc_html__('Disable', 'pearl') => 'disable',
				),
				'std'        => 'disable'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable masonry', 'pearl'),
				'param_name' => 'masonry',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'enable',
					esc_html__('Disable', 'pearl') => 'disable',
				),
				'std'        => 'disable'
			),
			pearl_load_styles(10, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Gallery extends WPBakeryShortCode
	{


	}

	class Pearl_Masonry_Gallery
	{
		public $categories = array();
		public $show_filter = false;
		public $images_array = array();
		public $load_more = false;
		public $link_classes = array('js_active_switcher__a ttc no_deco mbc_h wtc_h text-transform');
		public $gallery_id;
		public $masonry_sizes = array();
		public $atts;
		public $gallery;
		public $taxonomy = 'project_category';
		public $sizes = array();
		public $cell_counter = 0;
		public $row_counter = 0;
		public $images_cell_counter = 0;
		public $last_double_height = 0;
		public $last_double_width = 0;
		public $used_sizes = array();

		function __construct($gallery_instance)
		{
			/**
			 * @var $gallery_instance WPBakeryShortCode_Stm_Gallery
			 */

			$this->gallery = $gallery_instance;
			$this->atts = vc_map_get_attributes($this->gallery->getShortcode(), $this->gallery->getAtts());
			$this->gallery_id = 'stm_projects_grid_' . pearl_random();
			$this->img_size_array = explode('x', $this->atts['img_size']);
		}


		function load_gallery_scripts()
		{
			wp_enqueue_script('imagesloaded');
			wp_enqueue_script('isotope.js');
		}

		function load_gallery_styles()
		{
			pearl_add_element_style('projects_grid');
			pearl_add_element_style('projects_carousel');
			pearl_add_element_style('gallery', $this->atts['style']);
		}

		function get_gallery_classes()
		{


			$classes = array('stm_projects_grid');
			$classes[] = 'stm_projects_grid__loading stm_preloader__element';
			$classes[] = 'js_trigger__unit js_trigger__unit_class';
			$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($this->atts['css'], ' '));
			$classes[] = $this->gallery->getCSSAnimation($this->atts['css_animation']);
			$classes[] = 'stm_lightgallery';
			$classes[] = ($this->atts['fullwidth'] === 'enable') ? 'active' : 's';


			return $classes;
		}

		function get_gallery_id()
		{
			return $this->gallery_id;
		}

		function get_image_size($id)
		{
			$class = '';

			if ($this->atts['masonry'] === 'enable') {
				$first_row = ($this->row_counter + 2) % 3 === 0;
				$second_row = ($this->row_counter + 1) % 3 === 0;
				$third_row = ($this->row_counter) % 3 === 0;


				$image = wp_get_attachment_metadata($id);

				$image_width = $image['width'];
				$image_height = $image['height'];


				$size = explode('x', $this->atts['img_size']);

				foreach ($size as $size_key => $size_value) {
					$size[$size_key] = intval($size_value);
				}


				$double_width = $size[0] * 2 + 30 . 'x' . $size[1];
				$double_height = $size[0] . 'x' . ($size[1] * 2 + 30);
				$normal_size = $size[0] . 'x' . $size[1];

				$sizes_array = array(
					$normal_size,
					$double_height,
					$double_width
				);

				shuffle($sizes_array);


				foreach ($sizes_array as $size_val) {


					if (
						$third_row && $size_val === $double_width ||
						$second_row && $size_val === $double_height
					) {
						continue;
					}
					$used_sizes_count = array_count_values($this->used_sizes);


					if ($size_val === $normal_size) {
						if (isset($used_sizes_count[$normal_size]) && $used_sizes_count[$normal_size] === 5) continue;
					} else {
						if ($size_val === $double_height && $image_height < $size[1] * 2 + 30) {
							continue;
						}

						if ($size_val === $double_width && $image_width < $size[0] * 2 + 30) {
							continue;
						}
						if (in_array($size_val, $this->used_sizes)) continue;
					}


					$size = $size_val;
					$this->used_sizes[] = $size;
					break;
				}

				if ($this->cell_counter === 8) {
					$this->used_sizes = array();
					$this->cell_counter = 1;
				}

				$this->cell_counter += 1;
				$this->row_counter += 1;

				$class = 'width-1';

				if ($size === $double_width) {
					$this->cell_counter += 1;
					$this->row_counter += 1;
					$class = 'width-2';
				}

			} else {
				$size = $this->atts['img_size'];
			}


			return array($size, $class);
		}

		function get_image($id)
		{

			$class = '';
			if ($this->atts['masonry'] === 'enable') {
				$image = pearl_get_VC_img($id, 'full');
			} else {
				$image = pearl_get_VC_img($id, $this->atts['img_size']);
			}

			return array($image, $class);
		}

		function get_categories()
		{
			if ($this->atts['source'] === 'posts') {
				$this->taxonomy = pearl_get_post_type_taxonomy($this->atts['post_type']);
				if (empty($this->atts['taxonomy'])) {
					$terms = get_terms(array(
						'taxonomy'   => $this->taxonomy,
						'hide_empty' => false,
					));
				} else {
					$terms = array();
					foreach (explode(',', $this->atts['taxonomy']) as $tax_val => $tax_key) {
						$terms[] = get_term($tax_key);
					}
				}

				$this->show_filter = !is_wp_error($terms) && !empty($terms) && $this->atts['category'] === 'all';

				if ($this->show_filter) {
					foreach ($terms as $term) {
						$this->categories[] = array(
							'name' => $term->name,
							'slug' => $term->slug
						);
					}
				}
			} elseif ($this->atts['source'] === 'images') {
				$images = $this->atts['images'];

				$images = vc_param_group_parse_atts($images);


				foreach ($images as $image) {
					if (isset($image['images_array'])) {
						$images_ids = explode(',', $image['images_array']);

						foreach ($images_ids as $key => $id) {

							if (isset($images_array[$id])) {
								array_push($images_array[$id]['cat'], sanitize_title($image['category']));
							} else {
								$image_category = (!empty($image['category'])) ? $image['category'] : '';
								$images_array[$id] = array(
									'id'  => $id,
									'alt' => get_post_meta($id, '_wp_attachment_image_alt', true),
									'cat' => array(sanitize_title($image_category))
								);
							}
						}
					}

					$categories[] = (!empty($image['category'])) ? $image['category'] : '';
				}

				$categories = array_filter($categories);

				$this->images_array = array_merge($images_array);
				if (!empty($this->atts['number']) && $this->atts['number'] !== '-1' && count($this->images_array) > $this->atts['number']) {
					$this->load_more = true;
				}

				if (!empty($categories)) {
					$this->show_filter = true;
				}


				$this->categories = $categories;
			}
		}

		function get_gallery_from_posts()
		{

			$post_type = $this->atts['post_type'];
			$number = (!empty($this->atts['number'])) ? $this->atts['number'] : pearl_posts_per_page();
			$category = $this->atts['category'];


			$args = array(
				'post_type'      => $post_type,
				'posts_per_page' => $number,
				'post_status'    => 'publish'
			);


				if (!empty($this->atts['taxonomy'])) {
					$args['tax_query'][] = array(
						'taxonomy' => $this->taxonomy,
						'field'    => 'term_id',
                        'terms' => explode(',', $this->atts['taxonomy'])
					);
                } else {
					if ($this->atts['category'] !== 'all') {
						$args['tax_query']['terms'] = intval($category);
					}
				}
			$q = new WP_Query($args);

			if ($q->have_posts()) {
				if ($number !== '-1') {
					$this->load_more = $q->found_posts > $number;
				}
				while ($q->have_posts()): $q->the_post();
					pearl_load_vc_element('projects', $this->atts, $this->atts['style']);
				endwhile;
				wp_reset_postdata();
			}
		}

		function get_gallery_from_custom_images()
		{
			wp_enqueue_style('lightgallery');
			wp_enqueue_script('lightgallery.js');


			$i = 1;
			foreach ($this->images_array as $key => $image_item) :
				$image_classes = 'stm_projects_carousel__item stm_projects_carousel__custom_image stm_loop__grid stm_lightgallery__selector ';
				$image_classes .= 'project_category-' . esc_attr(implode(' project_category-', $image_item['cat']));
				$image_data = $this->get_image($image_item['id']);
				$image = $image_data[0];
				$image_classes .= ' ' . $image_data[1];
				$image_item['alt'] = get_the_title($image_item['id']);

				if ($this->load_more && $i > $this->atts['number']) {
					$image = str_replace('srcset=', 'data-srcset=', $image);
					$image = str_replace('src=', 'data-src=', $image);
					$image_classes .= ' stm_projects_carousel__item_preloaded';
				}
				if (empty($image)) continue; ?>

                <a href="<?php echo esc_url(wp_get_attachment_image_url($image_item['id'], 'full')) ?>"
                   class="<?php echo esc_attr($image_classes) ?>"
                   target="_self"
                   title="<?php echo esc_attr($image_item['alt']) ?>">

					<?php echo html_entity_decode($image); ?>

                    <span class="stm_projects_carousel__overlay">
						<i class="stmicon-zoom-in"></i>
						<span data-title="<?php echo esc_attr($image_item['alt']) ?>"></span>
					</span>
                </a>
				<?php
				$i += 1;
			endforeach;
		}


		function get_gallery_navigation()
		{

			if (!empty($this->atts['link'])) {
				$link = vc_build_link($this->atts['link']);
				if (empty($link['target'])) $link['target'] = '_self';
			}
			$category = $this->atts['category'];
			?>
            <div class="stm_flex stm_flex_center stm_flex_last stm_mgb_40">
				<?php if (!empty($this->atts['title'])): ?>
                    <div
                            class="heading_font stm_gallery_masonry__title"><?php echo sanitize_text_field($this->atts['title']); ?></div>
				<?php endif; ?>
				<?php if ($this->show_filter): ?>
                    <ul class="list-unstyled stm_projects_grid__sorting js_active_switcher">
                        <?php if (empty($this->atts['taxonomy']) && $this->atts['category'] === 'all') : ?>
                        <li class="stm_projects_carousel__tab">
                            <a href="#"
                               data-category="*"
                               class="active <?php echo esc_attr(implode(' ', $this->link_classes)); ?>">
								<?php esc_html_e('All', 'pearl'); ?>
                            </a>
                        </li>
                        <?php endif; ?>

						<?php foreach ($this->categories as $category_item):

							if ($this->atts['source'] === 'images') {
								$category_name = $category_slug = $category_item;
							} else {
								$category_slug = $category_item['slug'];
								$category_name = $category_item['name'];
							}
							?>
                            <li class="stm_projects_carousel__tab">
                                <a href="#"
                                   data-category=".<?php echo sanitize_title($this->taxonomy) . '-' . sanitize_title($category_slug); ?>"
                                   class="stm_mgl_30 <?php echo esc_attr(implode(' ', $this->link_classes)); ?>">
									<?php echo sanitize_text_field($category_name) ?>
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php endif;
				?>


				<?php if ($category !== 'all' && $this->atts['source'] === 'posts'):
					$term = get_term($category, 'project_category');

					?>
                    <div class="stm_projects_carousel__tab">
                        <a href="#"
                           class="unclickable active <?php echo esc_attr(implode(' ', $this->link_classes)); ?>">
							<?php echo sanitize_text_field($term->name); ?>
                        </a>
                    </div>
				<?php endif; ?>

                <div class="stm_gallery__btns">
					<?php if (!empty($link['url']) and !empty($link['title'])): ?>
                        <a href="<?php echo esc_url($link['url']) ?>"
                           class="stm_gallery_masonry__link"
                           title="<?php echo esc_attr($link['title']) ?>"
                           target="<?php echo esc_attr($link['target']) ?>">
							<?php echo esc_attr($link['title']) ?>
                        </a>
					<?php endif; ?>
                    <a href="#" class="stm_projects_grid__switcher js_trigger__click" data-toggle="false">
                        <i class="fa fa-arrow-left left"></i>
                        <i class="fa fa-arrow-right right"></i>
                    </a>
                </div>
            </div>
			<?php
		}

		function get_gallery_images()
		{

			$classes = $this->get_gallery_classes();
			$source = $this->atts['source'];
			?>
            <div id="<?php echo uniqid(); ?>" class="stm_loop <?php echo esc_attr(implode(' ', $classes)); ?>">
				<?php
				if ($source === 'posts') {

					$this->get_gallery_from_posts();
				} elseif ($source === 'images') {
					$this->get_gallery_from_custom_images();
				}
				?>
            </div>
			<?php
		}

		function print_gallery_script()
		{
			?>
            <script type="text/javascript">
                (function ($) {
                    "use strict";

                    $(document).ready(function () {

                        var removeButton = false;

                        var projects = '#<?php echo esc_js($this->gallery_id); ?>';
                        var $projects_archive = $(projects + ' .stm_projects_grid');
                        var projects_sorting = projects + ' .stm_projects_grid__sorting';
                        var project = '.stm_projects_carousel__item';
                        var button = projects + '.stm_projects_grid__posts .btn_load';
                        var buttonLoadImages = projects + '.stm_projects_grid__images .btn_load';
                        var isotopeOptions = {};
                        var preloadedImages = [];
                        var loadMore = '<?php echo esc_js($this->load_more) ?>';
                        var gallery = $(projects).find('.stm_lightgallery');




                        if (loadMore) {
                            $(projects + ' .stm_projects_carousel__item_preloaded').each(function () {
                                preloadedImages.push(this);
                                $(this).remove();
                            });
                        }
                        $('.stm_projects_grid__sorting li:first-child a').addClass('active');

						<?php if ($this->atts['masonry'] === 'enable') : ?>
                        isotopeOptions.masonry = {
                            columnWidth: '.stm_projects_carousel__item',
                        };
						<?php endif; ?>

                        projects_grid();

                        function projects_grid() {
                            $projects_archive.imagesLoaded({}, function () {
                                    $projects_archive.find(project).removeClass('loading');
                                    $projects_archive.removeClass('stm_projects_grid__loading');
                                    $projects_archive.isotope(isotopeOptions);

                                    $(button).removeClass('loading');

                                    if (removeButton) $(button).slideUp('fast', function () {
                                        $(this).remove()
                                    });
                                }
                            );
                        }

                        var vc_tabs = $projects_archive.parents('.vc_tta-tabs');

                        if (vc_tabs.length) {
                            var vc_tab = vc_tabs.find('.vc_tta-tab');
                            vc_tab.click(function() {
                                projects_grid();
                            })
                        }

                        $(projects_sorting + ' a').on('click', function (e) {
                            e.preventDefault();
                            var category = $(this).data('category');

                            if (category == '*') {
                                $(button).show();
                            } else {
                                $(button).hide();
                            }

                            $projects_archive.isotope({
                                filter: category,
                            }).isotope('layout');
                        });

                        $('body').on('click', button, function (e) {
                            e.preventDefault();

                            var offset = $(this).attr('data-offset');
                            var number = $(this).attr('data-number');
                            var img_size = $(this).attr('data-size');
                            var category = $(this).attr('data-category');
                            var tax = $(this).attr('data-taxonomy');
                            var path = $(this).attr('data-path');
                            var style = $(this).attr('data-style');

                            $.ajax({
                                url: stm_ajaxurl,
                                dataType: 'json',
                                context: this,
                                data: {
                                    'offset': offset,
                                    'number': number,
                                    'img_size': img_size,
                                    'category': category,
                                    'style': style,
                                    'taxonomy': tax,
                                    'path': path,
                                    'post_type': '<?php echo esc_js($this->atts['post_type']) ?>',
                                    'action': 'pearl_load_post_type_gallery'
                                },
                                beforeSend: function () {
                                    $(this).addClass('loading');
                                },
                                complete: function (data) {
                                    var dt = data.responseJSON;
                                    var $items = $(dt.content);

                                    $projects_archive.append($items).isotope('appended', $items, false);

                                    projects_grid();
                                    stm_light_gallery(true);

                                    if (dt.offset) {
                                        $(this).attr('data-offset', dt.offset);
                                    } else {
                                        removeButton = true;
                                    }
                                }
                            });
                        });

                        $('body').on('click', buttonLoadImages, function (e) {

                            $(buttonLoadImages).addClass('loading');
                            $projects_archive.find(project).removeClass('loading');
                            $projects_archive.removeClass('stm_projects_grid__loading');
                            var number = $(this).data('number');
                            var images = preloadedImages.splice(0, number);


                            images.forEach(function (el) {
                                var image = $(el).find('img');
                                image.attr('src', image.data('src'));
                                image.attr('srcset', image.data('srcset'));
                            });

                            $projects_archive.append(images).imagesLoaded({}, function () {
                                $('.stm_projects_carousel__item_preloaded').each(function () {
                                    $(this).removeClass('stm_projects_carousel__item_preloaded');
                                });
                                $projects_archive.isotope('appended', images, false);
                                $projects_archive.isotope(
                                    {
                                        masonry: {
                                            columnWidth: 0
                                        }
                                    }
                                ).isotope('layout');
                                stm_light_gallery(true);
                                $(buttonLoadImages).removeClass('loading');
                            });

                            if (preloadedImages.length < 1) {
                                $(buttonLoadImages).hide('fast', function () {
                                    $(this).remove();
                                });
                            }
                        });

                        $('.stm_projects_grid__switcher').on('click', function (e) {
                            e.preventDefault();

                            wide_projects(this);

                            projects_grid();
                        });

                        function wide_projects(__this) {

                            var windowWidth = $(window).outerWidth() - (stm_site_paddings * 2);
                            var projectsWidth = $(projects).outerWidth();

                            var wide = $(__this).hasClass('active');


                            if (!wide) {
                                $($projects_archive).css({
                                    'width': windowWidth + 'px',
                                    'margin-left': -((windowWidth - projectsWidth) / 2) + 'px'
                                });
                            } else {
                                $($projects_archive).css({
                                    'width': (projectsWidth + 30) + 'px',
                                    'margin': '0 -15px'
                                });
                            }


                            setTimeout(function () {
                                $projects_archive.isotope();
                            }, 300);


                        }

						<?php if($this->atts['fullwidth'] == 'enable'): ?>
                        $('.stm_projects_grid__switcher').trigger('click').addClass('active');
						<?php endif; ?>

                    })
                })
                (jQuery);
            </script>
			<?php
		}


		function print_gallery()
		{
			$this->get_categories();
			$this->load_gallery_scripts();
			$this->load_gallery_styles();

			$classes = $this->get_gallery_classes();


			$id = $this->get_gallery_id();
			$style = $this->atts['style'];
			$category = $this->atts['category'];
			$number = (!empty($this->atts['number'])) ? $this->atts['number'] : pearl_posts_per_page();
			$img_size = $this->atts['img_size'];

			?>

            <div id="<?php echo esc_attr($id); ?>"
                 class="js_trigger stm_projects_grid_<?php echo esc_attr($style); ?> stm_projects_grid__<?php echo esc_attr($this->atts['source']) ?>">
				<?php
				$this->get_gallery_navigation();
				$this->get_gallery_images();
				if (empty($this->atts['load_more_button'])) {
					$this->load_more = false;
				}
				?>
				<?php if ($this->load_more): ?>
                    <div class="text-center stm_mgt_20 stm_mgb_10">
                        <a href="#"
                           class="btn btn_primary btn_outline btn_load"
                           data-size="<?php echo sanitize_text_field($img_size); ?>"
                           data-number="<?php echo intval($number) ?>"
                           data-style="<?php echo esc_js($style) ?>"
                           data-category="<?php echo sanitize_title($category); ?>"
                           data-taxonomy="<?php echo sanitize_text_field($this->taxonomy); ?>"
                           data-path="projects"
                           data-offset="<?php echo intval($number) ?>">
                            <span><?php esc_html_e('Load more', 'pearl'); ?></span>
                        </a>
                    </div>
				<?php endif; ?>
            </div>
			<?php
			$this->print_gallery_script();
		}
	}
}