<?php

/**
 * @var $content
 * @var $link
 */

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$classes = array('stm_tilting_images tilter');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = $style;

pearl_add_element_style('tilting_images', $style);
wp_enqueue_script('tilt.js');
wp_enqueue_script('lazysizes');
wp_enqueue_script('pearl_tilt_fn');

$img_size_top = (!empty($img_size_top)) ? $img_size_top : '531x354';
$img_size_bottom = (!empty($img_size_bottom)) ? $img_size_bottom : '405x249';

if(!empty($image_top) and !empty($image_bottom)): ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <figure class="tilter__figure">
            <?php
			$props = pearl_get_image_proportion($img_size_top, true);
			$image_width = "style='width:{$props[0]}px;'";

			$item_padding = pearl_get_image_proportion($img_size_top);
            ?>
            <div class="stm_tilting_image stm_tilting_image__top"
				<?php echo $image_width; ?>>
                <div class="stm_lazyload_image stm_lazyload_image__preloader"
                     style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
					<?php echo pearl_lazyload_image($image_top, $img_size_top, true); ?>
                </div>
            </div>
			<?php
			$props = pearl_get_image_proportion($img_size_bottom, true);
			$image_width = "style='width:{$props[0]}px;'";

			$item_padding = pearl_get_image_proportion($img_size_bottom);
			?>
            <div class="tilter__caption">
                <div class="stm_tilting_image stm_tilting_image__bottom"
					<?php echo $image_width; ?>>
                    <div class="stm_lazyload_image stm_lazyload_image__preloader"
                         style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
						<?php echo pearl_lazyload_image($image_bottom, $img_size_bottom, true); ?>
                    </div>
                </div>
            </div>
        </figure>
    </div>

<?php endif; ?>

