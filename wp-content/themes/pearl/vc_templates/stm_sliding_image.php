<?php

/**
 * @var $content
 * @var $link
 */

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);


$classes = array('stm_sliding_images');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = $style;

pearl_add_element_style('sliding_images', $style);
wp_enqueue_script('lazysizes');
wp_enqueue_script('pearl_sliding_images');

$img_size_left = (!empty($img_size_left)) ? $img_size_left : '257x555';
$img_size_right = (!empty($img_size_right)) ? $img_size_right : '273x546';

if (!empty($image_left) and !empty($image_right)) : ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <?php
        $props = pearl_get_image_proportion($img_size_left, true);
        $image_width = "style='width:{$props[0]}px;'";

        $item_padding = pearl_get_image_proportion($img_size_left);
        ?>
        <div class="stm_sliding_image stm_sliding_image__left"
              <?php echo $image_width; ?>>
            <div class="stm_lazyload_image stm_lazyload_image__preloader"
                 style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
                <?php echo pearl_lazyload_image($image_left, $img_size_left, true); ?>
            </div>
        </div>

		<?php
    $props = pearl_get_image_proportion($img_size_right, true);
    $image_width = "style='width:{$props[0]}px;'";

    $item_padding = pearl_get_image_proportion($img_size_right);
    ?>

        <div class="stm_sliding_image stm_sliding_image__right"
			<?php echo $image_width; ?>>
            <div class="stm_lazyload_image stm_lazyload_image__preloader"
                 style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
				<?php echo pearl_lazyload_image($image_right, $img_size_right, true); ?>
            </div>
        </div>


    </div>

<?php endif; ?>

