<?php

class STM_WP_Widget_Text extends WP_Widget
{

	public function __construct()
	{
		$widget_ops = array(
			'classname'   => 'stm_wp_widget_text',
			'description' => esc_html__('STM Arbitrary text or HTML.', 'pearl')
		);
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('stm_text', esc_html__('STM Text', 'pearl'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$text = apply_filters('stm_wp_widget_text', empty($instance['text']) ? '' : $instance['text'], $instance);
		echo wp_kses_post($args['before_widget']);
		if (!empty($title)) {
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		} ?>
		<div class="textwidget"><?php echo !empty($instance['filter']) ? wpautop($text) : $text; ?></div>

		<?php if (!empty($instance['socials']) and $instance['socials']):
		$socials = pearl_get_option('footer_socials');
		if (!empty($socials)): ?>
			<div class="stm-socials stm_mgt_29">
				<?php foreach ($socials as $item):
					if (!empty($item['social']) and !empty($item['url'])): ?>
						<a href="<?php echo esc_url($item['url']); ?>"
						   class="stm-socials__icon stm-socials__icon_icon_only icon_24px stm-socials_opacity-hover"
						   target="_blank"
						   title="<?php esc_html_e('Social item', 'pearl'); ?>">
							<i class="<?php echo esc_attr($item['social']); ?>"></i>
						</a>
					<?php endif;
				endforeach; ?>
			</div>
		<?php endif;
	endif; ?>

		<?php
		echo wp_kses_post($args['after_widget']);
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		if (current_user_can('unfiltered_html')) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));
		} // wp_filter_post_kses() expects slashed
		$instance['filter'] = !empty($new_instance['filter']);
		$instance['socials'] = !empty($new_instance['socials']);

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array)$instance, array('title' => '', 'text' => ''));
		$title = $instance['title'];
		$text = esc_textarea($instance['text']);
		?>
		<p><label
				for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'pearl'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
				   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
				   value="<?php echo esc_attr($title); ?>"/></p>

		<p><label
				for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Content:', 'pearl'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>"
					  name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo wp_kses_post($text); ?></textarea>
		</p>

		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>"
				  name="<?php echo esc_attr($this->get_field_name('filter')); ?>"
				  type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label
				for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php esc_html_e('Automatically add paragraphs', 'pearl'); ?></label>
		</p>
		<p><input id="<?php echo esc_attr($this->get_field_id('socials')); ?>"
				  name="<?php echo esc_attr($this->get_field_name('socials')); ?>"
				  type="checkbox" <?php checked(isset($instance['socials']) ? $instance['socials'] : 0); ?> />&nbsp;
			<label for="<?php echo esc_attr($this->get_field_id('socials')); ?>"><?php esc_html_e('Add Socials Widget', 'pearl'); ?></label>
		</p>
		<?php
	}
}

function pearl_register_stm_text_widget()
{
	register_widget('STM_WP_Widget_Text');
}

add_action('widgets_init', 'pearl_register_stm_text_widget');