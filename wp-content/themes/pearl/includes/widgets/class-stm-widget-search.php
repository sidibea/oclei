<?php
class Pearl_Widget_Search extends WP_Widget    {


	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_search',
			'description' => esc_html__( 'A search form for your site.', 'pearl' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'stm_search', _x( 'STM Search', 'Search widget', 'pearl' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		$s = !empty($instance['style']) ? esc_attr($instance['style']) : 'style_1';
		pearl_add_widget_style('search', $s);

		echo "<div class='stm_widget_search {$s}'>";
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo html_entity_decode($args['before_widget']);
		if ( $title ) {
			echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
		}

		get_search_form();

		echo html_entity_decode($args['after_widget']);
		echo "</div>";
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'pearl'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

		<?php

        $instance['style'] = (!empty($instance['style'])) ? $instance['style'] : 'style_1';
		$style_current = $instance['style'];

		$styles = pearl_load_styles(4);
		$styles = $styles['value'];
		?>

        <p>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
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

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['style'] = isset($new_instance['style']) ? $new_instance['style'] : 'style_1';
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

}

function pearl_register_search_widget() {
	register_widget( 'Pearl_Widget_Search' );
}
add_action( 'widgets_init', 'pearl_register_search_widget' );