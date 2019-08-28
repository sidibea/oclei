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
            '.stm_staff_container_list .stm_staff_list_style_2 .stm_staff__contacts .stm_staff__contact i:before',
            '.stm_upcoming_event_style_1 .stm_upcoming_event__date-title',
            '.stm_upcoming_event_style_1 .stm_upcoming_event__counter .counter__value',
            '.stm_pricing-table_style_4 .stm_pricing-table__label',
            '.stm_post_type_list_style_3 .stm_post_type_list__single:hover h4',
            '.stm_post_type_list_style_3 .stm_post_type_list__content:before',
		),
		'secondary_color' => array(
            '.stm_projects_grid_style_2 .stm_projects__meta .inner .stm_projects__meta_terms',
			'.stm_pricing-table_style_2 .stm_pricing-table__head h5',
			'.stm_projects_carousel__tab a.active',
		),
		'third_color'     => array(
		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
			'.stm_donation_style_2 .stm_donation__progress-bar',
            '.stm_testimonials_style_3 .owl-dots .owl-dot.active',
			'.services_price_list_style_1.services_price_list_tabs ul li.active a',
			'.stm_donation_style_2 .stm_donation__progress-bar',
			'.stm_single_donation_style_1 .stm_single_donation__progress-bar span',
			'.stm_services_style_7 .stm_loop__grid > a',
		),
		'secondary_color' => array(
		),
		'third_color'     => array(

		)
	),
	'border_colors' => array(
		'main_color'      => array(

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

.stm_layout_portfolio .stm_iconbox_style_6 {
	padding: 44px 30px;
}

.stm_layout_portfolio .stm_donation_style_2 .stm_donation__details-wrapper {
	padding-bottom: 20px;
}

.stm_posttimeline_style_1 .stm_posttimeline__post h3 {
    text-transform: none !important;
    font-size: 24px;
}

.stm_pagination_style_10 .owl-dots .owl-dot {
    display: inline-block;
}

.stm_testimonials_style_3 .owl-dots .owl-dot {
    padding: 0 !important;
}

.stm_testimonials_style_3 .owl-dots .owl-dot.active span {
    opacity: 1 !important;
}

.stm_events_list_style_1 .stm_event_single_list > div.hasTitle h3 {
    font-size: 20px;
    line-height: 1.2em;
}

.stm_upcoming_event_style_1 .stm_upcoming_event__date {
    line-height: 1.2em !important;
    margin-bottom: 15px !important;
}

.stm_projects_carousel__name {
    line-height: 1.2em;
    font-size: 16px !important;
}

.stm_projects_grid_style_2 .stm_projects__meta .inner h5 {
    text-transform: none !important;
}

.stm_projects_grid_style_2 .stm_projects__meta .inner .stm_projects__meta_terms {
    line-height: 1.4em
}

.stm_carousel_style_1 .owl-controls .owl-nav > *{
    background-color: transparent !important;
}

.stm_carousel .owl-nav .owl-prev:after {
	background: transparent !important;
}

.services_price_list_style_2 .service__tab.active {
    padding:0 30px;
}

.services_price_list_style_2 .service__tab_item {
    padding: 0 15px
}

.woocommerce .widget_layered_nav ul li a:hover {
    color: #fff !important;
}

.stm_donation_style_1 .stm_donation__progress-bar {
	background: #000 !important;
}

.stm_staff_grid_style_4 .stm_staff__socials li a {
	color: #000 !important;
}

.stm_layout_portfolio .stm_products li .price {
    color: #fff !important;
}
.stm_layout_portfolio .stm_products li .price ins,
.stm_layout_portfolio .stm_products li .price del,
.stm_layout_portfolio .stm_products li .price span {
    color: #fff !important;
}

.stm_layout_portfolio  div.product .woocommerce-tabs ul.tabs li a {
    transition: .3s ease;
}

.stm_layout_portfolio  div.product .woocommerce-tabs ul.tabs li:not(.active) {
    background: transparent !important;
}
.stm_layout_portfolio  div.product .woocommerce-tabs ul.tabs li:not(.active) a {
    color: #000 !important;
}

.stm_layout_portfolio.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
    transform: none;
    border-radius: 50%;
}