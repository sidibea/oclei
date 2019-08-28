<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$unique_class = uniqid('stm_media_events_list_');

$classes = array('stm_media_events_list');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = $unique_class;

pearl_add_element_style('media_events_list', $style);

wp_enqueue_script('lightgallery.js');
wp_enqueue_script('lg-video.js');
wp_enqueue_style('lightgallery');

if (isset($posts_per_page)) {
	if ($posts_per_page === 0) {
		$posts_per_page = -1;
	}
} else {
	$posts_per_page = 4;
}


$args = array(
	'post_type'      => 'stm_media_events',
	'posts_per_page' => $posts_per_page,
	'orderby'        => 'date',
	'order'          => 'ASC'
);


$q = new WP_Query($args);

$carousel = count($q->posts) > 4;


$tpl_dir = 'partials/content/stm_media_events';

if ($q->have_posts()) :
	$first_item_class = '';
	?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <div class="stm_media_events_list__wrapper">
            <div class="col">


				<?php while ($q->have_posts()) :
				$q->the_post();
				if ($q->current_post === 0) {
					$image = pearl_get_VC_post_img_safe(get_the_ID(), '505x445', 'full');
					$first_item_class = ' media_event__last';
				} else {
					$image = pearl_get_VC_post_img_safe(get_the_ID(), '145x145', 'thumbnails');
					$first_item_class = '';
				}


				//carousel start
				if ($q->current_post === 1) :
				?>
            </div>
            <div class="col">
				<?php if ($carousel) : ?>
                <div class="media_events__carousel owl-carousel">
                    <div>
						<?php
						endif;
						endif;
						?>

                        <div class="media_event<?php echo esc_attr($first_item_class); ?>">
                            <div class="media_event__image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
									<?php echo $image; ?>
                                </a>
                            </div>
                            <div class="media_event__content">
                                <div class="media_event__meta">
									<?php get_template_part($tpl_dir . '/parts/_meta') ?>
                                </div>
                                <div class="media_event__title">
                                    <h6>
                                        <a class="no_deco ttc mtc_h" href="<?php the_permalink(); ?>"
                                           title="<?php the_title() ?>">
											<?php the_title(); ?>
                                        </a>
                                    </h6>
                                </div>
                                <div class="media_event__text">
									<?php echo get_the_excerpt(); ?>
                                </div>
                                <div class="media_event__icons">
									<?php get_template_part($tpl_dir . '/parts/_media_links'); ?>
                                </div>
                            </div>
                        </div>

						<?php
						if ($q->current_post !== (count($q->posts) - 1) && $q->current_post > 0 && ($q->current_post) % 3 === 0 && $carousel) :
						?>
                    </div>
                    <div>
						<?php endif;
						//carousel end
						if (count($q->posts) - 1 === $q->current_post && $q->current_post > 0 && $carousel) : ?>
                    </div>
                </div>
			<?php
			endif;
			endwhile;
			wp_reset_postdata();
			?>
            </div>
			<?php if ($carousel) :
				wp_enqueue_script('pearl-owl-carousel2');
				wp_enqueue_style('owl-carousel2');
				?>
                <script>
                    (function ($) {
                        $(document).ready(function () {
                            var carousel = $('.<?php echo esc_js($unique_class); ?>').find('.media_events__carousel');
                            carousel.owlCarousel({
                                items: 1,
                                dots: true
                            })
                        })
                    })(jQuery)
                </script>
			<?php endif; ?>
        </div>
    </div>
	<?php
endif;