<?php

class STM_WP_Widget_Post_Type_List extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'stm_wp_widget_post_type_list',
            'description' => esc_html__('STM Post Type List', 'pearl')
        );
        $control_ops = array('width' => 400, 'height' => 350);
        parent::__construct('stm_wp_widget_projects', esc_html__('STM Post Type List', 'pearl'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $num = (empty($instance['num'])) ? '3' : $instance['num'];
        $image_size = (empty($instance['size'])) ? '70x70' : $instance['size'];
        $post_type = (empty($instance['post_type'])) ? 'post' : $instance['post_type'];
        $style = (empty($instance['style'])) ? 'style_1' : $instance['style'];

        pearl_add_widget_style('post_list', $style);

        $post_status = ($post_type !== 'attachment') ? 'publish' : 'inherit';

        $post_type = sanitize_title($post_type);

        $global_id = get_the_ID();

		$taxonomy_name = 'post_category_' . $post_type;
		$term = (!empty($instance[$taxonomy_name])) ? $instance[$taxonomy_name] : '';

        $q_args = array(
            'post_type' => $post_type,
            'posts_per_page' => intval($num),
            'post_status'    => $post_status,
        );

		$taxonomy = pearl_get_post_type_taxonomy($post_type);

		if(!empty($term)) {
			$q_args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'id',
					'terms'    => $term,
				),
			);
		}

        echo html_entity_decode($args['before_widget']);
        if (!empty($title)) {
            echo html_entity_decode($args['before_title'] . $title . $args['after_title']);
        }

        $q = new WP_Query($q_args);

        if ($q->have_posts()): ?>
            <div class="stm_post_type_list stm_post_type_list_<?php echo esc_attr($style); ?>">
                <?php while ($q->have_posts()): $q->the_post();
                    $id = get_the_ID();

                    $active = ($id == $global_id) ? 'active' : '';

                    $img_id = ($post_type !== 'attachment') ? get_post_thumbnail_id($id) : $id;
                    $image = get_the_post_thumbnail(get_the_ID(), $image_size);
                    if(function_exists('pearl_get_VC_img')) {
                        $image = pearl_get_VC_img($img_id, $image_size);
                    }
                    if(!empty($taxonomy)) {
                        $terms = wp_get_post_terms($id, $taxonomy);
                        if (!is_wp_error($terms) and !empty($terms)) {
                            $terms = wp_list_pluck($terms, 'name');
                        }
                    }

                    $minimize = ($style == 'style_2') ? 40 : 35;

                    $format = get_post_format();
                    $classes = array(
                        'stm_post_type_list__single no_deco ic ttc clearfix',
                        $active,
                        $format
                    );

                    ?>
                    <a href="<?php the_permalink(); ?>"
                       class="<?php echo esc_attr(implode(' ', $classes)); ?>"
                       title="<?php the_title(); ?>">
                        <?php if(!empty($image)): ?>
                            <div class="stm_post_type_list__image">
                                <?php echo html_entity_decode($image); ?>
                            </div>
                        <?php endif; ?>
                        <div class="stm_post_type_list__content stc_b">
                            <h4 class="ttc text-uppercase stm_animated">
                                <?php echo pearl_minimize_word(get_the_title(), $minimize); ?>
                            </h4>
                            <?php if(!empty($terms)): ?>
                                <div class="stm_post_type_list__terms mtc">
                                    <?php echo esc_attr(implode(', ', $terms)); ?>
                                </div>
                            <?php endif; ?>
                            <div class="stm_post_type_list__excerpt">
                                <p><?php echo pearl_minimize_word(get_the_excerpt(), 110); ?></p>
                            </div>
                        </div>
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

        return $instance;
    }

    public function form($instance)
    {
        $title = (!empty($instance['title'])) ? $instance['title'] : '';
        $num = (!empty($instance['num'])) ? $instance['num'] : '';
        $size = (!empty($instance['size'])) ? $instance['size'] : '';
        $post_type = (!empty($instance['post_type'])) ? $instance['post_type'] : '';
        $post_types = get_post_types();
        $styles = pearl_load_styles(1);
        $styles = $styles['value'];
        $instance['style'] = (!empty($instance)) ? $instance : 'style_1';
        $style_current = $instance['style'];
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'pearl'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr(esc_attr($title)); ?>"/>
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

function pearl_register_stm_post_type_list_widget()
{
    register_widget('STM_WP_Widget_Post_Type_List');
}

add_action('widgets_init', 'pearl_register_stm_post_type_list_widget');