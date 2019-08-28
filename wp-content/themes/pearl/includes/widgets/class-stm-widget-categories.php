<?php
class Pearl_Widget_Categories extends WP_Widget_Categories {


	public function widget( $args, $instance )
	{
		$s = !empty($instance['style']) ? esc_attr($instance['style']) : 'style_1';
		pearl_add_widget_style('categories', $s);
		$args['before_widget'] = '<aside class="widget widget-default stm_widget_categories ' . $s . ' mbdc">';
		$args['after_widget'] = '</aside>';

		static $first_dropdown = true;

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Categories' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h,
		);

		if ( $d ) {
			echo sprintf( '<form action="%s" method="get">', esc_url( home_url() ) );
			$dropdown_id = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;

			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';

			$cat_args['show_option_none'] = __( 'Select Category' );
			$cat_args['id'] = $dropdown_id;

			/**
			 * Filters the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 * @param array $instance Array of settings for the current widget.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args, $instance ) );

			echo '</form>';
			?>

            <script type='text/javascript'>
                /* <![CDATA[ */
                (function() {
                    var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
                    function onCatChange() {
                        if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
                            dropdown.parentNode.parentNode.submit();
                        }
                    }
                    dropdown.onchange = onCatChange;
                })();
                /* ]]> */
            </script>

			<?php
		} else {
			?>
            <ul>
				<?php
				$cat_args['title_li'] = '';

				/**
				 * Filters the arguments for the Categories widget.
				 *
				 * @since 2.8.0
				 * @since 4.9.0 Added the `$instance` parameter.
				 *
				 * @param array $cat_args An array of Categories widget options.
				 * @param array $instance Array of settings for the current widget.
				 */
				wp_list_categories( apply_filters( 'widget_categories_args', $cat_args, $instance ) );
				?>
            </ul>
			<?php
		}

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
        $na['style'] = $new_instance['style_3'];
		//$na = parent::update($new_instance, $old_instance);
		return $new_instance;
	}

	public function form( $instance ) {
		$instance['style'] = isset($instance['style']) ? $instance['style'] : 'style_1';


		parent::form($instance);
		$style_current = $instance['style'];

		$styles = pearl_load_styles(3);
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

}



function pearl_register_categories_widget() {
    unregister_widget('WP_Widget_Categories');
    register_widget( 'Pearl_Widget_Categories' );
}
add_action( 'widgets_init', 'pearl_register_categories_widget' );
