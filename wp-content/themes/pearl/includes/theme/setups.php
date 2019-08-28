<?php
/*Setup maximum width for any content type ( iframe, images, oEmbeds )*/
if (!isset($content_width)) {
    $content_width = 1170;
}

add_action('after_setup_theme', 'pearl_local_theme_setup');

function pearl_local_theme_setup()
{

    /*Supports*/
    add_editor_style();
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('video'));
    add_post_type_support('page', 'excerpt');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );

    /*Languages*/
    load_theme_textdomain('pearl', get_template_directory() . '/languages');

    /*Menus*/
    register_nav_menus(array(
        'primary' => esc_html__('Primary menu', 'pearl'),
    ));

    /*Sidebars*/
    register_sidebar(array(
        'name' => esc_html__('Primary Sidebar', 'pearl'),
        'id' => 'default',
        'description' => esc_html__('Main sidebar that appears on the right or left.', 'pearl'),
        'before_widget' => '<aside id="%1$s" class="widget widget-default %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widgettitle"><h5 class="no_line">',
        'after_title' => '</h5></div>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Area', 'pearl'),
		'id' => 'footer',
		'description' => esc_html__('Footer Widget Area that appears at the bottom of the page.', 'pearl'),
		'before_widget' => '<aside id="%1$s" class="widget widget-default widget-footer %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widgettitle widget-footer-title"><h4>',
		'after_title' => '</h4></div>',
    ));

    /*Sizes*/
    add_image_size( 'pearl-img-335-170', 335, 170, true );
    add_image_size( 'pearl-img-1110-630', 1110, 630, true );
    add_image_size( 'pearl-img-1000-1000', 450, 450, true );
    add_image_size( 'pearl-img-348-248', 348, 248, true );
    add_image_size( 'pearl-img-80-80', 80, 80, true );
}