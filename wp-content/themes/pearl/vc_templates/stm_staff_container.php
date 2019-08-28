<?php

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract( $atts );

pearl_add_element_style('staff/' . $layout, $style);


/**
 * @var $layout string grid || list
 * @var $style string
 * @var $cols string columns
 */

$uniq = uniqid('stm_staff_container');

$classes = array("stm_staff_container", $style);
$classes[] = $uniq;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

if(pearl_check_string($carousel)) $classes[] = 'stm_staff_container__carousel';

if ($layout === 'list') {
	$cols = 1;
}

$cols = intval(12 / $cols);

$images_qty = 12/$cols;

$child_atts = 'style="' . $style . '" layout="' . $layout . '" col="' . $cols . '" ';


if (!empty($content)) :

	$content = str_replace('stm_staff ', 'stm_staff ' . $child_atts, $content); //adding parent atts to child shortcode
	$content = str_replace('stm_staff_cta', 'stm_staff_cta ' . $child_atts, $content); //adding parent atts to child shortcode
	?>

	<div class="stm_staff_container_<?php echo esc_attr($layout) ?> <?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="row">
			<?php echo wpb_js_remove_wpautop($content); ?>
		</div>
	</div>


    <!--Carousel for all styles-->
    <?php if(pearl_check_string($carousel)):
        wp_enqueue_style('owl-carousel2');
        wp_enqueue_script('pearl-owl-carousel2');
        $autoplay = (!empty($autoplay) and $autoplay === 'true') ? 'true' : 'false';
		$arrows = (!empty($carousel_arrows) and $carousel_arrows === 'true') ? 'true' : 'false';
        ?>
        <script type="text/javascript">
            (function($){
                $(document).ready(function(){

                    var owlRtl = false;
                    if ($('body').hasClass('rtl')) {
                        owlRtl = true;
                    }

                    var $carousel = $('.<?php echo esc_js($uniq); ?> .row');
                    $carousel.owlCarousel({
                        rtl: owlRtl,
                        items: <?php echo esc_js($images_qty) ?>,
                        dots: false,
                        nav: <?php echo esc_js($arrows) ?>,
                        autoplay: <?php echo esc_js($autoplay); ?>,
                        loop: true,
                        slideBy: 1,
                        smartSpeed: 800,
						responsive:{
							0: {
								items: 1,
							},
							568: {
								items: 2,
							},
							667: {
								items: 2,
							},
							768:{
								items: <?php echo (intval($images_qty) > 1) ? 2 : intval($images_qty); ?>,
							},
							1000:{
								items: <?php echo intval($images_qty); ?>
							}
						},
                        navText: '',
                    })
                });
            })(jQuery);
        </script>
    <?php endif;
endif;




