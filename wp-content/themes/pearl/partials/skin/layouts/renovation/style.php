<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');

$footer_color = pearl_get_option('footer_color');
?>

.stm_layout_renovation .wpb_single_image .vc_single_image-wrapper.vc_box_shadow {
	box-shadow: none !important;
	position:relative;
	padding-right: 30px;
	padding-bottom: 30px;
	transition: all .3s ease;
}

.stm_layout_renovation .wpb_single_image .vc_single_image-wrapper.vc_box_shadow:after {
	content: '';
	display: block;
	position:absolute;
	top:30px;
	right: 0;
	left: 50px;
	bottom: 0;
	background-color: #333333;
	opacity: 0.1;
	z-index: -1;
	transition: all .3s ease;
}

.vc_single_image-wrapper.vc_box_shadow:hover {
	transform: translate(15px, 15px);
}

.vc_single_image-wrapper.vc_box_shadow:hover:after {
transform: translate(-20px, -20px);
}



.stm_headings_line.stm_headings_line_bottom .h1:after, .stm_headings_line.stm_headings_line_bottom .h2:after, .stm_headings_line.stm_headings_line_bottom .h3:after, .stm_headings_line.stm_headings_line_bottom .h4:after, .stm_headings_line.stm_headings_line_bottom .h5:after, .stm_headings_line.stm_headings_line_bottom .h6:after, .stm_headings_line.stm_headings_line_bottom h1:after, .stm_headings_line.stm_headings_line_bottom h2:after, .stm_headings_line.stm_headings_line_bottom h3:after, .stm_headings_line.stm_headings_line_bottom h4:after, .stm_headings_line.stm_headings_line_bottom h5:after, .stm_headings_line.stm_headings_line_bottom h6:after {
	width: 80px !important;
	height:1px !important;
margin-top: 15px !important;
}


.stm_layout_renovation .stm_services_style_2 .stm_services__title {
    min-height: 65px;
    padding: 0 20px;
    display: flex;
    align-items: center;
}
.stm_layout_renovation .stm_services_style_2 .h6 {
    text-transform: uppercase !important;
margin-bottom: 0 !important;
}
.stm_layout_renovation .stm_services_style_2 .h6:after {
    display:none;
}

.stm_layout_renovation .stm_services_style_2 .stm_services__image:before {
    background-color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($main_color, 0.7)); ?>) !important;
}

.stm_iconbox_style_2  .stm_iconbox__text h5 {
    font-size: 16px;
    font-family: inherit !important;
}

.stm_iconbox_style_2 .stm_iconbox__icon {
    margin-top: 0 !important;
}

.stm_buttons_style_1 .btn {
    border-radius: 3px;
}

.stm_testimonials_style_1 .stm_testimonials__review {
    background-color: <?php echo wp_kses_post($main_color); ?> !important;
    color: #fff;
    margin: 0 0 48px 0 !important;
}

.stm_testimonials_style_1 .stm_testimonials__review:after {
    border-top-color:  <?php echo wp_kses_post(pearl_adjust_brightness($main_color, -80)); ?> !important;
    border-right-color:  <?php echo wp_kses_post(pearl_adjust_brightness($main_color, -80)); ?> !important;
}

.stm_sidebar_style_17 .stm-footer .footer-widgets .widgettitle h4:after {
    display: none;
}

.stm_sidebar_style_17 .stm-footer .footer-widgets .stm_custom_menu ul li a {
    font-size: 14px;
    color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($footer_color, 0.5)); ?>);
}
.stm_sidebar_style_17 .stm-footer .footer-widgets .stm_custom_menu ul li a:hover {
    color: <?php echo wp_kses_post($footer_color); ?>;
}
.stm_sidebar_style_17 .stm-footer .footer-widgets .stm_custom_menu ul li:before {
    color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($footer_color, 0.5)); ?>) !important;
    top: 3px;
}

.stm_sidebar_style_17 .stm-footer .footer-widgets .stm_custom_menu ul {
    display: flex;
flex-wrap: wrap;
}

.stm_sidebar_style_17 .stm-footer .footer-widgets .stm_custom_menu ul li {
    width: 50%;
    padding: 0 15px;
}

.widget.wpb_content_element {
    margin-bottom: 50px;
}
.stm_header_style_1.stm_layout_renovation .stm-navigation > ul > li.current-menu-item:before {
    opacity: 0;
}
.stm_header_style_1.stm_layout_renovation .stm-navigation > ul > li.current-menu-item:hover:before {
    opacity: 1;
}
html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu:after, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu:after {
    height: 50px !important;
    top: -50px;
}

.stm-footer .stm-footer__bottom {
    padding-top: 25px;
    padding-bottom: 25px;
}

.stm-footer .stm-footer__bottom .stm_bottom_copyright {
    font-size: 14px;
}

@media (max-width: 1023px) {
    .stm_layout_renovation.stm_header_style_1 .stm_mobile__header {
        margin-bottom: 0;
    }
}

.stm_widget_categories.style_1 {
    border-left-color: <?php echo wp_kses_post($main_color); ?> !important;
}