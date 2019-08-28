<?php
$classes = array();
$offset = 0;
$unique_id = uniqid();
$classes[] = 'stm_posts_carousel stm_posts_carousel_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $unique_id;
pearl_add_element_style('posts_carousel', $style);
$img_size = !empty($img_size) ? $img_size : '148x110';

$args = array(
	'post_type'           => 'post',
	'posts_per_page'      => 9,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'tax_query' => array()
);

if ($order === 'custom') {
	if (!empty($include)) {
		$include = explode(',', $include);
		$args['post__in'] = $include;
	}
} else {
	$args['orderby'] = $order;
}

if (!empty($post_format) and $post_format !== 'all') {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => $post_format,
		)
	);
}

if (!empty($post_filter) and $post_filter !== 'none') {
    $args = pearl_popular_posts_query($post_filter, $args);
}

if ($post_filter == 'top') {
    $post_filter_name = 'popular';
} elseif ($post_filter == 'month') {
    $post_filter_name = 'hot';
} elseif ($post_filter == 'day') {
    $post_filter_name = 'trending';
}
if(!empty($post_filter_name)) {
    $classes[] = 'has_filter';
}

if (is_single()) {
    $args['post__not_in'] = array(get_the_ID());
}

$current_id = get_the_ID();

$q = new WP_Query($args);

if ($q->have_posts()): ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <?php if (!empty($post_filter_name)) : ?>
        <div class="filter_box filter_box_<?php echo $style ?> <?php echo esc_attr( $post_filter_name ); ?>">
            <span class="filter-icon stmicon-viral_<?php echo esc_attr( $post_filter_name ); ?>"></span>
            <div class="filter-title"><?php echo esc_attr( $post_filter_name ); ?></div>
        </div>
        <?php endif; ?>
        <div class="owl-carousel">
            <?php while ($q->have_posts()): $q->the_post(); ?>

                <?php
                    $post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
                    if(empty($post_views)) {
                        $post_views = 0;
                    }
                ?>

                <div class="stm_posts_carousel_single stm_owl__glitches">
                    <div class="stm_posts_carousel_single__container">
                        <?php if (has_post_thumbnail() ): ?>

                            <div class="stm_posts_carousel_single__image">
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php the_title() ?>" class="no_deco">
                                    <?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
                                </a>
                            </div>

                        <?php endif; ?>
                        <div class="stm_posts_carousel_single__body <?php if ( has_post_thumbnail() ): ?>has_single__image<?php endif; ?>">

                            <?php if (!empty($show_title)): ?>
                                <h5>
                                    <a href="<?php the_permalink(); ?>"
                                       title="<?php the_title() ?>" class="no_deco">
                                        <?php echo pearl_minimize_word(get_the_title(), 28, '...') ?>
                                    </a>
                                </h5>
                            <?php endif; ?>

                            <?php if (!empty($show_excerpt)): ?>
                                <div class="stm_posts_carousel_single__excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>

                            <div class="stm_posts_carousel_single__info">

                                <?php if (!empty($show_date)): ?>
                                    <div class="date">
                                        <?php
                                        $posted = get_the_time('U');
                                        echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($show_views)): ?>
                                    <div class="views">
                                        <?php echo esc_attr($post_views); ?>
                                        <?php if($post_views == 1) : ?>
                                            <?php esc_html_e('view', 'pearl'); ?>
                                        <?php else: ?>
                                            <?php esc_html_e('views', 'pearl'); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($show_comments)): ?>
                                    <div class="comments">
                                        <?php echo comments_number(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php wp_enqueue_style('owl-carousel2'); ?>
<?php wp_enqueue_script('pearl-owl-carousel2'); ?>
<script type="text/javascript">
    (function($) {
        "use strict";
        var owl = $('.owl-carousel');

        $(document).ready(function () {
            var owlRtl = false;
            if( $('body').hasClass('rtl') ) {
                owlRtl = true;
            }

            owl.owlCarousel({
                rtl: owlRtl,
                items: 1,
                responsive:{
                    0: {
                        items: 1,
                    },
                    768:{
                        items: <?php echo intval($number_row_tablet); ?>
                    },
                    1025:{
                        items: <?php echo intval($number_row_laptop); ?>
                    },
                    1367:{
                        items: <?php echo intval($number_row_desktop); ?>
                    }
                },
                dots: <?php echo esc_js($bullets); ?>,
                autoplay: <?php echo esc_js($autoscroll); ?>,
                margin: 30,
                autoplaySpeed: 1500,
                slideBy: 1,
                loop: <?php echo esc_js($loop); ?>,
            });
        });
    })(jQuery);
</script>