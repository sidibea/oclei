<?php

class Pearl_Tag_Cloud extends WP_Widget
{

	public function __construct()
	{
		$widget_ops = array(
			'description'                 => esc_html__('A cloud of your most used tags.', 'pearl'),
			'customize_selective_refresh' => true,
		);
		parent::__construct('stm_tag_cloud', esc_html__('STM Tag Cloud', 'pearl'), $widget_ops);
	}

	public function widget($args, $instance)
	{

		$s = isset($instance['style']) ? $instance['style'] : 'style_1';
		pearl_add_widget_style('tags', $s);

		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if (!empty($instance['title'])) {
			$title = $instance['title'];
		} else {
			if ('post_tag' == $current_taxonomy) {
				$title = esc_html__('Tags', 'pearl');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}


		$tag_cloud = wp_tag_cloud(apply_filters('widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy,
			'echo'     => false
		)));

		if (empty($tag_cloud)) {
			return;
		}

		if (empty($args['before_widget'])) {
			$args['before_widget'] = '<aside class="widget widget-default tag_cloud tag_cloud_' . esc_attr($s) . '">';
		} else {
			$args['before_widget'] = str_replace('tag_cloud', 'tag_cloud tag_cloud_' . esc_attr($s), $args['before_widget']);
		}
		if (empty($args['after_widget'])) {
			$args['after_widget'] = '</aside>';
		}
		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo html_entity_decode($args['before_widget']);
		if ($title) {
			echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
		}

		echo html_entity_decode('<div class="tagcloud">');

		echo html_entity_decode($tag_cloud);

		echo html_entity_decode("</div>\n");
		echo html_entity_decode($args['after_widget']);
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		$instance['style'] = $new_instance['style'];
		return $instance;
	}

	public function form($instance)
	{
		$instance['style'] = isset($instance['style']) ? $instance['style'] : 'style_1';

		$styles = pearl_load_styles(3);
		$styles = $styles['value'];
		$style_current = $instance['style'];


		$current_taxonomy = $this->_get_current_taxonomy($instance);
		$title_id = $this->get_field_id('title');
		$instance['title'] = !empty($instance['title']) ? esc_attr($instance['title']) : '';

		echo '<p><label for="' . $title_id . '">' . esc_html__('Title:', 'pearl') . '</label>
			<input type="text" class="widefat" id="' . $title_id . '" name="' . $this->get_field_name('title') . '" value="' . $instance['title'] . '" />
		</p>';

		$taxonomies = get_taxonomies(array('show_tagcloud' => true), 'object');
		$id = $this->get_field_id('taxonomy');
		$name = $this->get_field_name('taxonomy');
		$input = '<input type="hidden" id="' . $id . '" name="' . $name . '" value="%s" />';

		switch (count($taxonomies)) {

			// No tag cloud supporting taxonomies found, display error message
			case 0:
				echo '<p>' . esc_html__('The tag cloud will not be displayed since there are no taxonomies that support the tag cloud widget.', 'pearl') . '</p>';
				printf($input, '');
				break;

			// Just a single tag cloud supporting taxonomy found, no need to display options
			case 1:
				$keys = array_keys($taxonomies);
				$taxonomy = reset($keys);
				printf($input, esc_attr($taxonomy));
				break;

			// More than one tag cloud supporting taxonomy found, display options
			default:
				printf(
					'<p><label for="%1$s">%2$s</label>' .
					'<select class="widefat" id="%1$s" name="%3$s">',
					$id,
				 esc_html__('Taxonomy:', 'pearl'),
					$name
				);

				foreach ($taxonomies as $taxonomy => $tax) {
					printf(
						'<option value="%s"%s>%s</option>',
						esc_attr($taxonomy),
						selected($taxonomy, $current_taxonomy, false),
						$tax->labels->name
					);
				}

				echo '</select></p>';
		}
		?>
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

	public function _get_current_taxonomy($instance)
	{
		if (!empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']))
			return $instance['taxonomy'];

		return 'post_tag';
	}
}

function pearl_register_tag_cloud_widget()
{
	register_widget('Pearl_Tag_Cloud');
}

add_action('widgets_init', 'pearl_register_tag_cloud_widget');