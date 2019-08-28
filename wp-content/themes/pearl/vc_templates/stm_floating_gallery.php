<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$classes = array('stm_floating_gallery stm_floating_gallery_' . $style . ' stm_lightgallery');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('floating_gallery', $style);

wp_enqueue_style('flickity.css');
wp_enqueue_script('flickity.js');

if (!empty($images)):
    $images = explode(',', $images);
    if(is_array($images)):
        $images = array_chunk($images, 2);
    ?>
        <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
            <div class="inner"
                 data-flickity='{ "autoPlay": 1500, "lazyLoad": 2, "initialIndex": 2, "pageDots": false, "prevNextButtons": false, "contain": true, "wrapAround": true, "freeScroll": true }'>
                <?php
                foreach($images as $chunks): ?>

                    <div class="stm_floating_gallery__cell">
                        <?php foreach($chunks as $image): ?>
                            <?php $image_url = pearl_get_image_url($image); ?>
                            <img data-flickity-lazyload="<?php echo esc_url($image_url); ?>" />
                        <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
	<?php endif;
endif;