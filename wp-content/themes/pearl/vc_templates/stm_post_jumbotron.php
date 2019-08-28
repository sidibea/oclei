<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$offset = 0;

$classes = array();
$classes[] = 'stm_post_jumbotron stm_post_jumbotron_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$jumbo_styles = array();

pearl_add_element_style('post_jumbotron', $style);


$post = get_post($post);
$post_id = $post->ID;
$image = get_the_post_thumbnail_url($post->ID);
$unique_id = uniqid('stm_post_jumbotron_');



if (!empty($post)) :
	$categories = wp_get_post_categories($post_id, array('fields' => 'all')); ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php if ($bgc) : ?>
            <div class="overlay" style="background-color: <?php echo esc_attr($bgc); ?>;">

            </div>
		<?php endif; ?>

		<?php if ($image): ?>
            <div class="background-image" style="background-image: url(<?php echo esc_attr($image); ?>);"></div>
		<?php endif; ?>

        <a class="no_deco" href="<?php the_permalink($post_id); ?>" title="<?php the_title($post_id); ?>">

            <div class="title heading_font">
				<?php echo wp_kses_post($post->post_title); ?>
            </div>

            <div class="info">
                <div class="categories info__item">
					<?php
					foreach ($categories as $category) {
						?>
                        <div class="category info__item mbc">
							<?php echo wp_kses_post($category->name); ?>
                        </div>
						<?php
					}
					?>
                </div>

                <div class="date info__item">
                    <i class="stmicon-magazine-calendar"></i>
					<?php
					$posted = get_the_time('U', $post_id);
					echo human_time_diff($posted, current_time('U')) . ' ago';
					?>
                </div>

                <div class="comments info__item">
                    <i class="stmicon-magazine-comment"></i>
                    <span><?php echo comments_number(0, 1, '%'); ?></span>
                </div>
            </div>
        </a>
    </div>
	<?php
endif;
?>