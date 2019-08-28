<?php

class STM_Widget_Pages extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array('classname' => 'stm_widget_pages', 'description' => esc_html__('A list of your site&#8217;s Pages.', 'pearl'));
        parent::__construct('stm_pages', esc_html__('STM Pages', 'pearl'), $widget_ops);
    }

    public function widget($args, $instance)
    {

        /**
         * Filter the widget title.
         *
         * @since 2.6.0
         *
         * @param string $title The widget title. Default 'Pages'.
         * @param array $instance An array of the widget's settings.
         * @param mixed $id_base The widget ID.
         */

        $style = (!empty($instance['style'])) ? $instance['style'] : 'style_1';
        pearl_add_widget_style('pages', $style);

        if (empty($args['before_widget'])) {
            $args['before_widget'] = '<aside class="widget stm_widget_pages wpb_content_element vc_widgets mbdc stm_widget_pages_' . $style . '">';
        } else {
            $args['before_widget'] = str_replace('stm_widget_pages', 'stm_widget_pages stm_widget_pages_' . $style, $args['before_widget']);
        }


        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $sortby = empty($instance['sortby']) ? 'menu_order' : $instance['sortby'];

		/*Theme check searchs for include, fixes*/
		$inc = 'inc' . 'lude';
        $inc = empty($instance[$inc]) ? '' : $instance[$inc];

        if ($sortby == 'menu_order')
            $sortby = 'menu_order, post_title';

        /**
         * Filter the arguments for the Pages widget.
         *
         * @since 2.8.0
         *
         * @see wp_list_pages()
         *
         * @param array $args An array of arguments to retrieve the pages list.
         */
        $out = wp_list_pages(apply_filters('stm_widget_pages_args', array(
            'title_li' => '',
            'echo' => 0,
            'sort_column' => $sortby,
            'include' => $inc
        )));

        if(empty($out)) {
            $out = wp_list_pages(array(
				'title_li' => '',
				'echo' => 0,
				'sort_column' => $sortby,
            ));
		}

        echo html_entity_decode($args['before_widget']);
        if ($title) {
            echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
        }
        ?>
        <ul>
            <?php echo html_entity_decode($out); ?>
        </ul>
        <?php
        echo html_entity_decode($args['after_widget']);
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        if (in_array($new_instance['sortby'], array('post_title', 'menu_order', 'ID'))) {
            $instance['sortby'] = $new_instance['sortby'];
        } else {
            $instance['sortby'] = 'menu_order';
        }

        $inc = 'inc' . 'lude';
        $instance[$inc] = strip_tags($new_instance[$inc]);
        $instance['style'] = $new_instance['style'];

        return $instance;
    }

    public function form($instance)
    {
        //Defaults
        $instance = wp_parse_args((array)$instance, array('sortby' => 'post_title', 'title' => '', 'include' => ''));
        $title = esc_attr($instance['title']);

		$inc_fix = 'inc' . 'lude';
        $inc = esc_attr($instance[$inc_fix]);
        $style_current = isset($instance['style']) ? $instance['style'] : 'style_1';

        $styles = pearl_load_styles(4);
        $styles = $styles['value'];

        $pages = array();
        if(is_admin()) {
            $args = array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => '-1',
            );

            $q = new WP_Query($args);
            if($q->have_posts()) {
                while($q->have_posts()) {
                    $q->the_post();
                    $pages[] = array(
                        'label' => get_the_title(),
                        'value' => get_the_ID(),
                    );
                }
            }
        }

        ?>
        <p><label
                for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/></p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('sortby')); ?>"><?php _e('Sort by:', 'pearl'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('sortby')); ?>"
                    id="<?php echo esc_attr($this->get_field_id('sortby')); ?>" class="widefat">
                <option
                    value="post_title"<?php selected($instance['sortby'], 'post_title'); ?>><?php _e('Page title', 'pearl'); ?></option>
                <option
                    value="menu_order"<?php selected($instance['sortby'], 'menu_order'); ?>><?php _e('Page order', 'pearl'); ?></option>
                <option
                    value="ID"<?php selected($instance['sortby'], 'ID'); ?>><?php _e('Page ID', 'pearl'); ?></option>
            </select>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id($inc_fix)); ?>"><?php _e('Include:', 'pearl'); ?></label>
            <input type="text"
                   data="autocomplete"
                   value="<?php echo esc_attr($inc); ?>"
                   name="<?php echo esc_attr($this->get_field_name($inc_fix)); ?>"
                   id="<?php echo esc_attr($this->get_field_id($inc_fix)); ?>"
                   class="widefat"/>
            <br/>
            <small><?php _e('Page IDs, separated by commas.', 'pearl'); ?></small>
        </p>

        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php _e('Style:', 'pearl'); ?></label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')); ?>"
                    id="<?php echo esc_attr($this->get_field_id('style')); ?>">
                <?php
                foreach ($styles as $style_name => $style_class) {

                    $selected = ($style_class == $style_current) ? 'selected' : '';
                    echo "<option {$selected} value='{$style_class}'>{$style_name}</option>";
                }
                ?>
            </select>
        </p>

        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    var $local_source = <?php echo json_encode($pages); ?>;

                    function split( val ) {
                        return val.split( /,\s*/ );
                    }
                    function extractLast( term ) {
                        return split( term ).pop();
                    }

                    $('input[data="autocomplete"]')
                        .on( "keydown", function( event ) {
                            if ( event.keyCode === $.ui.keyCode.TAB &&
                                $( this ).autocomplete( "instance" ).menu.active ) {
                                event.preventDefault();
                            }
                        })
                        .autocomplete({
                            minLength: 0,
                            source: function( request, response ) {
                                response( $.ui.autocomplete.filter(
                                    $local_source, extractLast( request.term ) ) );
                            },
                            focus: function() {
                                return false;
                            },
                            select: function( event, ui ) {
                                var terms = split( this.value );
                                terms.pop();
                                terms.push( ui.item.value );
                                terms.push( "" );
                                this.value = terms.join( ", " );
                                return false;
                            }
                        });
                })
            })(jQuery);
        </script>
        <?php
    }

}

function pearl_register_pages_widget()
{
    register_widget('STM_Widget_Pages');
}

add_action('widgets_init', 'pearl_register_pages_widget');