<?php
/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
	'colors'        => array(
		'main_color'      => array(
			'.stm_widget_posts.style_9 .read_more',
			'.stm_widget_posts.style_9 .read_more:hover',
		),
		'secondary_color' => array(),
		'third_color'     => array(
			'.stm_events_list_style_8 a:hover span.btn:hover',
			'.stm_events_list_style_8 a:hover span.btn:hover i',
			'.stm-header .stm-icontext__icon:before'
		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
			'.wpb_single_image .vc_box_shadow:before',
			'.stm_pagination_style_16 .owl-dots .owl-dot.active span',
			'.stm_icon_links_style_6 a',
			'.stm_testimonials_style_12 .owl-item.center .stm_testimonials__item',
			'.stm_events_list_style_8 a:hover'
		),
		'secondary_color' => array(),
		'third_color'     => array(
			'.stm_icon_links_style_6 a:hover'
		)
	),
	'border_colors' => array(
		'main_color'      => array(
			'.stm_post_style_24 .vc_gitem-0post-data-source-post_categories > .vc_gitem-post-category-name',
			'.stm_sidebar_style_18 .stm_markup__sidebar_divider .widgettitle h5',
			'.stm_accordions_style_7 .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-controls-icon:after',
			'.stm_accordions_style_7 .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-controls-icon:before',
            '.stm_form_style_12 textarea:focus'
		),
		'secondary_color' => array(),
		'third_color'     => array(),
	)
);

foreach ($elements_list['colors'] as $color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
	<?php
}

foreach ($elements_list['bg_colors'] as $bg_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
	<?php
}

foreach ($elements_list['border_colors'] as $border_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
	<?php
} ?>

.wpb_single_image .vc_box_shadow {
box-shadow: none !important;
position: relative;
padding-right: 30px;
}

.wpb_single_image .vc_box_shadow:before {
content: '';
display block;
position: absolute;
left: 30px;
top: -30px;
right: 0;
bottom: 30px;
transition: .3s ease;
}
.wpb_single_image.stm_hover_action__top:hover .vc_box_shadow:before  {
top: 0;
bottom: 0;
}

<?php
$footer_color = pearl_get_option('footer_color');
$footer_text_color = pearl_hex2rgb($footer_color, 0.5);
?>

.stm-footer .widget > *:not(.widgettitle), .stm-footer a {
color: rgba(<?php echo $footer_text_color; ?>) !important;
}
.stm-footer a:before {
border-color: rgba(<?php echo $footer_text_color; ?>) !important;
}

.stm-footer a:hover, .stm-footer a::before {
color: <?php echo $footer_color; ?> !important;
}
.stm-footer a:hover::before {
border-color: rgba(<?php echo $footer_color; ?>) !important;
}

.stm-footer .stm_bottom_copyright {
color: rgba(<?php echo $footer_text_color; ?>) !important;
}

.stm_projects_carousel_dark .stm_projects_carousel__tabs a.active {
    color: #fff !important;
}