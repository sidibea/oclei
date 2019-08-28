<?php


if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}


class Stm_Slider
{

	private $post_type_name = STM_SLIDER_POST_TYPE;

	private $stm_slider_meta_name = STM_SLIDER_META_NAME;

	private $stm_slider_slide_meta_name = STM_SLIDER_SLIDE_META_NAME;

	private $autplay_duration = 5000;
	private $height = '700';
	private $width = '100';
	private $autoplay = false;
	private $slider_style = 'style_1';
	private $heightUnit = 'px';
	private $widthUnit = '100';

	private $slides = array();
	private $slider_options = array();
	private $fields_styles = array();
	private $fields_aligns = array();
	private $transition = array(
		'in'  => 'fadeIn',
		'out' => 'fadeOut'
	);

	private $pattern = false;

	private $loop = 'true';
	private $slide_id;
	private $args;

	function __construct($slider_id = null, $args = array())
	{
		$this->slide_id = $slider_id;
		$this->args = $args;
		$this->init();
		$this->slides = $this->get_slides();
		$this->slider_options = $this->get_slider_options();
		$this->fields_styles = $this->get_fields_styles();

		if (count($this->slides) === 1) {
			$this->loop = 'false';
		}
	}

	private function init()
	{
		$this->enqueue();
	}


	private function enqueue()
	{
		wp_register_style('stm_slider', STM_SLIDER_URL . '/assets/styles/main.css', array(), STM_SLIDER_VERSION);
		wp_enqueue_style('owl.carousel', STM_SLIDER_URL . '/assets/vendor/owl.carousel/dist/assets/owl.carousel.css', array(), STM_SLIDER_VERSION);
		wp_enqueue_style('animate.css', STM_SLIDER_URL . '/assets/vendor/animate.css/animate.css', array(), STM_SLIDER_VERSION);
		wp_enqueue_style('owl.theme.default', STM_SLIDER_URL . '/assets/vendor/owl.carousel/dist/assets/owl.theme.default.css', array(), STM_SLIDER_VERSION);
		wp_enqueue_script('owl.carousel', STM_SLIDER_URL . '/assets/vendor/owl.carousel/dist/owl.carousel.js', array('jquery'), STM_SLIDER_VERSION, true);
		wp_enqueue_style('stm_slider');

		wp_add_inline_style('stm_slider', $this->print_slider_styles());
	}


	private function get_slider_options()
	{
		$options = get_post_meta($this->slide_id, $this->stm_slider_meta_name, true);

		if (isset($options['autoplayDuration'])) {
			$this->autplay_duration = $options['autoplayDuration'];
		}

		if (isset($options['autoplay'])) {
			$this->autoplay = $options['autoplay'];
		}

		if (isset($options['height'])) {
			$this->height = intval($options['height']);
		}

		if (isset($options['width'])) {
			$this->width = intval($options['width']);
		}

		$this->slider_style = isset($options['style']) ? $options['style'] : 'style_1';


		return $options;
	}

	public function get_sliders()
	{

		$args = array(
			'post_type'      => $this->post_type_name,
			'posts_per_page' => -1,
			'post_status'    => ['draft', 'publish'],
			'orderBy'        => 'id',
			'order'          => 'ASC',
			'post_parent'    => 0,
		);

		$q = get_posts($args);

		return $q;
	}

	public function get_slides()
	{

		$args = array(
			'post_type'      => $this->post_type_name,
			'post_parent'    => $this->slide_id,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'posts_per_page' => -1
		);


		$slides_posts = get_posts($args);


		$slider_data = array();
		foreach ($slides_posts as $slides_post) {
			$meta = get_post_meta($slides_post->ID, 'stm_slider_slide_settings', true);
			if ($meta === null) {
				$meta = array();
			}
			$slider_data[$slides_post->ID] = $meta;
		}


		return apply_filters('stm_slider_settings', $slider_data);
	}

