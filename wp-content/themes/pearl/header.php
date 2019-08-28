<!DOCTYPE html>
<html <?php language_attributes(); ?> id="main_html">
<head>
	<?php do_action('pearl_head_start'); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
	<?php do_action('pearl_head_end'); ?>
</head>
<body <?php body_class(); ?> <?php pearl_body_bg(); ?>ontouchstart="true">
    <?php do_action('pearl_body_start'); ?>
	<?php
    if(pearl_check_string(pearl_get_option('enable_bubbles', '')))
		get_template_part('partials/other/bubbles'); ?>
    <div id="wrapper">
        <?php do_action('pearl_before_header'); ?>
        <?php get_template_part('partials/header/main'); ?>

        <?php
            //Pre content settings

            //Global settings
            $page_pre_content_box = pearl_get_option('page_pre_content_box');
            $stm_pre_content_global = pearl_get_option('page_pre_content');
            //Page settings
            $id = get_the_ID();
            $stm_pre_content_custom = get_post_meta($id, 'stm_pre_content', true);
        ?>
        <?php if( $page_pre_content_box == 'true' ): ?>
            <div class="pre_content">
                <?php if( empty ($stm_pre_content_custom) ): ?>
                    <?php pearl_sidebar(true, $stm_pre_content_global); ?>
                <?php elseif( $stm_pre_content_custom == true) : ?>
                <?php else: ?>
                    <?php pearl_sidebar(true, $stm_pre_content_custom); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <div class="site-content">
            <div class="<?php echo esc_attr(apply_filters('pearl_site_container', '')); ?>">
