<?php
function stm_megamenu_front_scripts_method() {
    $front_css = STM_CONFIGURATIONS_URL . 'megamenu/assets/css/';
    $front_js = STM_CONFIGURATIONS_URL . 'megamenu/assets/js/';
	$v = (WP_DEBUG) ? time() : '1.2';
    wp_enqueue_style( 'stm_megamenu', $front_css . 'megamenu.css', array(), $v );
    wp_enqueue_script( 'stm_megamenu', $front_js . 'megamenu.js', array( 'jquery' ), $v );
}
add_action( 'wp_enqueue_scripts', 'stm_megamenu_front_scripts_method' );