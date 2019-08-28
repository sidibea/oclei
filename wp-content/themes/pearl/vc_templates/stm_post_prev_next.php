<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$classes = array('stm_prevnext_wr', 'stm_prevnext_wr_' . $style);
$classes[] = $css_class;

pearl_add_element_style('prev_next', $style);

$fullwidth_styles = array(
    'style_1'
);

if(in_array($style, $fullwidth_styles)) {
    $classes[] = 'vc_container-fluid-force';
}
?>

<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>">
    <div class="stm_projects_prevnext">
        <a class="stm_projects_prevnext__main"
           href="<?php echo esc_url(apply_filters('stm_projects_url', home_url('/'))); ?>">
            <span></span>
        </a>
		<?php get_template_part('partials/content/post/parts/prev_next_posts'); ?>
    </div>
</div>