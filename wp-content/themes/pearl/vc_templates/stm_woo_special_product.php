<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

pearl_add_element_style('woo_special_product', $style);


$product = wc_get_product($product_id);

if ($product):

	$attachment_ids[0] = get_post_thumbnail_id($product_id);
	$attachment = wp_get_attachment_image_src($attachment_ids[0], 'full');

	if (!empty($datepicker) and !empty($timepicker)) {
		wp_enqueue_script('jquery.countdown');

		$today = date("Y/m/d");
		$date_format = (!empty($atts['stm_date_format'])) ? $atts['stm_date_format'] : 'Y/m/d';
		$time_format = (!empty($atts['stm_time_format'])) ? $atts['stm_time_format'] : 'H:i';

		$real_day = strtotime($today);
		$date_end = strtotime($datepicker);
		$time_end = strtotime($timepicker);

		$count = rand(0, 999999);
	}

	$height = ($height !== '') ? $height : 0;
	$height_tablet_landscape = (empty($height_tablet_landscape)) ? $height : $height_tablet_landscape;
	$height_tablet = ($height_tablet !== '') ? $height_tablet : $height;
	$height_mobile = ($height_mobile !== '') ? $height_mobile : $height_tablet;
	?>
    <div class="woocommerce stm_special_offer <?php echo esc_attr($block_size); ?> <?php echo esc_attr($css); ?>"
		 <?php if ($block_size == 'big_size'): ?>style="background: url('<?php echo $attachment[0]; ?>') no-repeat 0 0;"<?php endif; ?>>

		<?php if (!empty($content) and $block_size == 'big_size'): ?>
            <div class="special_offer_product__title">
				<?php echo wpb_js_remove_wpautop($content, true); ?>
            </div>
            <div class="spacer-offer-product-lg" style="<?php echo esc_attr("height: {$height}px;") ?>"></div>
            <div class="spacer-offer-product-md"
                 style="<?php echo esc_attr("height: {$height_tablet_desktop}px;") ?>"></div>
            <div class="visible-sm_landscape"
                 style="<?php echo esc_attr("height: {$height_tablet_landscape}px;") ?>"></div>
            <div class="visible-sm" style="<?php echo esc_attr("height: {$height_tablet}px;") ?>"></div>
            <div class="visible-xs" style="<?php echo esc_attr("height: {$height_mobile}px;") ?>"></div>
		<?php endif; ?>

        <div class="special_offer_product__meta_box">
			<?php if ($block_size == 'normal_size'): ?>
                <div class="special_offer_product__thumbnail">
                    <div class="special_offer_product__title">
						<?php esc_html_e('Special offer', 'pearl'); ?>
                    </div>
                    <img src="<?php echo $attachment[0]; ?>" alt=""/>
                </div>
			<?php endif; ?>

			<?php if (!empty($datepicker) and !empty($timepicker)): ?>
				<?php if ($date_end > $real_day): ?>
                    <div class="special_offer_product__countdown">
                        <div id="<?php echo $count; ?>" class="special_offer_countdown"></div>
                        <script type="text/javascript">
                            (function ($) {
                                $(document).ready(function () {
                                    $('#<?php echo $count; ?>').countdown('<?php echo date_i18n($date_format, $date_end); ?> <?php echo date_i18n($time_format, $time_end); ?>', function (event) {
                                        $(this).html(event.strftime('<div class="count_meta"><div class="count_meta_info">%D<div>days</div></div></div> <div class="count_meta"><div class="count_meta_info">%H <div>hours</div></div></div> <div class="count_meta"><div class="count_meta_info">%M<div>minuts</div></div></div> <div class="count_meta"><div class="count_meta_info">%S<div>seconds</div></div></div>'));
                                    });
                                });
                            })(jQuery);
                        </script>
                    </div>
				<?php else: ?>
                    <div class="special_offer_countdown_out">
						<?php esc_html_e('Time is up, sorry!', 'pearl'); ?>
                    </div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (!empty($product_id)): ?>
                <div class="special_offer_product__meta">
                    <h5 class="woocommerce-loop-product__title no_line"><a
                                href="<?php echo get_permalink($product_id); ?>"><?php echo get_the_title($product_id); ?></a>
                    </h5>
                    <div class="price">
						<?php echo $product->get_price_html(); ?>
                    </div>
                </div>
			<?php endif; ?>

        </div>

    </div>

<?php endif;