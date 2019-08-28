<?php
add_action('init', 'pearl_moduleVC_animation');

function pearl_moduleVC_animation()
{
    vc_map( array(
        "name"      => esc_html__( 'Animation Block', 'pearl' ),
        "base"      => 'stm_animation_block',
        "class"     => 'animation_block',
        "as_parent" => array( 'except' => 'stm_animation_block' ),
        "category"  => esc_html__( 'STM', 'pearl' ),
        "params"    => array(
            array(
                "type"       => "stm_animator",
                "class"      => "",
                "heading"    => esc_html__( "Animation", 'pearl' ),
                "param_name" => "animation",
                "value"      => ""
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Animation Duration (s)", 'pearl' ),
                "param_name"  => "animation_duration",
                "value"       => 0.5,
                "description" => esc_html__( "How long the animation effect should last. Decides the speed of effect.", 'pearl' ),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Animation Delay (s)", 'pearl' ),
                "param_name"  => "animation_delay",
                "value"       => 0,
                "description" => esc_html__( "Delays the animation effect for seconds you enter above.", 'pearl' ),
            ),
            array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Viewport Position (%)", 'pearl' ),
                "param_name"  => "viewport_position",
                "value"       => "90",
                "description" => esc_html__( "The area of screen from top where animation effects will start working.", 'pearl' ),
            )
        ),
        "js_view"   => 'VcColumnView'
    ) );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Stm_Animation_Block extends WPBakeryShortCodesContainer {
    }
}