	private function print_slider_styles()
	{
		$slides = $this->get_slides();
		$slider_options = $this->get_slider_options();

		$custom_css = '';


		if (!empty($slider_options['hideOnMobile']) && $slider_options['hideOnMobile'] == 'true') {
			$breakpoint = isset($slider_options['mobileHideUnder']) ? $slider_options['mobileHideUnder'] : 480;
			$custom_css .= "@media (max-width: {$breakpoint}px) {.stm_slider, .stm_slider_thumbs_container {display: none !important;}}";
		}
		if (!empty($slider_options['hideOnTablet']) && $slider_options['hideOnTablet'] == 'true') {
			$breakpoint = isset($slider_options['tabletHideUnder']) ? $slider_options['tabletHideUnder'] : 1024;
			$custom_css .= "@media (max-width: {$breakpoint}px) {.stm_slider, .stm_slider_thumbs_container {display: none !important;}}";
		}


		foreach ($slides as $slide) {
			if (!empty($slide['overlayColor']) && $slide['overlay'] == 'true') {
				$slide_number = $slide['order'];
				$slide_overlay_bg = $slide['overlayColor'];
				$custom_css .= ".slide_{$slide_number}::before {background-color: {$slide_overlay_bg}}\n";
			};
		}

		$autoplay_timeout = $this->autplay_duration / 1000 + 0.8;

		if ($this->autoplay) {
			$custom_css .= ".stm_slide_thumb.active .stm_slider_progress_bar {animation-duration: {$autoplay_timeout}s}\n";
		}

		if (isset($slider_options['widthUnit'])) {
			$this->widthUnit = $slider_options['widthUnit'];
		}
		if (isset($slider_options['heightUnit'])) {
			$this->heightUnit = $slider_options['heightUnit'];
		}


		if ($this->widthUnit === 'px') {
			$this->width = intval($this->width) . 'px';
		} elseif ($this->widthUnit === 'percent') {
			$this->width = intval($this->width) . '%';
		}
		if (intval($this->width) === 0) {
			$this->width = '100%';
		}

		$custom_css .= ".stm_slider {width: {$this->width} !important}\n";


		if ($this->heightUnit === 'px') {
			$this->height = intval($this->height) . 'px';
		} elseif ($this->heightUnit === 'percent') {
			$this->height = intval($this->height) . 'vh';
		}

		if (intval($this->height) === 0) {
			$this->height = '700px';
		}


		$custom_css .= ".stm_slider, .stm_slider .stm_slide {height: {$this->height} !important}\n";


		return apply_filters('stm_print_slider_styles', $custom_css);
	}

	public function build_button($args)
	{
		$button = '';

		$label = isset($args['label']) ? $args['label'] : '';
		$link = isset($args['link']) ? $args['link'] : '#';
		$style = !empty($this->fields_styles['button']) ? 'style="' . esc_attr($this->fields_styles['button']) . '"' : '';

		if (!empty($label)) {
			$button = '<a class="btn btn_solid btn_primary btn_left btn_icon-bg btn_icon-right"  href="' . $link . '" ' . $style . '>' . $label . '</a>';
		}

		return $button;
	}

	private function load_custom_fonts()
	{

		$fonts = array();
		$font_families = array();
		$options = array(
			'titleOptions', 'contentOptions', 'buttonOptions'
		);
		$weights = '300,400,500,600,700,800,900';
		$subsets = 'latin,latin-ext';

		$i = 1;
		foreach ($this->slides as $slide) {
			foreach ($options as $option) {
				if (!empty($slide[$option]['ff']) && $slide[$option]['ff'] !== 'false' && !in_array($slide[$option]['ff'], $fonts)) {
					$font = $slide[$option]['ff'];
					$font_families[] = "{$font}:{$weights}";
				}
			}
		}

		if (!empty($font_families)) {
			$query_args = array(
				'family' => urlencode(implode('|', $font_families)),
				'subset' => urlencode($subsets)
			);

			$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

			wp_enqueue_style('stm_slider_font', $fonts_url, array(), STM_SLIDER_VERSION);
		}
	}

	private function get_fields_styles()
	{
		$field_options = array(
			'title'   => 'titleOptions',
			'content' => 'contentOptions',
			'button'  => 'buttonOptions'
		);

		foreach ($this->slides as $slide_key => $slide) {
			foreach ($field_options as $field => $field_option) {
				if (isset($slide[$field_option])) {
					if (empty($slide[$field_option]['align'])) {
						$slide[$field_option]['align'] = 'center';
					}
					if (empty($slide[$field_option])) continue;


					foreach ($slide[$field_option] as $key => $value) {
						if (!empty($slide[$field_option][$key]) && $slide[$field_option][$key] !== 'false') {

							switch ($key) {
								case 'fi' :
									$this->fields_styles[$field] .= 'font-style: italic !important;';
									break;
								case 'fw' :
									$this->fields_styles[$field] .= 'font-weight: bold !important;';
									break;
								case 'fsz' :
									$this->fields_styles[$field] .= 'font-size:' . $slide[$field_option][$key] . 'px!important;';
									break;
								case 'fu' :
									$this->fields_styles[$field] .= 'text-decoration: underline!important;';
									break;
								case 'ff' :
									$this->fields_styles[$field] .= 'font-family: "' . $slide[$field_option][$key] . '";';
									break;
								case 'color' :
									$this->fields_styles[$field] .= 'color: ' . $slide[$field_option][$key] . '!important;';
									break;
								case 'align' :
									$this->fields_aligns[$slide_key][$field] = $slide[$field_option][$key] . ';';
									break;
							}
						}
					}
				}
			}
		}


		return $this->fields_styles;
	}


