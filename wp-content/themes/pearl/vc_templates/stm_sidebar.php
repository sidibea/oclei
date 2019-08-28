<?php
/**
 * @var $post_sidebar WP_Post
 */


extract( shortcode_atts( array(
	'css' => '',
	'sidebar' => '0'
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );



$post_sidebar = get_post( $sidebar );
if( empty( $post_sidebar ) || $sidebar == '0' ){
	return;
}
wp_add_inline_style('pearl-row_style_1', sanitize_text_field(get_post_meta( $post_sidebar->ID, '_wpb_shortcodes_custom_css', true )));
?>

<div class="stm_markup__sidebar_divider<?php echo esc_attr( $css_class ); ?>">
	<?php echo apply_filters( 'the_content' , $post_sidebar->post_content); ?>
</div>

