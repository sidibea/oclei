<?php

class STM_WP_Widget_Post_Gallery extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'stm_wp_widget_post_gallery',
            'description' => esc_html__('STM Posts Gallery widget', 'pearl')
        );
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('stm_wp_widget_post_gallery', esc_html__('STM Posts Gallery', 'pearl'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        wp_enqueue_style('lightgallery');
        wp_enqueue_script('lightgallery.js');

        $style = (!empty($instance['style'])) ? $instance['style'] : 'style_1';
        pearl_add_widget_style('gallery', $style);

        $args['before_widget'] = str_replace('class="', 'class="stm_wp_widget_post_gallery_' . esc_attr($style) . " ", $args['before_widget']);



        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $num = (empty($instance['num'])) ? '6' : $instance['num'];
        $image_size = (empty($instance['size'])) ? '70x70' : $instance['size'];
        $post_type = (empty($instance['post_type'])) ? '' : $instance['post_type'];

        $post_status = ($post_type !== 'attachment') ? 'publish' : 'inherit';

        $q_args = array(
            'post_type' => sanitize_title($post_type),
            'posts_per_page' => intval($num),
            'post_status'    => $post_status,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
			)
        );
        echo html_entity_decode($args['before_widget']);
        if (!empty($title)) {
            echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
        }

        $q = new WP_Query($q_args);

        if ($q->have_posts()): ?>
            <div class="stm_widget_media stm_lightgallery">
                <?php while ($q->have_posts()): $q->the_post();
                    $id = get_the_ID();
                    $img_id = ($post_type !== 'attachment') ? get_post_thumbnail_id($id) : $id;
                    $image = get_the_post_thumbnail(get_the_ID(), $image_size);
                    $full_image = pearl_get_image_url($img_id);
                    if(function_exists('pearl_get_VC_img')) {
                        $image = pearl_get_VC_img($img_id, $image_size);
                    }
                    ?>
                    <a href="<?php echo esc_url($full_image); ?>"
                       class="stm_widget_media__single stm_lightgallery__selector"
                       data-sub-html='<a class="wtc" href="<?php the_permalink() ?>"><?php the_title(); ?></a>'
                       title="<?php the_title(); ?>">
                            <?php echo html_entity_decode($image); ?>
                    </a>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata();
        endif;

        ?>

        <?php
        echo html_entity_decode($args['after_widget']);
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['post_type'] = $new_instance['post_type'];
        $instance['num'] = $new_instance['num'];
        $instance['size'] = $new_instance['size'];
        $instance['style'] = $new_instance['style'];

        return $instance;
    }

    public function form($instance)
    {
        $title = (!empty($instance['title'])) ? $instance['title'] : '';
        $num = (!empty($instance['num'])) ? $instance['num'] : '';
        $size = (!empty($instance['size'])) ? $instance['size'] : '';
        $post_type = (!empty($instance['post_type'])) ? $instance['post_type'] : '';
        $post_types = get_post_types();
        $style_current = isset($instance['style']) ? $instance['style'] : 'style_1' ;

        $styles = pearl_load_styles(3);
        $styles = $styles['value'];
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'pearl'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num')); ?>">
                <?php esc_html_e('Number of images:', 'pearl'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('num')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('num')); ?>"
                   type="number"
                   value="<?php echo esc_attr($num); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('size')); ?>">
                <?php esc_html_e('Image size:', 'pearl'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('size')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('size')); ?>"
                   type="text"
                   value="<?php echo esc_attr($size); ?>"/>
            <span><?php esc_html_e('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'); ?></span>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>">
                <?php esc_html_e('Post type:', 'pearl'); ?>
            </label>
            <select name="<?php echo esc_attr($this->get_field_name('post_type')); ?>"
                    id="<?php echo esc_attr($this->get_field_id('post_type')); ?>"
                    class="widefat">
                <?php foreach ($post_types as $post):
                    $selected = ($post == $post_type) ? 'selected' : '';
                    $post_type_info = get_post_type_object($post);
                    ?>
                    <option value="<?php echo sanitize_text_field($post); ?>" <?php echo esc_attr($selected); ?>>
                        <?php echo esc_attr($post_type_info->labels->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php _e( 'Style:', 'pearl' ); ?></label>
            <select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
                <?php
                foreach ($styles as $style_name => $style_class) {

                    $selected = ($style_class == $style_current) ? 'selected' : '';
                    echo "<option {$selected} value='{$style_class}'>{$style_name}</option>";
                }
                ?>
            </select>
        </p>

        <?php
    }
}

function pearl_register_stm_post_gallery_widget()
{
    register_widget('STM_WP_Widget_Post_Gallery');
}

add_action('widgets_init', 'pearl_register_stm_post_gallery_widget');