<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = (empty($style)) ? 'style_1' : $style;

$classes = array('stm_stories');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_stories_' . $style;

wp_enqueue_style('twentytwenty');
wp_enqueue_script('twentytwenty');
wp_enqueue_style('owl-carousel2');
wp_enqueue_script('pearl-owl-carousel2');

pearl_add_element_style('stories', $style);

$args = array(
    'post_type' => 'stm_stories',
    'posts_per_page' => intval($posts_per_page),
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => 'stm_before',
            'value' => '',
            'compare' => '!='
        ),
        array(
            'key' => 'stm_after',
            'value' => '',
            'compare' => '!='
        )
    )
);

$q = new WP_Query($args);

if ($q->have_posts()):
    $id = 'stm_story__carousel_' . pearl_random();
    $first = array();
    ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <div class="stm_story">
            <div class="stm_story__carousel_holder">
                <?php if(!empty($title)): ?>
                    <div class="heading_font"><?php echo sanitize_text_field($title); ?></div>
                <?php endif; ?>
                <div class="stm_story__carousel owl-carousel" id="<?php echo esc_attr($id) ?>">
                    <?php while ($q->have_posts()): $q->the_post();
                        $post_id = get_the_ID();
                        $before = pearl_get_VC_img(get_post_meta($post_id, 'stm_before', true), '450x390', true);
                        $after = pearl_get_VC_img(get_post_meta($post_id, 'stm_after', true), '450x390', true);
                        $title = get_the_title();
                        $title .= ' ' . get_post_meta($post_id, 'stm_intro', true);
                        $excerpt = get_the_excerpt();

                        if($q->current_post == 0) {
                            $first['before'] = $before;
                            $first['after'] = $after;
                        }
                        ?>

                        <div class="stm_story__single stm_owl__glitches"
                             data-before="<?php echo esc_url($before); ?>"
                             data-after="<?php echo esc_url($after); ?>">
                            <div class="stm_story__title mtc">
                                <?php echo sanitize_text_field($title); ?>
                            </div>

                            <div class="stm_story__text">
                                <?php echo wp_kses_post($excerpt); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="stm_story__images">
                <div class="inner">
                    <div class="twenty">
                        <img class="stm_story__images_before"
                             width="360"
                             height="320"
                             alt="<?php echo sanitize_text_field($title); ?>"
                             src="<?php echo esc_url($first['before']); ?>" />
                        <img class="stm_story__images_after"
                             width="360"
                             height="320"
                             alt="<?php echo sanitize_text_field($title); ?>"
                             src="<?php echo esc_url($first['after']); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        (function ($) {
            "use strict";

            var owl = $('#<?php echo esc_js($id); ?>');

            $(document).ready(function () {
                var owlRtl = false;
                if ($('body').hasClass('rtl')) {
                    owlRtl = true;
                }

                owl.on('initialized.owl.carousel', function(event) {
                    $(".stm_story__images .twenty").twentytwenty();
                });

                owl.owlCarousel({
                    rtl: owlRtl,
                    items: 1,
                    dots: true,
                    autoplay: false,
                    slideBy: 1,
                    loop: true,
                }).on('changed.owl.carousel', function (e) {
                    var $item = $('#<?php echo esc_js($id); ?> .stm_story__single').eq(e.item.index);
                    var before = $item.attr('data-before');
                    var after = $item.attr('data-after');
                    var $images = $item.closest('.stm_stories').find('.stm_story__images');

                    var $beforeW = $images.find('.stm_story__images_before');
                    var $afterW = $images.find('.stm_story__images_after');

                    $beforeW.attr('src', before);
                    $afterW.attr('src', after);
                });
            });
        })(jQuery);
    </script>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>