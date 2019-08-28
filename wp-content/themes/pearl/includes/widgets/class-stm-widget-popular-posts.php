<?php
/**
 * Widget API: WP_Widget_Popular_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Popular Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Pearl_Widget_Popular_Posts extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array(
			'classname'                   => 'widget_popular_entries',
			'description'                 => esc_html__('Your site&#8217;s most popular Posts.', 'pearl'),
			'customize_selective_refresh' => true,
		);

		parent::__construct('stm-popular-posts', esc_html__('STM Popular Posts', 'pearl'), $widget_ops);
		$this->alt_option_name = 'widget_popular_entries';
	}

	public function widget($args, $instance)
	{
		$s = isset($instance['style']) ? $instance['style'] : 'style_1';
		pearl_add_widget_style('stm_popular_posts', $s);
		$args['before_widget'] = '<aside class="widget widget-default stm_widget_popular_posts stm_widget_popular_posts_' . esc_attr($instance['style']) . '">';

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
		$link = isset($instance['link']) ? $instance['link'] : '';
		pearl_add_widget_style('stm_popular_posts', $s);

		$r = new WP_Query(apply_filters('pearl_widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'orderby'             => 'meta_value_num',
			'meta_key'            => 'stm_post_views'
		)));


		if ($r->have_posts()) :
			?>
			<?php echo html_entity_decode($args['before_widget']); ?>
			<?php if ($title) {
			echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
		} ?>
            <ul>
				<?php while ($r->have_posts()) : $r->the_post();
					$format = get_post_format(get_the_ID());
					$categories = wp_get_post_categories(get_the_ID());
					?>
                    <li <?php echo esc_attr(post_class($format)); ?>>
                        <a class="clearfix" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">


                            <div class="stm_widget_posts__wrapper mtc_b">
                                <div class="stm_widget_popular_posts__title">
									<?php get_the_title() ? the_title() : the_ID(); ?>
                                </div>
								<?php
								$comments_count = get_comments_number();
								?>

                                <div class="stm_widget_popular_posts__info">
									<?php if (!is_wp_error($categories) && !empty($categories)): ?>
                                        <div class="stm_widget_popular_posts__categories info__item">
											<?php foreach ($categories as $category) : ?>
                                                <div class="stm_widget_popular_posts__category">
													<?php
													$category = get_category($category);
													echo wp_kses_post($category->name);
													?>
                                                </div>
											<?php endforeach; ?>
                                        </div>
									<?php endif; ?>

                                    <div class="stm_widget_popular_posts__views info__item">
                                        <i class="stmicon-magazine-comment"></i>
										<?php echo wp_kses_post($comments_count); ?>
                                    </div>
                                </div>

								<?php if ($show_date) : ?>
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
								<?php endif; ?>
                            </div>
                        </a>
                    </li>
				<?php
				endwhile; ?>
            </ul>
			<?php if (!empty($link)) : ?>
            <div class="stm_widget_popular_posts__link">
                <a href="<?php echo esc_url($link); ?>"><?php echo esc_html('More News', 'pearl'); ?></a>
            </div>
		<?php endif; ?>
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
		$instance['link'] = isset($new_instance['link']) ? $new_instance['link'] : '';
		$instance['style'] = isset($new_instance['style']) ? $new_instance['style'] : 'style_1';
		return $instance;
	}

	public function form($instance)
	{
		$styles = pearl_load_styles(1);
		$styles = $styles['value'];

		$title = isset($instance['title']) ? $instance['title'] : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$link = isset($instance['link']) ? $instance['link'] : '';

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
            <label
                    for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php _e('Link to all news:', 'pearl'); ?></label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('link')); ?>"
                   type="text"
                   value="<?php echo esc_attr($link); ?>" size="3"/>
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

function pearl_register_popular_posts_widget()
{
	register_widget('Pearl_Widget_Popular_Posts');
}

add_action('widgets_init', 'pearl_register_popular_posts_widget');
