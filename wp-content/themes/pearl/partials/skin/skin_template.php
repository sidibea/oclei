<?php
/*Default layout styles*/
$default = pearl_get_layout_config();


$form_style = pearl_get_option('forms_global_style', 'style_1');
$blockquote_style = pearl_get_option('blockquote_style', 'style_1');

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$loader_color = pearl_get_option('preloader_color', $main_color);

$top_bar_color = pearl_get_option('top_bar_text_color');

/*Color*/
$colors = pearl_get_custom_styled_elements_array('colors', false);

/*Background color*/
$bg_colors = pearl_get_custom_styled_elements_array('bg_colors', false);

/*Border color*/
$border_colors = pearl_get_custom_styled_elements_array('border_colors', false);

foreach ($colors as $color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
<?php }

foreach ($bg_colors as $bg_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
<?php }

foreach ($border_colors as $border_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
<?php }

$site_width = intval(pearl_get_option('site_width', '1170'));
$site_width_media_query = $site_width > 1200 ? $site_width : 1200;
?>


@media (min-width: <?php echo intval($site_width_media_query); ?>px) {
.stm_slider_style_3.stm_slider .stm_slide__overlay,
.stm_slider_style_2 .owl-dots,
.container {
width: <?php echo intval($site_width); ?>px;
}
}

<?php $padding = pearl_get_option('site_padding', 0);
if (!empty($padding)):
	$resolution = intval(pearl_get_option('site_width', '1170')) + (intval($padding) * 2) + 100; ?>
    @media (min-width: <?php echo intval($resolution) ?>px) {
    #wrapper {
    padding-left: <?php echo intval($padding); ?>px;
    padding-right: <?php echo intval($padding); ?>px;
    }
    }
    @media (max-width: <?php echo intval($resolution) ?>px) {
    .fullwidth-header-part {
    padding-left: 15px;
    padding-right: 15px;
    }
    }
<?php endif; ?>


.stm_slider_style_3.stm_slider .stm_slide__overlay {
background-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($main_color, 0.75)); ?>);
}


<?php
/*Footer styles*/
$background_color = pearl_get_option('footer_bg');
$background_image = pearl_get_image_url(pearl_get_option('footer_bg_image'));
$color = pearl_get_option('footer_color', '#fff');
$f_cols = pearl_get_option('footer_cols', 4);
?>

.stm_boxed .stm-footer,
.stm-footer {
background-color: <?php echo sanitize_text_field($background_color); ?>;
<?php if (!empty($background_image)): ?>
    background-image: url('<?php echo esc_url($background_image); ?>');
<?php endif; ?>
}

#audio-player__list,
#audio-player {
background-color: <?php echo sanitize_text_field($background_color); ?>;
}

.stm-footer a,
.stm-footer .stm-socials__icon:hover,
.stm-footer .footer-widgets aside.widget .widgettitle h4,
.stm-footer {
color: <?php echo sanitize_text_field($color); ?>;
}

@media (min-width: 1025px) {
    .stm-footer .footer-widgets aside.widget {
    width: <?php echo intval(100 / $f_cols); ?>%;
    }
    html>body .stm-navigation__hamburger ul li a:hover {
        background-color: <?php echo wp_kses_post($main_color); ?>;
    }

}

.stm_markup__sidebar .widget.widget_nav_menu ul li:before,
.stm_markup__sidebar .widget.widget_pages ul li:before,
.widget_meta ul li:before,
.widget_archive ul li:before,
.widget_recent_comments ul li:before,
.stm_widget_pages_style_1.widget ul li.current_page_item:before,
.stm_widget_pages_style_1.widget ul li:hover:before,
.widget_categories ul li:before {
border-left: 5px solid <?php echo sanitize_text_field($main_color); ?>;
}

button[type="submit"]:not(.btn),
input[type="submit"]:not(.btn) {
background-color: <?php echo sanitize_text_field($main_color); ?>;
}

button[type="submit"]:not(.btn):hover,
input[type="submit"]:not(.btn):hover {
background-color: <?php echo sanitize_text_field($third_color); ?>;
color: #fff;
}

.stm_widget_categories.style_1 ul li:before,
.stm_video.stm_video_style_3 .stm_playb:before,
.stm_project_details_style_4 .stm_project_details__single,
.stm_vacancies_style_3 .stm_details .info,
blockquote,
body .stm_posts_list__single:before,
body .stm_playb:hover:before {
border-left-color: <?php echo sanitize_text_field($main_color); ?>;
}

