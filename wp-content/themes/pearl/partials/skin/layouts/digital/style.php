<?php
/*Colors*/
$main_color = pearl_get_option('main_color');
$secondary_color = pearl_get_option('secondary_color');
$third_color = pearl_get_option('third_color');
?>

.stm_layout_digital .btn {
    border-width: 3px;
    text-transform: uppercase;
}

.stm_layout_digital .btn.btn_outline.btn_icon-bg.btn_icon-right .btn__icon {
    border-radius: 0 50px 50px 0;
    right: -1px !important;
}
.stm_layout_digital .btn.btn_outline.btn_icon-bg.btn_icon-left .btn__icon {
    border-radius: 50px 0 0 50px;
    left: -1px !important;
}

.stm_layout_digital .stm-counter_style_2 {
    padding: 0 0 0 30px;
}

.stm_layout_digital .stm-counter_style_2 .stm-counter__value,
.stm_layout_digital .stm-counter_style_2 .stm-counter__affix,
.stm_layout_digital .stm-counter_style_2 .stm-counter__prefix {
    letter-spacing: 0;
    line-height: 28px;
    font-size: 36px;
}

.stm_layout_digital .stm-counter_style_2 .stm-counter__prefix {
    font-size: 24px;
}

.stm_layout_digital .stm-counter_style_2 .stm-counter__label {
    padding-top: 1px;
    letter-spacing: 0.5px;
    margin-top: 11px;
    text-transform: uppercase;
    line-height: 16px;
    font-size: 12px;
}

@media (max-width: 1023px) {
.home.stm_layout_digital.stm_header_style_1 .stm_mobile__header {
    margin-bottom: 0;
    }
}

.stm_layout_digital .stm_lightgallery__iframe {
    text-decoration: none !important;
    position: relative;
    transition: all 0.5s;
}

.stm_layout_digital .stmicon-play {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all .3s ease !important;
    width: 90px;
    height: 90px;
    border: 4px solid #ffffff;
    border-radius: 50%;
    color: #fff;
}

.stm_layout_digital .stmicon-play:before {
    margin-left: 5px;
    font-size: 16px;
}

body.stm_transparent_header_disabled.stm_title_box_disabled.stm_breadcrumbs_enabled .stm-header {
    margin-bottom: 70px;
}

.stm_layout_digital.stm_title_box_enabled.stm_breadcrumbs_enabled .stm_titlebox.stm_titlebox_style_8 {
    margin-bottom: 70px;
}

.stm_layout_digital .stmicon-play:hover {
    background-color: #fff;
    color: <?php echo wp_kses_post($main_color); ?>
}

.stm_layout_digital .stm-navigation__default ul li.stm_megamenu ul.sub-menu,
.stm_layout_digital .stm-navigation__fullwidth ul li.stm_megamenu ul.sub-menu {
    margin-top: -10px;
}

.stm_layout_digital.stm_header_style_1 .stm-navigation__default > ul > li > a {
    font-weight: 600;
    font-size: 18px;
}

.stm_layout_digital.stm_header_style_1 .stm-navigation__default > ul > li:hover > a {
    color: <?php echo wp_kses_post($secondary_color); ?> !important;
}

.stm_layout_digital .stm-header .btn {
    font-size: 14px;
    padding: 16px 28px 19px !important;
    border-color: transparent !important;
    background: rgba(255,255,255, 0.2) !important;
}

.stm_layout_digital .stm-header .btn:hover {
    background: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_digital .stm_iconbox_style_2 .stm_iconbox__text p {
    font-size: 14px;
    line-height: 24px;
}

.stm_layout_digital .stm_sliding_images.style_1 .stm_sliding_image {
    position: absolute;
    left: -50px;
    max-width: 100%;
}
.stm_layout_digital .stm_sliding_images.style_1 .stm_sliding_image__right {
    position: absolute;
    right: 0;
    margin-left: 0;
    max-width: 100%;
    z-index: 30;
}

.stm_layout_digital.stm_sidebar_style_1 .stm-footer {
    padding-top: 57px;
}

.stm_layout_digital .stm-footer__bottom {
    padding-top: 34px;
    padding-bottom: 30px;
    border-top: 1px solid #d6d6d6;
}


.stm_layout_digital .stm-footer .textwidget {
    line-height: 30px;
}

.stm_layout_digital.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .widgettitle h4 {
    padding: 6px 0 13px;
    text-transform: none !important;
    color: <?php echo wp_kses_post($third_color); ?> !important;
}

.stm_layout_digital.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets {
    margin-top: -5px;
}
.stm_layout_digital.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets ul li {
    padding-left: 30px;
}
.stm_layout_digital.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets ul li:before {
    font-size: 16px;
}
.stm_layout_digital.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .tp_recent_tweets ul li .twitter_time {
    margin-top: 18px;
}

.stm_layout_digital.stm_sidebar_style_1 .stm_custom_menu_style_1 .menu li {
    padding-left: 28px !important;
    line-height: 20px;
    margin-bottom: 28px;
}

.stm_layout_digital.stm_sidebar_style_1 .stm_custom_menu_style_1 .menu li a:hover {
    color: <?php echo wp_kses_post($main_color); ?> !important;
}

.stm_layout_digital.stm_sidebar_style_1 .stm_custom_menu_style_1 .menu li:before {
    font-size: 16px;
    top: 2px;
    left: 4px;
}

.stm_layout_digital .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2:first-child {
    margin-top: -5px;
}

.stm_layout_digital .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 {
    margin-bottom: 6px;
}

.stm_layout_digital .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text {
    line-height: 30px;
    font-size: 14px;
}

.stm_layout_digital .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text a {
    color: <?php echo wp_kses_post($main_color); ?> !important;
    text-decoration: underline !important;
}

.stm_layout_digital .widget_contacts_style_4 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__text a:hover {
    text-decoration: none !important;
}

.stm_layout_digital  .widget_tp_widget_recent_tweets .tp_recent_tweets ul li {
    font-size: 14px;
    line-height: 30px;
}

.stm_layout_digital .widget_tp_widget_recent_tweets .tp_recent_tweets ul li .twitter_time {
    font-style: normal;
    font-size: 14px;
    color: #7e7e7e;
}

@media (max-width: 1099px) {
.stm_layout_digital .remove_row_indents {
    padding-right: 15px !important;
    padding-left: 15px !important;
}

.stm_cta.style_1 .stm_cta__content img {
    display: none;
}
}

@media (max-width: 550px) {
.stm_layout_digital .stm_cta.style_1 .stm_cta__content {
    text-align: center;
}
.stm_layout_digital .stm_cta.style_1 .stm_cta__link {
    margin: 20px auto 0;
}
}

@media (max-width: 1023px) {
    .stm_mobile__header {
    position: relative;
    z-index: 100;
    }
}