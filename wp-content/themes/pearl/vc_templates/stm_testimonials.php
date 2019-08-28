<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_testimonials');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = 'stm_testimonials_' . $style;

wp_enqueue_style('owl-carousel2');
wp_enqueue_script('pearl-owl-carousel2');

pearl_add_element_style('testimonials', $style);

$args = array(
    'post_type' => 'stm_testimonials',
    'posts_per_page' => intval($number),
    'post_status' => 'publish'
);

$number_row = (empty($number_row)) ? '1' : $number_row;

$q = new WP_Query($args);

/*Carousel or not*/
$carousel = (pearl_check_string($carousel)) ? true : false;
$row_class = 'owl-carousel';
$item_classes = 'stm_testimonials__item stm_owl__glitches stc_b';
if(!$carousel) {
    $item_wrapper = 'col-md-' . intval(12 / $list_number_row) . ' col-sm-6 col-xs-12';
    $item_classes = 'stm_testimonials__item col-md-12 stm_mgb_30';
    $row_class = 'row';
    $classes[] = 'stm_testimonials_list_style';
}

$loop = 'false';

if (!empty($number)) {
    $loop = $number > 1 ? 'true' : 'false';
} else {
    $loop = $q->post_count > 1 ? 'true' : 'false';
}

if($q->have_posts()):
    $id = 'stm_testimonial__carousel_' . pearl_random();
    ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <?php
            if (!empty($title)) {
                echo "<h2 class='stm_testimonials__title h1'>{$title}</h2>";
                echo "<div class='title_sep mbdc_b mbdc_a'><div class='mtc title_sep__icon'></div></div>";
            }
        ?>
        <div class="stm_testimonial__carousel <?php echo esc_attr($row_class); ?>" id="<?php echo esc_attr($id) ?>">
            <?php while($q->have_posts()): $q->the_post();
                $post_id = get_the_ID();
                $review = get_post_meta($post_id, 'review', true);
                $name = get_post_meta($post_id, 'stm_default_title', true);
                $position = get_post_meta($post_id, 'company', true);
                $image = pearl_get_VC_img(get_post_thumbnail_id( $post_id ), $img_size);
                if(!empty(intval($crop))) $review = pearl_minimize_word($review, intval($crop));
                ?>
                <?php if(!$carousel): ?>
                    <div class="<?php echo esc_attr($item_wrapper); ?>">
                <?php endif; ?>
                    <div <?php post_class($item_classes); ?>>
                        <div class="stm_testimonials__review mtc_b"><?php echo wp_kses_post($review); ?></div>
                        <div class="stm_testimonials__meta stm_testimonials__meta_left stm_testimonials__meta_align-center">


                            <?php if (!empty($image) and $show_image == 'true') : ?>
                            <div class="stm_testimonials__avatar stm_testimonials__avatar_rounded mtc_b">
                                <div class="stm_testimonials__avatar_pseudo"></div>
                                <?php echo html_entity_decode($image); ?>
                            </div>
                            <?php endif; ?>

                            <div class="stm_testimonials__info">
                                <?php if(!empty($name)): ?>
                                    <h6 class="no_line text-transform"><?php echo sanitize_text_field($name); ?></h6>
                                <?php endif; ?>
                                <?php if(!empty($position)): ?>
                                    <span><?php echo sanitize_text_field($position); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                 <?php if(!$carousel): ?>
                    </div>
                 <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>

    <?php if($carousel): ?>
        <script type="text/javascript">
            (function($) {
                "use strict";
                var owl = $('#<?php echo esc_js($id); ?>');
                var loop = <?php echo esc_js($loop); ?>;

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
							650:{
								items: <?php echo ($number_row > 1) ? 2 : $number_row; ?>
							},
                            1200:{
                                items: <?php echo intval($number_row); ?>
                            }
                        },
                        dots: <?php echo esc_js($bullets); ?>,
                        autoplay: <?php echo esc_js($autoscroll); ?>,
                        nav: <?php echo esc_js($arrows)  ?>,
                        navText: [],
						margin: <?php echo esc_js($margin); ?>,
                        slideBy: 1,
                        smartSpeed: 700,
                        loop: loop,
                        center: <?php echo esc_js($center_mode); ?>
                    });
                });
            })(jQuery);
        </script>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>