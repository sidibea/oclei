<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$uniq = uniqid('stm_vertical_carousel');
$classes = array('stm_vertical_carousel', 'stm_lightgallery');
$classes[] = 'stm_vertical_carousel_' . $style;
$classes[] = $uniq;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

wp_enqueue_style('slick.js');
wp_enqueue_script('slick.js');
wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');
wp_enqueue_script('pearl_vertical_carousel');



$image_size = (!empty($image_size)) ? $image_size : '205x154';
$slides_to_show = array(
  'mobile' => !empty($tablet_number) ? $tablet_number : 4,
  'tablet' => !empty($mobile_number) ? $mobile_number : 3
);

$inline = '';
$width = explode('x', $image_size);
if(!empty($width[0])) {
    $inline = ".{$uniq} .inner {
        width: {$width[0]}px;
    }";
}

pearl_add_element_style('vertical_carousel', $style, $inline);


if(!empty($images)) $images = explode(',', $images);

if(!empty($images) and is_array($images)): ?>
    <div class="stm_vertical_carousel__wrapper">
        <div class="<?php echo implode(' ', $classes); ?>"
             data-slides-to-show-tablet="<?php echo esc_attr($slides_to_show['tablet']); ?>"
             data-slides-to-show-mobile="<?php echo esc_attr($slides_to_show['mobile']); ?>">
            <div class="inner">
                <?php foreach($images as $image):
                    $full_image = pearl_get_image_url($image);
                    ?>
                    <a href="<?php echo esc_url($full_image); ?>" class="stm_vertical_carousel__item stm_lightgallery__selector">
                        <?php echo html_entity_decode(pearl_get_VC_img($image, $image_size)); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



<?php endif; ?>