.stm_history__year {
border-right-color: <?php echo sanitize_text_field($main_color); ?>;
}

.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_active .vc_tta-panel-title > a {
border-color: <?php echo sanitize_text_field($main_color); ?> !important;
color: #fff !important;
}

html.stm-site-loader:before {
background-color: <?php echo sanitize_text_field(pearl_color_treads($loader_color)); ?>
}

.stm_iconbox.stm_iconbox_style_1 .stm_flipbox__front,
.stm_iconbox.stm_iconbox_style_1 {
border-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($main_color, '0.5')); ?>);
}

.twentytwenty-handle {
background-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($main_color, '0.9')); ?>);
}

.stm_pricing-table_style_4 {
background-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($main_color, '0.05')); ?>);
}


.stm_gmap_wrapper.style_1 .stm_infobox:after,
.stm_gmap_wrapper.style_3 .stm_infobox:after {
border-top-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($third_color)); ?>) !important;
}

.stm_staff_list_style_5555,
.open-table-widget-datepicker,
.stm_open_table_style_1 .otw-input-wrap .button:after
{
border-top-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($main_color)); ?>) !important;
}

.stm_iconbox.stm_iconbox_style_1:hover {
border-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($main_color)); ?>);
}

.stm_schedule_style_1 .event_lesson_tabs a
{
border-bottom-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)); ?> !important;
}


.stm_projects_grid_style_6 .stm_projects_carousel__item:hover .stm_projects_carousel__overlay {
background-color: rgba(<?php echo sanitize_text_field(pearl_hex2rgb($third_color, '0.75')); ?>);
}


.stm_sidebar_style_6 .stm_markup__sidebar_divider .widgettitle,
.stm_schedule_style_1 .event_lesson_tabs.active a,
.stm_sidebar_style_1 .stm_markup__sidebar_divider .widget,
.stm_header_style_1 .stm-navigation ul > li > ul > li:hover,
.stm_header_style_1 .stm-navigation ul > li > ul > li.current-menu-item,
.stm_material_form:not(.stm_has-value) textarea,
.stm_material_form:not(.stm_has-value) input {
border-bottom-color: <?php echo sanitize_text_field(pearl_color_treads($main_color)); ?> !important
}

.stm_services_style_4 .stm_services__icon i {
background: -webkit-linear-gradient(0deg, <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 100%);
}

<!--Gradient solid button-->
<!--Primary-->
.btn.btn_solid.btn_gradient.btn_primary {background-color: <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?>;}
.btn.btn_solid.btn_gradient.btn_primary {border-left-color: <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> !important;}
.btn.btn_solid.btn_gradient.btn_primary {border-right-color: <?php echo pearl_adjust_brightness($main_color, 46) ?> !important;}
.btn.btn_solid.btn_gradient.btn_primary:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_primary:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_primary span:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_primary span:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
<!--Secondary-->
.btn.btn_solid.btn_gradient.btn_secondary {background-color: <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?>;}
.btn.btn_solid.btn_gradient.btn_secondary {border-left-color: <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> !important;}
.btn.btn_solid.btn_gradient.btn_secondary {border-right-color: <?php echo pearl_adjust_brightness($secondary_color, 46) ?> !important;}
.btn.btn_solid.btn_gradient.btn_secondary:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_secondary:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_secondary span:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_secondary span:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
<!--Third-->
.btn.btn_solid.btn_gradient.btn_third {background-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?>;}
.btn.btn_solid.btn_gradient.btn_third {border-left-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> !important;}
.btn.btn_solid.btn_gradient.btn_third {border-right-color: <?php echo pearl_adjust_brightness($third_color, 46) ?> !important;}
.btn.btn_solid.btn_gradient.btn_third:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_third:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_third span:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn.btn_solid.btn_gradient.btn_third span:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
<!--Gradient outline button-->
<!--Primary-->
.btn.btn_outline.btn_gradient.btn_primary {background-color: <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?>;}
.btn.btn_outline.btn_gradient.btn_primary {border-left-color: <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> !important;}
.btn.btn_outline.btn_gradient.btn_primary {border-right-color: <?php echo pearl_adjust_brightness($main_color, 46) ?> !important;}
.btn.btn_outline.btn_gradient.btn_primary:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_primary:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_primary span:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_primary span:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
<!--Secondary-->
.btn.btn_outline.btn_gradient.btn_secondary {background-color: <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?>;}
.btn.btn_outline.btn_gradient.btn_secondary {border-left-color: <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> !important;}
.btn.btn_outline.btn_gradient.btn_secondary {border-right-color: <?php echo pearl_adjust_brightness($secondary_color, 46) ?> !important;}
.btn.btn_outline.btn_gradient.btn_secondary:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_secondary:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_secondary span:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_secondary span:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($secondary_color)) ?> 0%, <?php echo pearl_adjust_brightness($secondary_color, 46) ?> 100%);}
<!--Third-->
.btn.btn_outline.btn_gradient.btn_third {background-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?>;}
.btn.btn_outline.btn_gradient.btn_third {border-left-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> !important;}
.btn.btn_outline.btn_gradient.btn_third {border-right-color: <?php echo pearl_adjust_brightness($third_color, 46) ?> !important;}
.btn.btn_outline.btn_gradient.btn_third:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_third:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_third span:before {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn.btn_outline.btn_gradient.btn_third span:after {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> 0%, <?php echo pearl_adjust_brightness($third_color, 46) ?> 100%);}
.btn_slide.btn_secondary {background-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?>;}

