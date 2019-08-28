<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_staff_tabs');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

pearl_add_element_style('staff_tabs');
wp_enqueue_script('isotope.js');


$image_size = !empty($image_size) ? $image_size : '255x180';

$args = array(
	'post_type'      => 'stm_staff',
	'posts_per_page' => -1
);

$staff_query = new WP_Query($args);
$staff_posts = array();
$categories = array('All');

$staff_output = '';


$unique_class = uniqid('stm_staff__tabs_containers');
$classes[] = $unique_class;

if ($staff_query->have_posts()) :
	?>
    <div class="stm_staff__tabs_<?php echo esc_attr($style); ?>">
        <div class="stm_staff__tabs">
            <a href="#" class="staff_sort sbc_a active"
               data-sort="all"><?php echo esc_html__('All', 'pearl'); ?></a>
			<?php
			while ($staff_query->have_posts()) :
				$staff_query->the_post();
				$id = get_the_ID();
				$post_categories = get_the_terms($id, 'staff_categories');
				$staff_photo_id = get_post_meta($id, 'staff_photo', true);
				$staff_photo = pearl_get_VC_attachment_img_safe($staff_photo_id, $image_size, 'medium');
				$staff_name = get_post_meta($id, 'staff_name', true);
				$staff_position = get_post_meta($id, 'staff_position', true);
				$staff_info = get_post_meta($id, 'staff_info', true);

				//$post_categories_names = array_map(create_function('$obj', 'return $obj->name;'), $post_categories);
				//$post_categories_slugs = array_map(create_function('$obj', 'return $obj->slug;'), $post_categories);

				if(!empty($post_categories)) {
					$post_categories_names = wp_list_pluck($post_categories, 'name');
					$post_categories_slugs = wp_list_pluck($post_categories, 'slug');
					$post_categories_slugs[] = 'all';
					foreach ($post_categories_names as $category_key => $category_name) {
						if (!in_array($category_name, $categories)) {
							$categories[] = $category_name;
							?>
                            <a href="#" class="staff_sort sbc_a"
                               data-sort="<?php echo sanitize_title($category_name); ?>"><?php echo esc_html($category_name); ?></a>
							<?php
						}
					}
				}

				$staff_output .= "<div class='staff__item' data-category='" . implode(' ', $post_categories_slugs) . "'>";
				$staff_output .= $staff_photo;
				$staff_output .= "<div class='staff_name heading_font'>{$staff_name}</div>";
				$staff_output .= "<div class='staff_position'>{$staff_position}</div>";
				$staff_output .= "<div class='staff_info'>{$staff_info}</div>";
				$staff_output .= '</div>';

			endwhile;
			?>
        </div>
        <div class="stm_staff__tabs_containers <?php echo esc_attr($unique_class); ?>">
			<?php
			//        echo $staff_output;
			echo wp_kses($staff_output, array(
				'div' => array(
					'class'         => array(),
					'data-category' => array()
				),
				'img' => array(
					'src'    => array(),
					'srcset' => array(),
					'class'  => array(),
					'width'  => array(),
					'height' => array(),
					'alt'    => array(),
					'title'  => array()
				),
			));
			?>
            <script>
                (function ($) {
                    $(document).ready(function () {
                        var grid = $('.<?php echo esc_js($unique_class); ?>');
                        var sortButton = $('.staff_sort');

                        grid.isotope({
                            itemSelector: '.staff__item',
                            layoutMode: 'fitRows',
                            getSortData: {
                                category: '[data-category]'
                            },
                        });

                        sortButton.each(function () {
                            $(this).click(function (e) {
                                e.preventDefault();
                                var sortVal = $(this).data('sort');
                                grid.isotope({
                                    filter: function () {
                                        var cat = $(this).data('category');
                                        cat = cat.split(' ');
                                        return $.inArray(sortVal, cat) !== -1;
                                    }
                                })
                            })
                        })

                        $('.stm_staff__tabs').each(function (i, buttonGroup) {
                            var $buttonGroup = $(buttonGroup);
                            $buttonGroup.on('click', '.staff_sort', function () {
                                $buttonGroup.find('.active').removeClass('active');
                                $(this).addClass('active');
                            });
                        });
                    })
                })(jQuery)
            </script>
        </div>
    </div>
	<?php
endif;


wp_reset_query();