	public function print_slider()
	{
		$this->load_custom_fonts();
		$slider_options = $this->slider_options;
		$slides = $this->slides;

		$slider_options['source'] = (!empty($slider_options['source'])) ? $slider_options['source'] : 'custom';

		$dims = "1920x" . intval($this->height);

		$slider_classes = array('stm_slider', 'owl-carousel');

		if (!empty($slider_options['image_size'])) {
			$dims = $slider_options['image_size'];
			$slider_classes[] = 'stm_slider_precise_image';
		}

		if (!empty($slider_options['overflow_elements']) && $slider_options['overflow_elements'] == 'true') {
			$slider_classes[] = 'stm_slider__overflowed';
		}

		$slider_classes[] = $slider_options['source'];

		if (!empty($this->args['slider_style'])) {
			$slider_classes[] = 'stm_slider_' . $this->args['slider_style'];
		}

		$is_autoplay = $this->autoplay;

		if ($slider_options['source'] == 'posts') {
			$count = (!empty($slider_options['posts_count'])) ? $slider_options['posts_count'] : 4;
			$post_slides = (!empty($slider_options['post_slides'])) ? $slider_options['post_slides'] : array();
			$slides = $this->get_post_slides($count, $post_slides);
		}

		if (!empty($slides) and !empty(array_filter($slides))) {
			$slides = array_filter($slides);
			$attr_id = uniqid('stm_slider-');
			$nav_container_classes = array('stm_slider_thumbs_container', 'stm_slider_navigation');

			$nav_item_classes = array('stm_slide_thumb', 'tbc');


			if (empty($this->args['before_slider'])) {
				$this->args['before_slider'] = '<div id = "' . $attr_id . '" class="' . implode(" ", $slider_classes) . '">';
			}

			if (empty($args['after_slider'])) {
				$args['after_alider'] = '</div>';
			}

			?>

            <div id="<?php echo $attr_id ?>" class="<?php echo implode(' ', $slider_classes) ?>">
				<?php
				foreach ($slides as $key => $slide) :
					if (!empty($slide['enable']) && $slide['enable'] === 'false') {
						continue;
					}


					$align = (!empty($slide['contentAlign'])) ? $slide['contentAlign'] : 'left';

					if (!empty($slider_options['source']) && $slider_options['source'] == 'posts') {
						$align = $this->fields_aligns[$key]['button'] = $this->fields_aligns[$key]['content'] = $this->fields_aligns[$key]['title'] = 'center';
					}

					$slide_number = $slide['order'];
					$slide_bg = '';

					if (isset($slide['imageId'])) {
						if (function_exists('pearl_get_VC_img')) {
							$image = pearl_get_VC_img($slide['imageId'], $dims, true);
						} else {
							$image = wp_get_attachment_image_url($slide['imageId'], 'full');
						};
						$slide_bg = "style='background-image: url({$image})'";
					}

					if (!empty($slide['patternId'])) {
						$this->pattern = wp_get_attachment_image_url($slide['patternId'], 'full');
					}

					?>

                    <div class="stm_slide slide_<?php echo $slide_number ?> text-<?php echo $align; ?>"
                         data-parallax="slide_<?php echo $slide_number ?>"
						<?php echo wp_kses_post($slide_bg); ?>>

						<?php if (!empty($this->pattern) && isset($slide['pattern']) && $slide['pattern'] !== 'false') : ?>
                            <div class="stm_slide__pattern"
                                 style="background-image: url(<?php echo esc_url($this->pattern); ?>)"></div>
						<?php endif; ?>

                        <div class="container">
                            <div class="stm_slide__overlay">

								<?php if (!empty($slide['category'])) : ?>
                                    <div class="stm_slide__category text-<?php echo esc_attr($this->fields_aligns[$key]['title']); ?>">
                                        <span class="">
                                            <?php echo $slide['category']; ?>
                                        </span>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($slide['title'])) : ?>
                                    <div class="stm_slide__title text-<?php echo esc_attr($this->fields_aligns[$key]['title']); ?>">
										<?php if ($slider_options['source'] == 'posts'): ?>
                                            <a href="<?php echo esc_url(get_permalink($slide['id'])); ?>"
                                               class="no_deco">
                                                <span class="heading_font" <?php echo !empty($this->fields_styles['title']) ? 'style="' . esc_attr($this->fields_styles['title']) . '"' : ''; ?>>
                                                    <?php echo $slide['title']; ?>
                                                </span>
                                            </a>
										<?php else: ?>
                                            <span class="heading_font" <?php echo !empty($this->fields_styles['title']) ? 'style="' . esc_attr($this->fields_styles['title']) . '"' : ''; ?>>
                                                <?php echo $slide['title']; ?>
                                            </span>
										<?php endif; ?>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($slide['content'])) : ?>
                                    <div class="stm_slide__content text-<?php echo esc_attr($this->fields_aligns[$key]['content']); ?>">
                                        <span <?php echo !empty($this->fields_styles['content']) ? 'style="' . esc_attr($this->fields_styles['content']) . '"' : ''; ?>>
                                            <?php echo $slide['content']; ?>
                                        </span>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($slide['date'])) : ?>
                                    <div class="stm_slide__date text-<?php echo esc_attr($this->fields_aligns[$key]['title']); ?>">
                                        <span class="">
                                            <?php echo $slide['date']; ?>
                                        </span>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($slide['button'])) :
									?>
                                    <div class="stm_slide__button text-<?php echo esc_attr($this->fields_aligns[$key]['button']); ?>">
										<?php echo $this->build_button($slide['button']); ?>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>

			<?php
			if (!empty($slider_options['navigation']) && $slider_options['navigation'] == 'true') {
				$thumbs_id = uniqid('stm_slider_thumbs-');
				?>
                <div id="<?php echo esc_attr($thumbs_id) ?>"
                     class="<?php echo esc_attr(implode(' ', $nav_container_classes)) ?>">
                    <div class="container">
                        <ul class="stm_slider_thumbs_list">
							<?php


							foreach ($slides as $slide) :
								if (!empty($slide) && isset($slide)) {


									$slide_number = $slide['order'];
									$nav_item_icon_class = '';
									if (!empty($slide['thumbnailIcon'])) {
										$nav_item_icon_class = 'stm_slide_thumb_icon';
									}
									?>
                                    <li class="<?php echo esc_attr(implode(' ', $nav_item_classes)) ?> slide_thumb_<?php echo $slide_number ?>">
										<?php if (!empty($nav_item_classes)) : ?>
											<?php if (!empty($slide['thumbnailIcon'])) : ?>
                                                <div class="<?php echo $nav_item_icon_class ?>">
												<span
                                                        class="<?php echo esc_attr($slide['thumbnailIcon']); ?> mtc"></span>
                                                </div>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($is_autoplay) : ?>
                                            <div class="stm_slider_progress_bar"></div>
										<?php endif; ?>
                                        <div class="stm_slide_thumb_body">
									<span class="stm_slide_thumb_heading">
							<?php if (isset($slide['thumbnailHeading'])) echo $slide['thumbnailHeading'] ?>
						</span>
                                            <span class="stm_slide_thumb_content">
							<?php if (isset($slide['thumbnailContent'])) echo $slide['thumbnailContent'] ?>
						</span>
                                        </div>
                                    </li>

									<?php
								}
							endforeach;
							?>
                        </ul>
                    </div>
                </div>

				<?php
			}

		}

		$margins = !empty($slider_options['item_margins']) ? $slider_options['item_margins'] : 0;
		$items_per_row = !empty($slider_options['items_in_row']) ? $slider_options['items_in_row'] : 1;


		if (!empty($slides) and !empty(array_filter($slides))) {
			?>

            <script>
                (function ($) {
                    $(document).ready(function () {

                        var margins = <?php echo intval($margins); ?>;

                        var stmSliderOptions = {
                            items: <?php echo intval($items_per_row); ?>,
                            loop: <?php echo esc_js($this->loop) ?>,
                            autoplay: false,
                            margin: margins,
                            autoplayHoverPause: true,
                            touchDrag: false,
                            mouseDrag: false,
                            autoplayTimeout: 0,
                            autoplaySpeed: 800,
                            smartSpeed: 800,
                            navText: '',
                            responsive: {
                                0: {
                                    items: 1
                                },
                                767: {
                                    items: <?php echo intval($items_per_row); ?>
                                }
                            }
                        };

                        var slider = $('#<?php echo $attr_id ?>');

						<?php
						if (!empty($slider_options['transition']) && $slider_options['transition'] != 'default') {
							$this->transition['in'] = $slider_options['transition'];

							if (strpos($this->transition['in'], 'In') !== false) {
								$this->transition['out'] = str_replace('In', 'Out', $this->transition['in']);
							}

							echo "stmSliderOptions.animateIn = '{$this->transition['in']}';";
							echo "stmSliderOptions.animateOut = '{$this->transition['out']}';";
						}

						if ($is_autoplay) {
							$autoplay = $slider_options['autoplay'];
							echo "stmSliderOptions.autoplay = {$autoplay};";
							echo "stmSliderOptions.autoplayTimeout = {$this->autplay_duration};";
						}

						?>

                        slider.owlCarousel(stmSliderOptions);


						<?php if ($this->loop === 'true')  : ?>
                        if (typeof $.fn.swipe === 'function') {
                            $('.stm_slider').swipe({
                                swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                                    /*Close on swipe*/
                                    if (direction == 'left' && distance > 50) {
                                        slider.trigger('next.owl.carousel');
                                    }

                                    if (direction == 'right' && distance > 50) {
                                        slider.trigger('prev.owl.carousel');
                                    }
                                },
                                allowPageScroll: "vertical",
                            });
                        }

						<?php endif; ?>

						<?php
						if (!empty($slider_options['navigation']) && $slider_options['navigation'] == 'true') :
						?>

                        var thumbs = $('#<?php echo $thumbs_id ?>');
                        var thumb = thumbs.find('li');
                        var firstSlideIndex = 0;

                        if (typeof stmSliderOptions.startPosition !== 'undefined') {
                            firstSlideIndex = stmSliderOptions.startPosition;
                        }

                        thumb.eq(firstSlideIndex).addClass('active mbc').removeClass('tbc');

                        slider.on('changed.owl.carousel', function (e) {
                            var index = e.page.index;
                            var thumbActive = thumb.eq(index);

                            setTimeout(function () {
                                thumbActive.addClass('active mbc').removeClass('tbc');
                                thumb.not(thumbActive).removeClass('active mbc').addClass('tbc');
                            }, 400)
                        });
                        thumb.click(function (e) {
                            e.preventDefault();
                            var clickedThumb = $(this);
                            var index = clickedThumb.index();

                            slider.trigger('to.owl.carousel', [index, 300]);
                        });

						<?php endif; ?>
                    })
                })(jQuery);
            </script>

			<?php
		}
	}

	public function get_post_slides($count, $post_slides)
	{
		$slides = $slide_default_args = $this->slide_post_args();

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => intval($count),
			'post_status'    => 'publish'
		);

		if (!empty($post_slides)) {
			$args['post__in'] = wp_list_pluck($post_slides, 'id');
		}

		$q = new WP_Query($args);
		if ($q->have_posts()) {
			$slides = array();
			$order = 0;
			while ($q->have_posts()) {
				$q->the_post();
				$order++;
				$id = get_the_ID();

				$slide_args = array(
					'id'     => $id,
					'title'  => get_the_title(),
					'date'   => get_the_date(),
					'order'  => $order,
					'button' => array(
						'label' => esc_html__('Read Story', 'stm-configurations'),
						'link'  => get_the_permalink(),
					),
				);

				$category = get_the_category();
				if (!empty($category) and !is_wp_error($category)) {
					$slide_args['category'] = '';
					foreach ($category as $category_single) {
						$slide_args['category'] .= '<a class="no_deco" href="' . esc_url(get_term_link($category_single)) . '">' . $category_single->name . '</a>';
					}
				}

				if (has_post_thumbnail()) {
					$slide_args['imageId'] = get_post_thumbnail_id();
				}

				$slides[$id] = wp_parse_args($slide_args, $slide_default_args);
			}
			wp_reset_postdata();
		}

		return $slides;
	}

	public function slide_post_args()
	{
		return array(
			'contentAlign' => 'left',
			'duration'     => '3000',
			'enable'       => 'true',
			'overlay'      => 'false',
			'pattern'      => 'false',
			'touched'      => 'false',
		);
	}
}


