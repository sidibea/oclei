<?php
$footer_bg = pearl_get_option('footer_bg');
$footer_color = pearl_get_option('footer_color');
$main_color = pearl_get_option('main_color');
$third_color = pearl_get_option('third_color');
$top_bar_color = pearl_get_option('top_bar_text_color');
?>

.stm_sidebar_style_20 .stm-footer .stm-footer__bottom {
	background-color: <?php echo wp_kses_post($footer_bg); ?> !important;
}

.stm_sidebar_style_20 .stm_custom_menu a,
.textwidget p
{
	color: rgba(<?php echo wp_kses_post(pearl_hex2rgb($footer_color, 0.5)); ?>) !important;
}

.stm_sidebar_style_20 .stm_custom_menu a:hover
{
	color: <?php echo wp_kses_post($footer_color); ?> !important;
}

.stm_form_style_4 .form-control {
	border-width: 1px !important;
}

.stm-header .stm-icontext i.stm-icontext__icon{
	color: <?php echo wp_kses_post($top_bar_color); ?> !important;
}

.single-stm_products .stm-header__row_color_center {
    color: <?php echo wp_kses_post($third_color); ?> !important;
}

ul.stm_products_categories > li > a, ul.stm_products_categories > li > i  {
    color:  <?php echo wp_kses_post($third_color); ?>!important;
}
ul.stm_products_categories > li:hover > a, ul.stm_products_categories > li:hover > i {
    color:  <?php echo wp_kses_post($main_color); ?>!important;
}

.stm_layout_furniture .stm_loop .stm_posts_list_single a {
    color: <?php echo wp_kses_post($third_color); ?>!important;
}
.stm_layout_furniture .stm_loop .stm_posts_list_single a:hover {
    color: <?php echo wp_kses_post($main_color); ?>!important;
}

.stm_header_transparent .stm-header .stm-header__row_color:last-child .stm-header__row {
    border-bottom: 1px solid rgba(255,255,255,.5);
}

.stm_mobile__header {
    background-color: <?php echo wp_kses_post($third_color); ?>;
}

@media (max-width: 1024px) {
    .stm-header.active,  .stm-header.active .stm-navigation__default ul {
        background-color: <?php echo wp_kses_post($third_color); ?>;
    }
    html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li:hover > a {
        background-color: <?php echo wp_kses_post($main_color); ?> !important;
        color: #fff !important;
    }
}