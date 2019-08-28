<?php
$link = vc_build_link($link);

$args = array(
	'post_type'      => 'stm_projects',
	'posts_per_page' => intval($number),
	'post_status'    => 'publish',
	'meta_query'     => array(
		array(
			'key' => '_thumbnail_id'
		)
	)
);

if (!empty($category) and !empty($filter) and $category !== 'all') {
	$args['tax_query'][] = array(
		'taxonomy' => 'project_category',
		'field'    => 'term_id',
		'terms'    => sanitize_title($category),
	);
}

$id = 'stm_testimonial__carousel_' . pearl_random();

$q = new WP_Query($args);

$project_classes = array(
	'stm_projects_carousel__item stm_owl__glitches',
	'stm_item',
    'active_all'
);

if ($q->have_posts()):
	$link_filter = array_filter($link);
    $project_categories = get_terms('project_category');

	$a_classes = array(
		'text-transform wtc mtc_a_h no_deco stm-effects_opacity tbc_h',
		'js_active_switcher__a',
		'js_sort_carousels'
	);

	if(empty($link['target'])) $link['target'] = '_self';
    ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php if (!empty($link_filter) or $filter !== 'disable'): ?>
            <div class="stm_projects_carousel__entry stm_projects_carousel__entry_shadow <?php echo esc_attr($fullwidth); ?>">
                <div class="stm_projects_carousel__title">
                    <a href="<?php echo esc_url($link['url']) ?>"
                       target="<?php echo esc_attr($link['target']); ?>">
                        <span class="h2 wtc line_closer"><?php echo sanitize_text_field($link['title']); ?></span>
                    </a>
                </div>
				<?php if ($filter == '' and !empty($project_categories) and !is_wp_error($project_categories)): ?>
                    <div class="stm_projects_carousel__tabs stm_mgl_a js_active_switcher"
                         data-carousel="<?php echo esc_attr($id); ?>">
                        <div class="stm_projects_carousel__tab">
                            <a href="#"
                               data-filter=".active_all"
                               class="active <?php echo esc_attr(implode(' ', $a_classes)); ?>">
								<?php esc_html_e('All projects', 'pearl'); ?>
                            </a>
                        </div>
						<?php foreach ($project_categories as $project_category): ?>
                            <div class="stm_projects_carousel__tab">
                                <a href="#"
                                   data-filter=".<?php echo esc_attr($project_category->taxonomy . '-' . $project_category->slug); ?>"
                                   class="<?php echo esc_attr(implode(' ', $a_classes)); ?>">
									<?php echo sanitize_text_field($project_category->name); ?>
                                </a>
                            </div>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
            </div>
		<?php endif; ?>

        <div class="stm_projects_carousel__carousels owl-filter">
            <div class="stm_projects_carousel__carousel owl-carousel"
                 id="<?php echo esc_attr($id) ?>">
				<?php while ($q->have_posts()): $q->the_post();
					$post_id = get_the_ID();
					$img_id = get_post_thumbnail_id($post_id);
					$img = pearl_get_VC_img($img_id, $img_size);
					?>
                    <a href="<?php the_permalink(); ?>"
						<?php post_class($project_classes); ?>
                       target="_self"
                       title="<?php the_title(); ?>">
						<?php echo html_entity_decode($img); ?>
                        <span class="stm_projects_carousel__overlay"></span>
                        <h4 class="stm_projects_carousel__name no_line">
							<?php the_title(); ?>
                        </h4>
                        <span class="btn btn_primary btn_solid btn_xs stm_projects_carousel__btn">
                            <?php esc_html_e('View more', 'pearl'); ?>
                        </span>
                    </a>

				<?php endwhile; ?>

            </div>
        </div>

    </div>

    <script type="text/javascript">
        (function ($) {
            "use strict";

            $(document).ready(function () {
                var owlRtl = false;
                if ($('body').hasClass('rtl')) {
                    owlRtl = true;
                }

                var owl = $('#<?php echo esc_js($id); ?>').owlCarousel({
                    rtl: owlRtl,
                    items: 3,
                    dots: true,
                    nav: true,
                    autoplay: <?php echo esc_js($autoscroll); ?>,
                    slideBy: 1,
                    margin: <?php echo intval($margin) ?>,
                    responsive: {
                        0: {
                            items: 1
                        },
                        767: {
                            items: 2
                        },
                        1024: {
                            items: 3
                        }
                    },
                    navText: '',
                    loop: true,
                });

                $('.js_sort_carousels').on('click', function (e) {

                    e.preventDefault();
                    if ($(this).hasClass('active')) {
                        return false;
                    }
                    var filter_data = $(this).data('filter');
                    owl.owlFilter(filter_data);
                })

            });

        })(jQuery);
    </script>

	<?php
	wp_reset_postdata();
endif;

?>
