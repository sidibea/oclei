<?php
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Pearl_Widget_Recent_Posts extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array(
			'classname'                   => 'widget_recent_entries',
			'description'                 => esc_html__('Your site&#8217;s most recent Posts.', 'pearl'),
			'customize_selective_refresh' => true,
		);

		parent::__construct('stm-recent-posts', esc_html__('STM Recent Posts', 'pearl'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';
	}

	public function widget($args, $instance)
	{
		$s = isset($instance['style']) ? $instance['style'] : 'style_1';
		pearl_add_widget_style('stm_recent_posts', $s);
		$args['before_widget'] = '<aside class="widget widget-default stm_widget_posts ' . esc_attr($instance['style']) . '">';

		if (empty($args['after_widget'])) {
			$args['after_widget'] = '</aside>';
		}
		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		$title = (!empty($instance['title'])) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		$number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
		if (!$number) $number = 5;
		$show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
		$show_image = isset($instance['show_image']) ? $instance['show_image'] : false;
		$post_format = isset($instance['post_format']) ? $instance['post_format'] : false;

		$q_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);
		if (!empty($post_format) && $post_format !== 'all') {
			$q_args['tax_query'] = array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array($post_format),
				)
			);
		}

		$r = new WP_Query(apply_filters('pearl_widget_posts_args', $q_args));


		if ($r->have_posts()) :
			?>
			<?php echo html_entity_decode($args['before_widget']); ?>
			<?php if ($title) {
			echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
		} ?>
            <ul>
				<?php while ($r->have_posts()) : $r->the_post();
					$format = get_post_format(get_the_ID());
					$format .= ($show_image) ? ' show_image' : ' hide_image';
					$video_label = esc_html('Video', 'pearl');
					if ($video_duration = get_post_meta(get_the_ID(), 'single_post_video_duration', true)) {
						if ($video_duration && $video_duration !== 0) {
							$video_duration = new DateInterval($video_duration);
							if ($video_duration->format('%H') > 0) {
								$video_label = $video_duration->format('%H:%I:%S');
							} else {
								$video_label = $video_duration->format('%I:%S');
							}
						}
					}
					?>
                    <li <?php echo esc_attr(post_class($format)); ?>>

                        <a class="clearfix" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php if ($show_image && $thumb = get_the_post_thumbnail(get_the_ID())) {

								$img_size = '85x85';
								if ($s === 'style_3') $img_size = '255x105';
								if ($s === 'style_8') $img_size = '140x90';
								if ($s === 'style_10') $img_size = '100x100';

								$thumb_id = get_post_thumbnail_id(get_the_ID());

								if ($s === 'style_8') {
									echo '<div class="stm_widget_posts__image">';
								}

								if (function_exists('pearl_get_VC_img')) {
									$thumb = pearl_get_VC_img($thumb_id, $img_size);
								}
								echo wp_kses_post($thumb);

								if ($post_format === 'post-format-video') : ?>
                                    <div class="stm_widget_posts__video_label mbc_b">
										<?php
										echo wp_kses_post($video_label);
										?>
                                    </div>
								<?php endif;

								if ($s === 'style_8') {
									echo '</div>';
								}

							} ?>

                            <div class="stm_widget_posts__wrapper mtc_b">
                                <div class="stm_widget_posts__title">
									<?php get_the_title() ? the_title() : the_ID(); ?>
                                </div>
								<?php if ($s === 'style_7') :
									?>
                                    <div class="post-info">
										<?php
										$id = get_the_ID();
										$post_views = get_post_meta($id, 'stm_post_views', true);
										$post_views = !empty($post_views) ? $post_views : 0;
										$categories = wp_get_post_categories($id);

										if (!is_wp_error($categories) && !empty($categories)) :
											?>
                                            <div class="post-categories info-item">
												<?php foreach ($categories as $category) :
													$category = get_category($category);
													?>
                                                    <div class="post-category">
														<?php echo wp_kses_post($category->name); ?>
                                                    </div>
												<?php
												endforeach; ?>
                                            </div>
										<?php endif; ?>
                                        <div class="post-views info-item">
                                            <i class="stmicon-magazine-view"></i>
											<?php echo wp_kses_post($post_views); ?>
                                        </div>
                                    </div>
								<?php endif; ?>

								<?php ?>
								<?php if ($show_date) : ?>
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
								<?php endif; ?>
								<?php if ($s === 'style_9') : ?>
                                    <a class="read_more" href="<?php the_permalink(); ?>">
                                        <?php echo esc_html__('Details', 'pearl'); ?>
                                    </a>
								<?php endif; ?>
                            </div>
                        </a>
                    </li>
				<?php
				endwhile; ?>
            </ul>
			<?php echo html_entity_decode($args['after_widget']); ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['number'] = (int)$new_instance['number'];
		$instance['show_date'] = isset($new_instance['show_date']) ? (bool)$new_instance['show_date'] : false;
		$instance['style'] = isset($new_instance['style']) ? $new_instance['style'] : 'style_1';
		$instance['show_image'] = isset($new_instance['show_image']) ? (bool)$new_instance['show_image'] : false;
		$instance['post_format'] = isset($new_instance['post_format']) ? $new_instance['post_format'] : false;
		return $instance;
	}

	public function form($instance)
	{
		$styles = pearl_load_styles(9);
		$styles = $styles['value'];

		$title = isset($instance['title']) ? $instance['title'] : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$current_post_format = isset($instance['post_format']) ? $instance['post_format'] : 'all';

		$post_formats = pearl_get_available_post_formats();

		$show_date = $show_image = 0;

		if (!empty($instance['show_date']) and $instance['show_date']) $show_date = 1;
		if (!empty($instance['show_image']) and $instance['show_image']) $show_image = 1;

		$style_current = (!empty($instance['style'])) ? $instance['style'] : 'style_1';
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'pearl'); ?></label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>

        <p>
            <label
                    for="<?php echo esc_attr($this->get_field_id('post_format')); ?>"><?php _e('Select post format:', 'pearl'); ?></label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name('post_format')) ?>"
                    id="<?php echo esc_attr($this->get_field_id('post_format')) ?>">
				<?php

				foreach ($post_formats as $post_format_name => $post_format_slug) {
					$selected = selected($current_post_format, $post_format_slug, false);
					echo "<option {$selected} value='" . esc_attr($post_format_slug) . "'>" . sanitize_text_field($post_format_name) . "</option>";
				}
				?>
            </select>
        </p>

        <p>
            <label
                    for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts to show:', 'pearl'); ?></label>
            <input class="tiny-text"
                   id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                   type="number"
                   step="1"
                   min="1"
                   value="<?php echo esc_attr($number); ?>" size="3"/>
        </p>

        <p>
            <input class="checkbox"
                   type="checkbox"<?php checked($show_date); ?>
                   id="<?php echo esc_attr($this->get_field_id('show_date')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('show_date')); ?>"/>

            <label
                    for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php _e('Display post date?', 'pearl'); ?></label>
        </p>

        <p><input class="checkbox" type="checkbox"
				<?php checked($show_image); ?>
                  id="<?php echo esc_attr($this->get_field_id('show_image')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('show_image')); ?>"/>
            <label
                    for="<?php echo esc_attr($this->get_field_id('show_image')); ?>"><?php echo esc_html__('Display post image?', 'pearl'); ?></label>
        </p>

        <p>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')) ?>"
                    id="<?php echo esc_attr($this->get_field_id('style')) ?>">
				<?php
				foreach ($styles as $style_name => $style_class) {

					$selected = selected($style_current, $style_class, false);
					echo "<option {$selected} value='" . esc_attr($style_class) . "'>" . sanitize_text_field($style_name) . "</option>";
				}
				?>
            </select>
        </p>
		<?php
	}
}

function pearl_register_posts_widget()
{
	register_widget('Pearl_Widget_Recent_Posts');
}

add_action('widgets_init', 'pearl_register_posts_widget');
