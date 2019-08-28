<?php

class Stm_Follow_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'follow', // Base ID
            esc_html__('Follow Us', 'pearl'), // Name
            array('description' => esc_html__('Follow us widget', 'pearl'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {

        $style = isset($instance['style']) ? $instance['style'] : 'style_1';

        pearl_add_widget_style('follow', $style);

        $title = apply_filters('widget_title', $instance['title']);


        if (!empty($args['before_widget'])) {
            $args['before_widget'] = str_replace('widget_follow', 'widget_follow widget_follow_' . esc_attr($style), $args['before_widget']);
        }


        echo html_entity_decode($args['before_widget']);
        if (!empty($title)) {
            echo html_entity_decode($args['before_title'] . esc_html($title) . $args['after_title']);
        } ?>

        <div class="widget_follow_inner">

            <?php if (!empty($instance['facebook_link'])): ?>
                <div class="stm-icontext stm-icontext_style1 stm-icontext__facebook_link" data-title="<?php esc_html_e('Facebook', 'pearl') ?>">
                    <a href="<?php echo wp_kses_post($instance['facebook_link']); ?>" target="_blank" rel="nofollow">
                        <i class="stm-icontext__icon fa fa-facebook"></i><span class="stm-icontext__text"><?php echo wp_kses_post($instance['facebook_title']); ?></span>
                    </a>
                </div>
            <?php endif;

            if (!empty($instance['twitter_link'])): ?>
                <div class="stm-icontext stm-icontext_style1 stm-icontext__twitter_link" data-title="<?php esc_html_e('Twitter', 'pearl') ?>">
                    <a href="<?php echo wp_kses_post($instance['twitter_link']); ?>" target="_blank" rel="nofollow">
                        <i class="stm-icontext__icon fa fa-twitter"></i><span class="stm-icontext__text"><?php echo wp_kses_post($instance['twitter_title']); ?></span>
                    </a>
                </div>
            <?php endif;

            if (!empty($instance['youtube_link'])): ?>
                <div class="stm-icontext stm-icontext_style1 stm-icontext__youtube_link" data-title="<?php esc_html_e('Youtube', 'pearl') ?>">
                    <a href="<?php echo wp_kses_post($instance['youtube_link']); ?>" target="_blank" rel="nofollow">
                        <i class="stm-icontext__icon fa fa-youtube-play"></i><span class="stm-icontext__text"><?php echo wp_kses_post($instance['youtube_title']); ?></span>
                    </a>
                </div>
            <?php endif;

            if (!empty($instance['instagram_link'])): ?>
                <div class="stm-icontext stm-icontext_style1 stm-icontext__instagram_link" data-title="<?php esc_html_e('Instagram', 'pearl') ?>">
                    <a href="<?php echo wp_kses_post($instance['instagram_link']); ?>" target="_blank" rel="nofollow">
                        <i class="stm-icontext__icon fa fa-instagram"></i><span class="stm-icontext__text"><?php echo wp_kses_post($instance['instagram_title']); ?></span>
                    </a>
                </div>

            <?php endif;
            if (!empty($instance['pinterest_link'])): ?>
                <div class="stm-icontext stm-icontext_style1 stm-icontext__pinterest_link" data-title="<?php esc_html_e('Pinterest', 'pearl') ?>">
                    <a href="<?php echo wp_kses_post($instance['pinterest_link']); ?>" target="_blank" rel="nofollow">
                        <i class="stm-icontext__icon fa fa-pinterest-p"></i><span class="stm-icontext__text"><?php echo wp_kses_post($instance['pinterest_title']); ?></span>
                    </a>
                </div>

            <?php endif; ?>

        </div>
        <?php echo html_entity_decode($args['after_widget']);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title = '';
        $facebook_link = '';
        $facebook_title = '';
        $twitter_link = '';
        $twitter_title = '';
        $youtube_link = '';
        $youtube_title = '';
        $instagram_link = '';
        $instagram_title = '';
        $pinterest_link = '';
        $pinterest_title = '';
        $style_current = 'style_1';

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__('Follow Us', 'pearl');
        }

        if (isset($instance['facebook_link'])) {
            $facebook_link = $instance['facebook_link'];
            $facebook_title = $instance['facebook_title'];
        }

        if (isset($instance['youtube_link'])) {
            $youtube_link = $instance['youtube_link'];
            $youtube_title = $instance['youtube_title'];
        }

        if (isset($instance['twitter_link'])) {
            $twitter_link = $instance['twitter_link'];
            $twitter_title = $instance['twitter_title'];
        }

        if (isset($instance['instagram_link'])) {
            $instagram_link = $instance['instagram_link'];
            $instagram_title = $instance['instagram_title'];
        }

        if (isset($instance['pinterest_link'])) {
            $pinterest_link = $instance['pinterest_link'];
            $pinterest_title = $instance['pinterest_title'];
        }

        if (isset($instance['style'])) {
            $style_current = $instance['style'];
        }

        ?>
        <p>
            <label><?php _e('Title:', 'pearl'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </label>
        </p>
        <p>
            <label><?php _e('Facebook:', 'pearl'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('facebook_link')); ?>" type="text" value="<?php echo esc_attr($facebook_link); ?>" placeholder="<?php _e('Url:', 'pearl'); ?>">
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('facebook_title')); ?>" type="text" value="<?php echo esc_attr($facebook_title); ?>" placeholder="<?php _e('Title:', 'pearl'); ?>">
            </label>
        </p>
        <p>
            <label><?php _e('Twitter:', 'pearl'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('twitter_link')); ?>" type="text" value="<?php echo esc_attr($twitter_link); ?>" placeholder="<?php _e('Url:', 'pearl'); ?>">
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('twitter_title')); ?>" type="text" value="<?php echo esc_attr($twitter_title); ?>" placeholder="<?php _e('Title:', 'pearl'); ?>">
            </label>
        </p>
        <p>
            <label><?php _e('Youtube:', 'pearl'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('youtube_link')); ?>" type="text" value="<?php echo esc_attr($youtube_link); ?>" placeholder="<?php _e('Url:', 'pearl'); ?>">
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('youtube_title')); ?>" type="text" value="<?php echo esc_attr($youtube_title); ?>" placeholder="<?php _e('Title:', 'pearl'); ?>">
            </label>
        </p>
        <p>
            <label><?php _e('Instagram:', 'pearl'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('instagram_link')); ?>" type="text" value="<?php echo esc_attr($instagram_link); ?>" placeholder="<?php _e('Url:', 'pearl'); ?>">
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('instagram_title')); ?>" type="text" value="<?php echo esc_attr($instagram_title); ?>" placeholder="<?php _e('Title:', 'pearl'); ?>">
            </label>
        </p>
        <p>
            <label><?php _e('Pinterest:', 'pearl'); ?>
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('pinterest_link')); ?>" type="text" value="<?php echo esc_attr($pinterest_link); ?>" placeholder="<?php _e('Url:', 'pearl'); ?>">
                <input class="widefat" name="<?php echo esc_attr($this->get_field_name('pinterest_title')); ?>" type="text" value="<?php echo esc_attr($pinterest_title); ?>" placeholder="<?php _e('Title:', 'pearl'); ?>">
            </label>
        </p>

        <?php
        $styles = pearl_load_styles(1);
        $styles = $styles['value'];
        ?>

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
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? esc_attr($new_instance['title']) : '';
        $instance['facebook_link'] = (!empty($new_instance['facebook_link'])) ? esc_attr($new_instance['facebook_link']) : '';
        $instance['facebook_title'] = (!empty($new_instance['facebook_title'])) ? esc_attr($new_instance['facebook_title']) : '';
        $instance['twitter_link'] = (!empty($new_instance['twitter_link'])) ? esc_attr($new_instance['twitter_link']) : '';
        $instance['twitter_title'] = (!empty($new_instance['twitter_title'])) ? esc_attr($new_instance['twitter_title']) : '';
        $instance['youtube_link'] = (!empty($new_instance['youtube_link'])) ? esc_attr($new_instance['youtube_link']) : '';
        $instance['youtube_title'] = (!empty($new_instance['youtube_title'])) ? esc_attr($new_instance['youtube_title']) : '';
        $instance['instagram_link'] = (!empty($new_instance['instagram_link'])) ? esc_attr($new_instance['instagram_link']) : '';
        $instance['instagram_title'] = (!empty($new_instance['instagram_title'])) ? esc_attr($new_instance['instagram_title']) : '';
        $instance['pinterest_link'] = (!empty($new_instance['pinterest_link'])) ? esc_attr($new_instance['pinterest_link']) : '';
        $instance['pinterest_title'] = (!empty($new_instance['pinterest_title'])) ? esc_attr($new_instance['pinterest_title']) : '';
        $instance['style'] = (!empty($new_instance['style'])) ? esc_attr($new_instance['style']) : '';

        return $instance;
    }

}

function register_follow_widget()
{
    register_widget('Stm_Follow_Widget');
}

add_action('widgets_init', 'register_follow_widget');