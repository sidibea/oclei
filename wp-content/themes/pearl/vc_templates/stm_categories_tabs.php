<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = !empty($style) ? $style : 'style_1';

$classes = array('stm_categories_tabs');
$classes[] = 'stm_categories_tabs_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('categories_tabs', $style);
wp_enqueue_script('pearl_categories_tabs');

$posts_number = empty($posts_number) ? 4 : $posts_number;
$image_size = empty($image_size) ? '255x162' : $image_size;
$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
$post_views = !empty($post_views) ? $post_views : 0;
$date = get_the_time('U');
$date = human_time_diff($date, current_time('U')) . ' ago';

$taxonomy = pearl_get_post_type_taxonomy($post_type);
$categories_array = array();
if (!empty($all_tab)) {
	$categories_array[] = array(
		'id'   => '0',
		'name' => 'All',
		'slug' => 'all'
	);
}
$categories = explode(',', $categories);
$args = array(
	'number'     => 4,
	'hide_empty' => false,
	'include'    => $categories
);

$categories_data = get_terms($args);


/** @var $category_data WP_Term */
foreach ($categories as $category_id) {
    foreach ($categories_data as $category_data) {
		if (intval($category_id) === intval($category_data->term_id)) {
			$categories_array[] = array(
				'id'   => $category_data->term_id,
				'name' => $category_data->name,
				'slug' => $category_data->slug
			);
		}
    }
}


$video_label = false;
$video_link = false;


if (!is_wp_error($categories_array) && !empty($categories_array)) : ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <div class="stm_categories_tabs__heading">
			<?php if (!empty($title)) : ?>
                <div class="stm_categories_tabs__title">
                    <h4>
						<?php echo wp_kses_post($title); ?>
                    </h4>
                </div>
			<?php endif; ?>
            <ul class="nav nav-tabs" role="tablist">
				<?php foreach ($categories_array as $category) :
					?>
                    <li role="presentation" <?php if ($category === $categories_array[0]) echo 'class="active"'; ?>>
                        <a href="#<?php echo esc_attr($category['slug']); ?>"
                           data-category-id="<?php echo esc_attr($category['id']); ?>"
                           aria-controls="home" role="tab" data-toggle="tab"
                           class="stm_categories_single mtc_h">
							<?php echo esc_attr($category['name']); ?>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
            <div class="stm_categories_tabs__dropdown dropdown">
                <button class="tbdc" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <span class="fa fa-caret-down"></span>
                </button>
                <ul class="dropdown-menu ttc" aria-labelledby="dLabel">
                </ul>
            </div>
            <div class="stm_categories_tabs__separator tbc_b">

            </div>
        </div>

        <div class="tab-content">
			<?php
			foreach ($categories_array as $category) :
				$args = array(
					'posts_per_page' => $posts_number,
					'post_type'      => $post_type
				);
				if ($category['slug'] != 'all') {
					$args['tax_query'] = array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'term_id',
							'terms'    => array($category['id'])
						)
					);
				}

				$posts = new WP_Query($args);
				?>
                <div role="tabpanel"
                     class="tab-pane fade <?php if ($category === $categories_array[0]) echo 'active in'; ?>"
                     id="<?php echo esc_attr($category['slug']); ?>">
					<?php if ($posts->have_posts()) : ?>
						<?php while ($posts->have_posts()) : $posts->the_post();
							$id = get_the_ID();
							$image = pearl_get_VC_post_img_safe($id, $image_size, 'medium');
							$post_categories = wp_get_post_categories($id, array('fields' => 'all'));
							$post_format = get_post_format($id);

							if ($post_format === 'video') {
								$video_label = esc_html('Video', 'pearl');
								$video_link = get_post_meta($id, 'single_post_video', true);
								if ($video_duration = get_post_meta($id, 'single_post_video_duration', true)) {
									if ($video_duration && $video_duration !== 0) {
										$video_duration = new DateInterval($video_duration);
										if ($video_duration->format('%H') > 0) {
											$video_label = $video_duration->format('%H:%I:%S');
										} else {
											$video_label = $video_duration->format('%I:%S');
										}
									}
								}
							}
							?>
                            <div <?php post_class('single_post'); ?>>
                                <div class="single_post__image">
                                    <a title="<?php the_title(); ?>" class="no_deco" href="<?php the_permalink(); ?>">
										<?php echo wp_kses_post($image); ?>
                                    </a>
									<?php if (!empty($video_label)) : ?>
                                        <div class="video_label mbc_b">
											<?php
											echo wp_kses_post($video_label);
											?>
                                        </div>
									<?php endif; ?>
                                </div>
                                <div class="single_post__body">
                                    <div class="single_post__title">
                                        <h3>
                                            <a title="<?php the_title(); ?>" class="no_deco"
                                               href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="single_post__info">
										<?php if (!is_wp_error($post_categories) && !empty($post_categories)) : ?>
                                            <div class="single_post__categories info__item">
												<?php foreach ($post_categories as $post_category) : ?>
                                                    <a class="ttc_h"
                                                       href="<?php echo esc_attr(get_category_link($post_category->term_id)); ?>">
                                                        <div class="single_post__category">
															<?php echo wp_kses_post($post_category->name); ?>
                                                        </div>
                                                    </a>
												<?php endforeach; ?>
                                            </div>
										<?php endif; ?>
                                        <div class="single_post__date info__item">
                                            <i class="stmicon-magazine-calendar"></i>
											<?php echo wp_kses_post($date); ?>
                                        </div>

										<?php if (comments_open($id)) : ?>
                                            <div class="comments info__item">
                                                <i class="stmicon-magazine-comment"></i>
												<?php echo comments_number(0, 1, '%'); ?>
                                            </div>
										<?php endif; ?>

                                        <div class="single_post__views info__item">
                                            <i class="stmicon-magazine-view"></i>
											<?php echo intval($post_views); ?>
                                        </div>


                                    </div>
                                    <div class="single_post__excerpt">
										<?php echo pearl_minimize_word(get_the_excerpt(), 115); ?>
                                    </div>
                                </div>
                            </div>
						<?php endwhile;
						?>
					<?php endif; ?>
                </div>
				<?php
				wp_reset_query();
			endforeach;
			?>
        </div>
    </div>

<?php endif;