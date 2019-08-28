<?php

class Pearl_Contacts_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'contacts', // Base ID
            esc_html__('Contacts', 'pearl'), // Name
            array('description' => esc_html__('Contacts widget', 'pearl'),) // Args
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

        pearl_add_widget_style('contacts', $style);


        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';

        if (!empty($args['before_widget'])) {
            $args['before_widget'] = str_replace('widget_contacts', 'widget_contacts widget_contacts_' . esc_attr($style), $args['before_widget']);
        }


        echo html_entity_decode($args['before_widget']);
        if (!empty($title)) {
            echo html_entity_decode($args['before_title'] . esc_html($title) . $args['after_title']);
        } ?>

        <div class="widget_contacts_inner" itemscope itemtype="http://schema.org/Organization">

            <?php if (!empty($instance['address'])): ?>
                <div class="stm-icontext stm-icontext_style2 stm-icontext__address" data-title="<?php esc_html_e('Address', 'pearl') ?>">
                    <i class="stm-icontext__icon fa fa-home"></i>
                    <span class="stm-icontext__text" itemprop="address">
                        <?php echo wp_kses_post($instance['address']); ?>
                    </span>
                </div>
            <?php endif;

            if (!empty($instance['phone'])): ?>
                <div class="stm-icontext stm-icontext_style2 stm-icontext__phone" data-title="<?php esc_html_e('Phone', 'pearl') ?>">
                    <i class="stm-icontext__icon fa fa-phone-square"></i>
                    <span class="stm-icontext__text" itemprop="telephone">
                        <?php echo wp_kses_post($instance['phone']); ?>
                    </span>
                </div>
            <?php endif;

            if (!empty($instance['fax'])): ?>
                <div class="stm-icontext stm-icontext_style2 stm-icontext__fax" data-title="<?php esc_html_e('Fax', 'pearl') ?>">
                    <i class="stm-icontext__icon fa fa-fax"></i>
                    <span class="stm-icontext__text" itemprop="faxNumber">
                        <?php echo wp_kses_post($instance['fax']); ?>
                    </span>
                </div>
            <?php endif;

            if (!empty($instance['email'])): ?>
                <div class="stm-icontext stm-icontext_style2 stm-icontext__email" data-title="<?php esc_html_e('Email', 'pearl') ?>">
                    <i class="stm-icontext__icon fa fa-envelope"></i>
                    <span class="stm-icontext__text">
                        <a class="stm-effects_opacity"
                           itemprop="email"
                           href="mailto:<?php echo sanitize_email($instance['email']); ?>">
                            <?php echo sanitize_email($instance['email']); ?>
                        </a>
                    </span>
                </div>
            <?php endif;

            if (!empty($instance['open_hours'])): ?>
                <div class="stm-icontext stm-icontext_style2 stm-icontext__fax" data-title="<?php esc_html_e('Open hours', 'pearl') ?>">
                    <i class="stm-icontext__icon stmicon-med_time"></i>
                    <span class="stm-icontext__text">
                        <?php echo wp_kses_post($instance['open_hours']); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if (!empty($instance['socials']) and $instance['socials']):
                $socials = pearl_get_option('footer_socials');
                if (!empty($socials)): ?>
                    <div class="stm-socials stm_mgt_29">
                        <?php foreach ($socials as $item):
                            if (!empty($item['social']) and !empty($item['url'])): ?>
                                <a href="<?php echo $item['url']; ?>"
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
        $address = '';
        $phone = '';
        $fax = '';
        $email = '';
        $open_hours = '';
        $style_current = 'style_1';

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__('Contact', 'pearl');
        }

        if (isset($instance['address'])) {
            $address = $instance['address'];
        }

        if (isset($instance['phone'])) {
            $phone = $instance['phone'];
        }

        if (isset($instance['fax'])) {
            $fax = $instance['fax'];
        }

        if (isset($instance['email'])) {
            $email = $instance['email'];
        }

        if (isset($instance['open_hours'])) {
            $open_hours = $instance['open_hours'];
        }

        if (isset($instance['style'])) {
            $style_current = $instance['style'];
        }

        ?>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php _e('Address:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text"
                   value="<?php echo esc_attr($address); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php _e('Phone:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text"
                   value="<?php echo esc_attr($phone); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('fax')); ?>"><?php _e('Fax:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('fax')); ?>" type="text"
                   value="<?php echo esc_attr($fax); ?>">
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('E-mail:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text"
                   value="<?php echo sanitize_email($email); ?>">
        </p>

        <p><input id="<?php echo esc_attr($this->get_field_id('socials')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('socials')); ?>"
                  type="checkbox" <?php checked(isset($instance['socials']) ? $instance['socials'] : 0); ?> />&nbsp;<label
                for="<?php echo esc_attr($this->get_field_id('socials')); ?>"><?php esc_html_e('Add Socials Widget', 'pearl'); ?></label><br>
            <i><?php esc_html_e('Fill the socials links in theme options - footer section'); ?></i>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('open_hours')); ?>"><?php _e('Open Hours:', 'pearl'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('open_hours')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('open_hours')); ?>" type="text"
                   value="<?php echo esc_attr($open_hours); ?>">
        </p>

        <?php
        $styles = pearl_load_styles(11);
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
        $instance['address'] = (!empty($new_instance['address'])) ? esc_attr($new_instance['address']) : '';
        $instance['phone'] = (!empty($new_instance['phone'])) ? esc_attr($new_instance['phone']) : '';
        $instance['fax'] = (!empty($new_instance['fax'])) ? esc_attr($new_instance['fax']) : '';
        $instance['email'] = (!empty($new_instance['email'])) ? sanitize_email($new_instance['email']) : '';
        $instance['socials'] = !empty($new_instance['socials']);
        $instance['open_hours'] = (!empty($new_instance['open_hours'])) ? $new_instance['open_hours'] : '';
        $instance['style'] = (!empty($new_instance['style'])) ? esc_attr($new_instance['style']) : '';

        return $instance;
    }

}

function pearl_register_contacts_widget()
{
    register_widget('Pearl_Contacts_Widget');
}

add_action('widgets_init', 'pearl_register_contacts_widget');