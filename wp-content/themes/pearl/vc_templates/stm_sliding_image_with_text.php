<?php

/**
 * @var $content
 * @var $link
 */

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$classes = array('stm_sliding_image_text clearfix');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = $style;

pearl_add_element_style('sliding_images_with_text', $style);
wp_enqueue_script('pearl_sliding_images_vertical');
wp_enqueue_script('lazysizes');

$img_size_right = (!empty($img_size_right)) ? $img_size_right : '273x546';

if(empty($image_right)) {
    $image_right = 'pen';
}

if(!empty($image_right)): ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

		<?php
		$props = pearl_get_image_proportion($img_size_right, true);
		$image_width = "style='width:{$props[0]}px;'";

		$item_padding = pearl_get_image_proportion($img_size_right);
		?>

        <div class="stm_sliding_image_text__image"
			<?php echo $image_width; ?>>
            <div class="stm_lazyload_image stm_lazyload_image__preloader"
                 style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
                <?php if($image_right == 'pen'):
                    $src = get_template_directory_uri() . '/assets/img/' . 'pen.png';
                    ?>
                    <img data-src="<?php echo esc_url($src); ?>" class="lazyload" />
                <?php else: ?>
				    <?php echo pearl_lazyload_image($image_right, $img_size_right, true); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="stm_sliding_image_text__content">
			<?php echo wpb_js_remove_wpautop($content, true); ?>
        </div>


    </div>

<?php endif; ?>

