<?php

class Pearl_Recent_Comments extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array(
			'classname'                   => 'widget_recent_comments',
			'description'                 => esc_html__('Your site&#8217;s most recent comments.', 'pearl'),
			'customize_selective_refresh' => true,
		);
		parent::__construct('stm-recent-comments', esc_html__('STM Recent Comments', 'pearl'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';
	}

	public function widget($args, $instance)
	{

		$s = isset($instance['style']) ? $instance['style'] : 'style_1';
		pearl_add_widget_style('comments', $s);


		if (empty($args['before_widget'])) {
			$args['before_widget'] = '<aside class="widget widget-default widget_recent_comments widget_recent_comments_' . esc_attr($s) . '">';
		} else {
			$args['before_widget'] = str_replace('widget_recent_comments', 'widget_recent_comments widget_recent_comments_' . esc_attr($s), $args['before_widget']);
		}
		if (empty($args['after_widget'])) {
			$args['after_widget'] = '</aside>';
		}
		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}


		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		if (!isset($args['widget_id']))
			$args['widget_id'] = $this->id;

		$output = '';

		$title = (!empty($instance['title'])) ? $instance['title'] : esc_html__('Recent Comments', 'pearl');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		$number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
		if (!$number)
			$number = 5;

		/**
		 * Filters the arguments for the Recent Comments widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Comment_Query::query() for information on accepted arguments.
		 *
		 * @param array $comment_args An array of arguments used to retrieve the recent comments.
		 */
		$comments = get_comments(apply_filters('widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		)));

		$output .= $args['before_widget'];
		if ($title) {
			$output .= $args['before_title'] . $title . $args['after_title'];
		}

		$output .= '<ul id="recentcomments">';
		if (is_array($comments) && $comments) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
			_prime_post_caches($post_ids, strpos(get_option('permalink_structure'), '%category%'), false);

			foreach ((array)$comments as $comment) {
				$output .= '<li class="recentcomments">';
				/* translators: comments widget: 1: comment author, 2: post link */
				$output .= '<a href="' . esc_url(get_comment_link($comment)) . '">' . $comment->comment_content . '</a>';
				$output .= '</li>';
			}
		}
		$output .= '</ul>';
		$output .= $args['after_widget'];

		echo html_entity_decode($output);
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['number'] = absint($new_instance['number']);
		$instance['style'] = $new_instance['style'];

		return $instance;
	}

	public function form( $instance ) {

		$instance['style'] = isset($instance['style']) ? $instance['style'] : 'style_1';

		$styles = pearl_load_styles(2);
		$styles = $styles['value'];
		$style_current = $instance['style'];



		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'pearl' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of comments to show:', 'pearl' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3" /></p>

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

function register_recent_comments_widget()
{
	register_widget('Pearl_Recent_Comments');
}

add_action('widgets_init', 'register_recent_comments_widget');