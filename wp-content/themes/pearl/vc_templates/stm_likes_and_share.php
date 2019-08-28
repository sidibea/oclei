<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$classes = array('stm_likes_and_share');
$classes[] = 'stm_likes_and_share_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

$likes = get_post_meta(get_the_ID(), 'pearl_likes', true);
$dislikes = get_post_meta(get_the_ID(), 'pearl_dislikes', true);
pearl_add_element_style('likes_and_share', $style);
wp_enqueue_script('pearl_post_carousel/like_dislike');

if (empty($likes)) {
    $likes = 0;
}
if (empty($dislikes)) {
    $dislikes = 0;
}
?>

<div class="<?php echo implode(' ', $classes); ?>">
    <div class="stm_single_post__likes">
        <div id="likeDislike" data-post="<?php echo get_the_ID(); ?>">
            <div class="likes__count_label">
                <?php echo esc_html('Liked', 'pearl'); ?>
            </div>
            <div class="likes__count">
                <?php echo wp_kses_post($likes); ?>
            </div>
            <button class="like ttc"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
        </div>
    </div>
    <div class="stm_single_post__sharethis">
        <div class="sharethis-inline-share-buttons in-content"></div>
    </div>
</div>