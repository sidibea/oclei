<?php
add_action( 'init', 'pearl_moduleVC_staff_tabs' );

function pearl_moduleVC_staff_tabs() {
	vc_map( array(
		'name'        => esc_html__( 'Pearl Staff Tabs', 'pearl' ),
		'base'        => 'stm_staff_tabs',
		'icon'        => 'stmicon-dashboard',
		'category'    => esc_html__( 'Content', 'pearl' ),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'      => array(
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
			pearl_load_styles( 1 )
		)
	) );
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Staff_Tabs extends WPBakeryShortCode {
	}
}