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
            '.stm_slider_style_7 .stm_slide__title:after',
            '.stm_slider_style_7 .stm_slide__category',
			'body.stm_header_style_12 .stm-search_style_3 a:hover',
            'body.stm_header_style_12 .stm-navigation>ul>li>a:hover',
            'body.stm_header_style_12 .stm-cart_style_1 .cart:hover .cart__icon',
            '.stm_posts_list_style_7 .stm_posts_list_single__info > div.post_link:hover a',
            '.stm_posts_list_style_8 .stm_posts_list_single__info > div.post_link:hover a',
            '.stm_posts_list_style_9 .stm_posts_list_single__info > div.post_link:hover a',
            '.stm_layout_personal_blog .stm_single_post_style_12 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_14 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_15 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_16 .stm_share a:hover',
		),
		'secondary_color' => array(
		),
		'third_color'     => array(
            'body .stm_carousel .owl-nav .owl-next:hover:before',
            'body .stm_carousel .owl-nav .owl-prev:hover:before'
		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
			'.stm_slider_style_7 .stm_slide__button a:hover',
			'.stm_post_comments #submit:hover',
            '.stm_posts_list_style_7 .stm_posts_list_single__info > div.post_link:hover a:after',
            '.stm_posts_list_style_8 .stm_posts_list_single__info > div.post_link:hover a:after',
            '.stm_posts_list_style_9 .stm_posts_list_single__info > div.post_link:hover a:after',
		),
		'secondary_color' => array(
		),
		'third_color'     => array(
            '.stm_slider_style_7 .stm_slide__button a',
            '.pearl_arrow_top .arrow',
            '.stm_post_comments #submit'
		)
	),
	'border_colors' => array(
		'main_color'      => array(
            'body.stm_header_style_12 .stm-header__element_fullwidth_simple',
			'.pearl_arrow_top .arrow',
            'html body ul li.stm_megamenu > ul.sub-menu',
			'.stm_layout_personal_blog .stm_single_post_style_12 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_14 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_15 .stm_share a:hover,
            .stm_layout_personal_blog .stm_single_post_style_16 .stm_share a:hover',
		),
		'secondary_color' => array(

		),
		'third_color'     => array(

		),
	)
);

foreach ($elements_list['colors'] as $color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
<?php }

foreach ($elements_list['bg_colors'] as $bg_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
<?php }

foreach ($elements_list['border_colors'] as $border_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
<?php } ?>

.pearl_arrow_top {
    right: 40px;
    bottom: 40px;
}

.pearl_arrow_top .arrow {
    width: 50px;
    height: 50px;
    border: 1px solid #fff;
    border-radius: 0;
    box-shadow: 0;
}

.pearl_arrow_top .arrow:after,
.pearl_arrow_top .arrow:before {
    height: 2px;
    width: 7px;
    top: 24px;
    background-color:#fff !important;
}

.pearl_arrow_top .arrow:after {
    left: 24px;
}

.mc4wp-form .btn {
    padding: 9px 29px 10px !important;
}

.stm_form_style_3 .stm_material_form select,
.stm_form_style_3 .stm_material_form input[type="text"],
.stm_form_style_3 .stm_material_form input[type="email"],
.stm_form_style_3 .stm_material_form input[type="search"],
.stm_form_style_3 .stm_material_form input[type="password"],
.stm_form_style_3 .stm_material_form input[type="number"],
.stm_form_style_3 .stm_material_form input[type="date"],
.stm_form_style_3 .stm_material_form input[type="tel"],
.stm_form_style_3 .stm_material_form textarea,
.stm_form_style_3 .stm_material_form .form-control {
    border-width: 1px !important;
}

.stm_form_style_3 .mc4wp-form-fields .stm_material_form.stm_has-value > span {
    top: 12px;
}
<?php
$fonts = pearl_get_font();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];
?>

.stm_material_form {
    <?php if(!empty($main_font['name'])): ?>
        font-family: <?php echo esc_attr($main_font['name']); ?>
    <?php endif; ?>
}

.stm_carousel {
    margin: 0 auto;
}

html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a,
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li ul.sub-menu > li > a {
    font-size: 18px;
    font-weight: 400;
}

html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a,
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu > li.menu-item-has-children a {
    font-size: 20px;
    font-weight: 400;
}

body.stm_transparent_header_disabled.stm_title_box_disabled.stm_breadcrumbs_enabled .stm-header {
    margin-bottom: 60px;
}

.stm_carousel__small .owl-nav {
    display:none !important;
}

.stm_carousel_style_1 .stm_carousel__pagination {
    right: 20px !important;
}

.gmap_addresses .owl-nav {
    display: none !important;
}

.stm_projects_carousel .stm_projects_carousel__carousels .owl-nav .owl-prev {
    left: -92px;
}

.stm_projects_carousel .stm_projects_carousel__carousels .owl-nav .owl-next {
    right: -92px;
}

.stm_post_style_12 .stm_services .stm_loop__grid,
.stm_post_style_12 .stm_projects_grid .stm_projects_carousel__item {
    display: block;
    margin: 0 0 30px;
}

.stm_projects_carousel__name {
    text-transform: none !important;
}

.stm_story__carousel .owl-nav,
.stm_services_carousel .owl-nav,
.stm_testimonial__carousel .owl-nav {
    display:none !important;
}

.stm_layout_personal_blog .services_price_list .service__name,
.stm_layout_personal_blog .stm_services_style_2 .stm_services__title .h6 {
    font-size: 18px;
}

html body .stm-navigation__default ul li.stm_megamenu:hover > ul.sub-menu,
html body .stm-navigation__fullwidth ul li.stm_megamenu:hover > ul.sub-menu {
    box-shadow: none !important;
    transform: translateY(-1px) !important;
}

.mini-cart:before {
    box-shadow: 0 0 1px rgba(0,0,0,.3);
}

.stm_layout_personal_blog.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
    border-radius: 50%;
}

html body .stm-navigation__default ul li.stm_megamenu > ul.sub-menu:before,
html body .stm-navigation__fullwidth ul li.stm_megamenu > ul.sub-menu:before {
    display: none !important;
}

html body ul li.stm_megamenu > ul.sub-menu {
    border: 1px solid transparent;
}

.stm_megamenu_3 > ul.sub-menu > li:nth-child(3n+1) {
    border: 0 !important;
}

.stm_posts_list_style_7 .stm_posts_list_single__info > div.post_link a:after,
.stm_posts_list_style_8 .stm_posts_list_single__info > div.post_link a:after,
.stm_posts_list_style_9 .stm_posts_list_single__info > div.post_link a:after {
    transition: .3s ease;
}

.stm_layout_personal_blog .stm_single_post_style_12 .stm_share a,
.stm_layout_personal_blog .stm_single_post_style_14 .stm_share a,
.stm_layout_personal_blog .stm_single_post_style_15 .stm_share a,
.stm_layout_personal_blog .stm_single_post_style_16 .stm_share a {
    color: #ccc !important;
}