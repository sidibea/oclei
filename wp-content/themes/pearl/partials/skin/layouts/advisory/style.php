<?php
/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);
$body_font_data = pearl_get_option('body_font');
$footer_color = pearl_get_option('footer_color');
$top_bar_color = pearl_get_option('top_bar_text_color');
?>
.stm_header_style_1 .stm-navigation__default>ul>li ul li>a {
	font-size: 14px !important;
}

html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li {
	padding: 0 20px;
}

html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li:hover > a, html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li:hover > a {
	color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_advisory .stm_iconbox_style_1.stm_flipbox .stm_flipbox__front .inner, .stm_iconbox_style_1.stm_flipbox .stm_flipbox__back .inner {
    padding: 30px 20px;
}
<?php
$infobox_first_gradient = 'rgba('. pearl_hex2rgb($secondary_color, .5) .')';
$gradient = '0deg, ' . $infobox_first_gradient . ' 0%, rgba(219,255,255,.5) 100%';
?>
.stm_infobox_style_7 .stm_infobox__image:after {
    background-image: -moz-linear-gradient(<?php echo wp_kses_post($gradient); ?>);
    background-image: -webkit-linear-gradient(<?php echo wp_kses_post($gradient); ?>);
    background-image: -ms-linear-gradient(<?php echo wp_kses_post($gradient); ?>);
}
.stm_services_style_11 .stm_service__overlay {
    background-image: -moz-linear-gradient(<?php echo wp_kses_post($gradient); ?>);
    background-image: -webkit-linear-gradient(<?php echo wp_kses_post($gradient); ?>);
    background-image: -ms-linear-gradient(<?php echo wp_kses_post($gradient); ?>);
}

.stm_sidebar_style_21 .widget_nav_menu a,
.stm_sidebar_style_21 .textwidget p,
.widget_mc4wp_form_widget p
{
    color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($footer_color, 0.5)); ?>) !important;
}

.stm_sidebar_style_21 .widget_nav_menu a:hover {
    color: <?php echo wp_kses_post($footer_color); ?> !important;
}
.stm-header .stm-icontext i.stm-icontext__icon{
    color: <?php echo wp_kses_post($top_bar_color); ?> !important;
}

.stm-header .stm-header__element_icon_only .stm-socials a {
    margin: 0;
    padding: 0 15px;
}

.stm-header .stm-header__element_icon_only .stm-socials {
    margin: 0 -15px;
}
.stm_header_style_1 .stm-navigation__default>ul>li ul li:hover>a  {
    color:#fff !important;
}


@media (max-width: 1023px) {
.stm_layout_advisory.stm_header_style_1 .stm_titlebox {
    margin-top: 0;
}
    [class*='stm-header__row_color'] {
        color: <?php echo wp_kses_post($third_color); ?>;
    }
    .stm_layout_advisory .stm-header {
        background-color: #fff !important;
        color: <?php echo wp_kses_post($third_color); ?>;
    }
    .stm_layout_advisory .stm_mobile__header {
        background-color: #fff !important;
        margin-bottom: 0 !important;
    }
    .stm_layout_advisory .stm-navigation.stm-navigation__default ul li.menu-item-has-children>a:after {
        border-color: <?php echo wp_kses_post($third_color); ?> transparent transparent !important;
    }
    .stm_layout_advisory.stm_header_style_1 .stm-navigation.stm-navigation__default ul li ul.sub-menu li a {
        color: inherit !important;
    }

    html body .stm-navigation__default ul li.stm_megamenu .sub-menu li ul.sub-menu > li .stm_mega_textarea {
        color: inherit !important;
    }
}

.stm_layout_advisory .stm-navigation__default>ul>li ul:after {
    top: -25px;
    height: 25px;
}

.stm_layout_advisory .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:not(:hover) span {
    color: <?php echo wp_kses_post($third_color); ?>;
}