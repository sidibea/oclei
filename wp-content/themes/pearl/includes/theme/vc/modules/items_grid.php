<?php
add_action('init', 'pearl_moduleVc_items_grid');

function pearl_moduleVc_items_grid() {
	vc_map( array(
		"name" => esc_html__('Items Grid', 'pearl'),
		"base" => "stm_items_grid",
		"params" => array(	
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Item Info', 'pearl' ),
				'param_name' => 'heading',
				'value'      => urlencode(json_encode(array(
					array(
						'label'       => esc_html__('Title', 'pearl'),
						'admin_label' => true
					),
				))),
				'params' => array(
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Title', 'pearl' ),
						'param_name'   => 'title',
						'admin_label' => true,
					),
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Badge', 'pearl' ),
						'param_name'   => 'badge',
						'admin_label' => true,
					),
					array(
						'type'         => 'attach_image',
						'heading'      => esc_html__( 'Image', 'pearl' ),
						'param_name'   => 'image'
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__( 'Description', 'pearl' ),
						'param_name' => 'description'
					),
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Features title', 'pearl' ),
						'param_name'   => 'features_title',
					),
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Features (comma separated)', 'pearl' ),
						'param_name'   => 'features',
					),
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Button text', 'pearl' ),
						'param_name'   => 'btn_text',
					),
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Button URL', 'pearl' ),
						'param_name'   => 'btn_url',
					),
					array(
						'type'         => 'textfield',
						'heading'      => esc_html__( 'Preview text', 'pearl' ),
						'param_name'   => 'preview_text',
					),
				)
			)
		)
	) );


}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Items_Grid extends WPBakeryShortCode
    {
    }
}