<!--Slide bnt-->
.btn_slide.btn.btn_solid.btn_gradient.btn_secondary span {background: transparent;}
.btn_slide.btn.btn_solid.btn_gradient.btn_secondary {background-color: <?php echo sanitize_text_field(pearl_color_treads($third_color)) ?> !important;}

<!--Newsletter in sidebar gradient-->
.stm_sidebar_style_10 .newsletter-box {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}
.stm_sidebar_style_10 .newsletter-box {background: linear-gradient(to right,  <?php echo sanitize_text_field(pearl_color_treads($main_color)) ?> 0%, <?php echo pearl_adjust_brightness($main_color, 46) ?> 100%);}

<?php if ($form_style === 'style_3'): ?>
    .stm_select:not(.stm_has-value) {
    border-bottom-color: <?php echo sanitize_text_field(pearl_color_treads($main_color)); ?> !important
    }
<?php endif; ?>

<?php
$footer_color = pearl_get_option('footer_color');

$footer_bottom_color = pearl_get_option('footer_bottom_color');
if (empty($footer_bottom_color)) {
    $footer_bottom_color = $footer_color;
}
?>

.stm-footer__bottom:before {
background-color: <?php echo sanitize_text_field(pearl_color_treads(pearl_get_option('footer_bottom_bg'))); ?>;
}
.stm-footer__bottom {
    color: <?php echo sanitize_text_field(pearl_color_treads($footer_bottom_color)); ?>
}




<?php if ($blockquote_style === 'style_4') : ?>
    .stm_blockquote_style_4 blockquote {
    border-color: rgba(<?php echo pearl_hex2rgb($secondary_color, '.3') ?>) !important
    }

    .stm_blockquote_style_4 blockquote:before, .stm_blockquote_style_4 blockquote:after {
    color: rgba(<?php echo pearl_hex2rgb($secondary_color, '.3') ?>) !important
    }
<?php endif; ?>

<?php
$header_sticky_bg = pearl_get_option('header_sticky_bg', '');
if (!empty($header_sticky_bg)): ?>
    .stm-header .pearl_sticked:before {
    background-color: <?php echo pearl_color_treads($header_sticky_bg); ?> !important;
    }
<?php endif; ?>


.stm_buttons_style_21 .btn.btn_solid:not(:hover) {
<?php $button_21_gradient = '90deg, rgb(204,141,33) 0%, rgb('. pearl_hex2rgb($main_color).') 100%'; ?>
    background-image: -moz-linear-gradient(<?php echo wp_kses_post($button_21_gradient); ?>);
    background-image: -webkit-linear-gradient(<?php echo wp_kses_post($button_21_gradient); ?>);
    background-image: -ms-linear-gradient(<?php echo wp_kses_post($button_21_gradient); ?>);
    background-image: linear-gradient(<?php echo wp_kses_post($button_21_gradient); ?>);
}

.stm_buttons_style_21 .btn.btn_solid:hover {
<?php $button_21_gradient_hover = '270deg, rgb(204,141,33) 0%, rgb('. pearl_hex2rgb($main_color).') 100%'; ?>
background-image: -moz-linear-gradient(<?php echo wp_kses_post($button_21_gradient_hover); ?>);
background-image: -webkit-linear-gradient(<?php echo wp_kses_post($button_21_gradient_hover); ?>);
background-image: -ms-linear-gradient(<?php echo wp_kses_post($button_21_gradient_hover); ?>);
background-image: linear-gradient(<?php echo wp_kses_post($button_21_gradient_hover); ?>);
}
