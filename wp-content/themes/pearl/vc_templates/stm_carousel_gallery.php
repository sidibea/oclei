<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);


/**
 * @var $images array of images
 * @var $images_effect
 * @var $image_size string
 * @var $carousel_width string
 * @var $lightgallery string
 * @var $images_qty string images to show
 * @var $autoscroll string enable autoscroll
 * @var $thumbnails string enable thumbnails
 * @var $thumbnails_num string number of thumbnails
 * @var $description string enable image description
 * @var $pagination string
 * @var $navigation string
 * @var $images_margin string
 * @var $style string
 * @var $dots string
 * @var $dots_pos string right, bottom
 *
 */

$classes = array('stm_carousel stm_carousel_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('carousel', $style);

wp_enqueue_style('owl-carousel2');
wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');

$carousel = 'stm_carousel_' . pearl_random();
$carousel_1 = 'stm_carousel1_' . pearl_random();
$carousel_2 = 'stm_carousel2_' . pearl_random();

$carousel_style_string = '';

$images = !empty($images) ? explode(',', $images) : '';
$image_size = !(empty($image_size)) ? $image_size : '1110x500';

/*Carousel Settings*/
$autoscroll = (!empty($autoscroll) and $autoscroll === 'enable') ? 'true' : 'false';
$description = (!empty($description) and $description === 'enable') ? true : false;
$pagination = (!empty($pagination) and $pagination === 'enable') ? true : false;
$navigation = (!empty($navigation) and $navigation === 'enable') ? 'true' : 'false';
$loop = (!empty($thumbnails)) && $thumbnails === 'enable' ? 'false' : 'true';
$thumbnails = (!empty($thumbnails) and $thumbnails === 'enable') ? true : false;
$lightgallery = (!empty($lightgallery) and $lightgallery === 'enable') ? true : false;
$images_qty = empty($images_qty) ? 1 : $images_qty;
$images_margin = empty($images_margin) ? 0 : $images_margin;
$dots = (!empty($dots) && $dots === 'enable') ? 'true' : 'false';

$classes[] = (pearl_check_string($navigation)) ? 'navigation_on' : 'navigation_off';

$thumbnails_num = (!empty(intval($thumbnails_num))) ? intval($thumbnails_num) : 6;

$image_size_small = (!empty($image_size_small)) ? $image_size_small : $image_size;

if (!empty($images_effect) && $images_effect !== 0) {
	switch ($images_effect) {
		case 'grayscale' :
			wp_add_inline_style('pearl-row_style_1', "
                #{$carousel} .stm_carousel__single img {filter: grayscale(100%);}
                #{$carousel} .stm_carousel__single:hover img {filter: grayscale(0)}
            ");
			break;
		case 'opacity' :
			wp_add_inline_style('pearl-row_style_1', "
                #{$carousel} .stm_carousel__single img {opacity: 0.65;}
                #{$carousel} .stm_carousel__single:hover img {opacity: 1}
            ");
			break;
	}
}

$classes[] = 'stm_carousel_dots_' . $dots_pos;


if (!empty($carousel_width)) {
	$carousel_style_string .= "#{$carousel} {width: {$carousel_width} !important}";
}

if (!empty($carousel_style_string)) {
	wp_add_inline_style('pearl-row_style_1', $carousel_style_string);
}

if (!empty($images)): ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>" id="<?php echo esc_attr($carousel); ?>">

		<?php if(!empty($bordered) && $bordered == 'enable'): ?>
            <div class="stm_bordered_carousel">
                <div class="stm_bordered_carousel__pseudo"></div>
        <?php endif; ?>

        <div class="stm_carousel__big stm_lightgallery">
            <div id="<?php echo esc_attr($carousel_1); ?>" class="stm_owl_navRight">
				<?php foreach ($images as $image): ?>
				<?php if (!empty($image)): ?>
                <div class="stm_carousel__single stm_carousel__single_big stm_owl__glitches">

					<?php if ($lightgallery): ?>
                    <a href="<?php echo esc_url(pearl_get_image_url($image)); ?>"
                       title="<?php echo sanitize_text_field(get_the_title($image)); ?>"
                       class="no_deco stm_lightgallery__selector <?php echo esc_attr($lightgallery); ?>"
                       data-sub-html="<?php echo sanitize_text_field(get_the_title($image)); ?>">
						<?php else: ?>
                        <div class="">
							<?php endif; ?>


                                <?php if(!empty($retina) && $retina == 'enable' ) {
                                    echo html_entity_decode(pearl_get_VC_img($image, $image_size));
                                } else {
								    echo wp_kses_post(pearl_get_VC_img($image, $image_size));
                                }
							    ?>

							<?php if ($description): ?>
                                <div class="stm_carousel__description">
                                    <div class="stm_carousel__title wtc">
										<?php echo sanitize_text_field(get_the_title($image)); ?>
                                    </div>
                                </div>
							<?php endif; ?>

							<?php if ($lightgallery): ?>
                    </a>
					<?php else: ?>
                </div>
			<?php endif; ?>

            </div>
			<?php endif; ?>
			<?php endforeach; ?>
        </div>

        <?php if(!empty($bordered) && $bordered == 'enable'): ?>
            </div>
        <?php endif; ?>

		<?php if ($pagination): ?>
            <div class="stm_carousel__pagination">
                <span class="current mtc">1</span>
                <span class="sep wtc">/</span>
                <span class="total wtc"><?php echo intval(count($images)); ?></span>
            </div>
		<?php endif; ?>
    </div>

	<?php if ($thumbnails): ?>
        <div class="stm_carousel__small">
            <div id="<?php echo esc_attr($carousel_2); ?>" class="stm_owl_navRight">
				<?php foreach ($images as $image): ?>
					<?php if (!empty($image)): ?>
                        <div class="stm_carousel__single stm_carousel__single_small stm_owl__glitches">
							<?php echo html_entity_decode(pearl_get_VC_img($image, $image_size_small)); ?>
                        </div>
					<?php endif; ?>
				<?php endforeach; ?>
            </div>
        </div>
	<?php endif; ?>

    </div>

    <!--Carousel initialization-->

	<?php ob_start(); ?>
        (function ($) {
            "use strict";
            $(window).load(function () {
                var carousel = '<?php echo esc_js($carousel); ?>';
                var big_carousel = '<?php echo esc_js($carousel_1); ?>';
                var small_carousel = '<?php echo esc_js($carousel_2); ?>';
                var small_carousel_item = '.stm_carousel__small #' + small_carousel + ' .owl-item';

                var flag = false;
                var duration = 800;

                var owlRtl = false;
                if ($('body').hasClass('rtl')) {
                    owlRtl = true;
                }

				<?php
				$tablet_landscape = intval($images_qty);
				$tablet_landscape = ($tablet_landscape > 4) ? $tablet_landscape - 1 : $tablet_landscape;

				$tablet_num = intval($images_qty);
				$tablet_num = ($tablet_num > 4) ? '4' : $tablet_num;

				$mobile_num = ($images_qty > 2) ? intval($images_qty - 2) : $images_qty;
				$mobile_num = ($mobile_num > 3) ? '3' : $mobile_num;
				?>

                var owl_big = $('#' + big_carousel).owlCarousel({
                    rtl: owlRtl,
                    items: <?php echo esc_js($images_qty) ?>,
                    dots: <?php echo esc_js($dots)?>,
                    nav: <?php echo esc_js($navigation)?>,
                    slideBy: 1,
                    margin: <?php echo esc_js(intval($images_margin)) ?>,
                    smartSpeed: 800,
                    autoplay: <?php echo esc_js($autoscroll); ?>,
                    navText: '',
                    loop: <?php echo esc_js($loop) ?>,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        550: {
                            items: <?php echo intval($mobile_num); ?>
                        },
                        768: {
                            items: <?php echo intval($tablet_num); ?>
                        },
                        900: {
                            items: <?php echo intval($tablet_landscape); ?>
                        },
                        1025: {
                            items: <?php echo intval($images_qty); ?>
                        }
                    }
                }).on('changed.owl.carousel', function (e) {
                    var currentSlide = (parseFloat(e.item.index) + 1);
                    var currentSpan = '#' + carousel + ' .stm_carousel__pagination .current';
                    $(currentSpan).text(currentSlide);

                    $(small_carousel_item).find('.stm_carousel__single').removeClass('current');
                    $(small_carousel_item).eq(e.item.index).find('.stm_carousel__single').addClass('current');

                    if (!flag) {
                        flag = true;
                        owl_small.trigger('to.owl.carousel', [e.item.index, duration, true]);
                        flag = false;
                    }
                });

                var owl_small = $('#' + small_carousel).owlCarousel({
                    rtl: owlRtl,
                    items: <?php echo intval($thumbnails_num); ?>,
                    dots: false,
                    nav: false,
                    slideBy: 1,
                    smartSpeed: 800,
                    navText: '',
                    responsive: {
                        0: {
                            items: 2,
                        },
                        550: {
                            items: <?php echo ($thumbnails_num > 2) ? intval($thumbnails_num - 2) : $thumbnails_num; ?>
                        },
                        768: {
                            items: <?php echo ($thumbnails_num > 1) ? intval($thumbnails_num - 1) : $thumbnails_num; ?>
                        },
                        1000: {
                            items: <?php echo intval($thumbnails_num); ?>
                        }
                    }
                }).on('changed.owl.carousel', function (e) {
                    if (!flag) {
                        flag = true;
                        owl_big.trigger('to.owl.carousel', [e.item.index, duration, true]);
                        flag = false;
                    }
                }).on('click', '.owl-item', function (event) {
                    owl_big.trigger('to.owl.carousel', [$(this).index(), 400, true]);
                });

            });
        })(jQuery);
<?php
$script = ob_get_clean();
wp_add_inline_script('pearl-theme-scripts', $script);
endif; ?>