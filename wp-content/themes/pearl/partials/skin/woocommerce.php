<?php
/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

/*Color*/
$colors = array(
	'main_color'         => array(
		'.woocommerce .price ins',
		'.woocommerce .price > span',
		'.woocommerce .star-rating span:before',
		'.single-product .woocommerce-review-link:hover',
		'.product_meta a:hover',
		'.woocommerce table.shop_table tbody tr td.product-subtotal span',
		'.woocommerce table.shop_table tbody tr:hover td.product-name a',
		'.order-total span.amount',
		'.woocommerce .widget_product_categories .product-categories li .children li:hover a',
	),
	'secondary_color' => array(),
	'third_color'     => array(
		'.product_meta a',
		'.woocommerce table.shop_table tbody tr td.product-name a',
		'.woocommerce #customer_details h3',
		'.woocommerce .widget_layered_nav ul li',
		'.woocommerce .widget_layered_nav ul li a',
		'.woocommerce .widget_product_categories .product-categories > li > a',
		'.woocommerce .widget_product_categories .product-categories li .children li a',
		'.mini-cart,.mini-cart a',
	)
);

/*Background color*/
$bg_colors = array(
	'main_color'         => array(
		'.woocommerce ul.stm_products li.product:hover .stm_single_product__meta',
		'.woocommerce span.onsale',
		'.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover',
		'.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
		'.woocommerce .button:hover',
		'.woocommerce table.shop_table thead tr th',
		'.woocommerce .woocommerce-info',
		'.woocommerce-account .woocommerce-MyAccount-navigation ul li a',
		'.woocommerce-account .woocommerce-MyAccount-content .woocommerce-Addresses .edit:hover',
		'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
		'.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range',
		'.woocommerce .widget_layered_nav ul li:hover',
		'.woocommerce .widget_product_categories .product-categories > li:hover > a',
		'.woocommerce .widget_product_tag_cloud .tagcloud a:hover',
	),
	'secondary_color' => array(),
	'third_color'     => array(
		'.stm_single_product__meta',
		'.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt',
		'.woocommerce .woocommerce-message .button.woocommerce-Button:hover, .woocommerce .woocommerce-error .button.woocommerce-Button:hover, 
		.woocommerce .woocommerce-info .button.woocommerce-Button:hover',
		'.woocommerce .woocommerce-message .button.wc-forward:hover, .woocommerce .woocommerce-error .button.wc-forward:hover, 
		.woocommerce .woocommerce-info .button.wc-forward:hover',
		'.woocommerce div.product .woocommerce-tabs ul.tabs li',
		'.woocommerce .button',
		'.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
		'.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover',
		'.woocommerce-account .woocommerce-MyAccount-content .woocommerce-Addresses .edit',
	)
);

/*Border color*/
$border_colors = array(
	'main_color'         => array(
		'.woocommerce-product-gallery__image:nth-child(n+2):hover img',
		'.stm_form_style_3.woocommerce select:focus, .stm_form_style_3.woocommerce input[type="text"]:focus, 
		.stm_form_style_3.woocommerce input[type="email"]:focus, .stm_form_style_3.woocommerce input[type="search"]:focus, 
		.stm_form_style_3.woocommerce input[type="password"]:focus, .stm_form_style_3.woocommerce input[type="number"]:focus, 
		.stm_form_style_3.woocommerce input[type="date"]:focus, .stm_form_style_3.woocommerce input[type="tel"]:focus, 
		.stm_form_style_3.woocommerce textarea:focus, .stm_form_style_3.woocommerce .form-control:focus, 
		.stm_form_style_3 .woocommerce select:focus, .stm_form_style_3 .woocommerce input[type="text"]:focus, 
		.stm_form_style_3 .woocommerce input[type="email"]:focus, .stm_form_style_3 .woocommerce input[type="search"]:focus, 
		.stm_form_style_3 .woocommerce input[type="password"]:focus, .stm_form_style_3 .woocommerce input[type="number"]:focus, 
		.stm_form_style_3 .woocommerce input[type="date"]:focus, .stm_form_style_3 .woocommerce input[type="tel"]:focus, 
		.stm_form_style_3 .woocommerce textarea:focus, .stm_form_style_3 .woocommerce .form-control:focus,
		.woocommerce .widget_product_tag_cloud .tagcloud a:hover',
		'.cart_rounded',
	),
	'secondary_color' => array(),
	'third_color'     => array(
		'.woocommerce .woocommerce-message .button:hover,.woocommerce .woocommerce-error .button:hover,.woocommerce .woocommerce-info .button:hover',
	),
);

foreach ($colors as $color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
<?php }

foreach ($bg_colors as $bg_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
<?php }

foreach ($border_colors as $border_color => $elements) { ?>
	<?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
<?php } ?>

.woocommerce .quantity .decrease:hover {
	border-top-color: <?php echo esc_attr($main_color); ?>;
}

.woocommerce .quantity .increase:hover {
	border-bottom-color: <?php echo esc_attr($main_color); ?> !important;
}

.stm_single_product__more,
.woocommerce ul.stm_products li.product .button {
	background-color: rgba(<?php echo esc_attr(pearl_hex2rgb($third_color, 0.9)); ?>);
}

.stm_single_product__more:hover,
.woocommerce ul.stm_products li.product .button:hover {
	background-color: rgba(<?php echo esc_attr(pearl_hex2rgb($main_color, 0.9)); ?>);
}

.stm_form_style_3.woocommerce select:focus, .stm_form_style_3.woocommerce input[type="text"]:focus,
.stm_form_style_3.woocommerce input[type="email"]:focus, .stm_form_style_3.woocommerce input[type="search"]:focus,
.stm_form_style_3.woocommerce input[type="password"]:focus, .stm_form_style_3.woocommerce input[type="number"]:focus,
.stm_form_style_3.woocommerce input[type="date"]:focus, .stm_form_style_3.woocommerce input[type="tel"]:focus,
.stm_form_style_3.woocommerce textarea:focus, .stm_form_style_3.woocommerce .form-control:focus,
.stm_form_style_3 .woocommerce select:focus, .stm_form_style_3 .woocommerce input[type="text"]:focus,
.stm_form_style_3 .woocommerce input[type="email"]:focus, .stm_form_style_3 .woocommerce input[type="search"]:focus,
.stm_form_style_3 .woocommerce input[type="password"]:focus, .stm_form_style_3 .woocommerce input[type="number"]:focus,
.stm_form_style_3 .woocommerce input[type="date"]:focus, .stm_form_style_3 .woocommerce input[type="tel"]:focus,
.stm_form_style_3 .woocommerce textarea:focus, .stm_form_style_3 .woocommerce .form-control:focus,
.woocommerce .stm_material_form input:focus {
	box-shadow: 0 0 2px <?php echo esc_attr($main_color); ?> !important;
}

<?php
/*FONTS*/
$fonts = pearl_get_font();
$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

if (!empty($secondary_font['name'])): ?>
	.woocommerce .widget_product_categories .product-categories li a,
	.woocommerce .widget_layered_nav ul li,
	.woocommerce .widget_layered_nav ul li a,
	.woocommerce-account .woocommerce-MyAccount-content .woocommerce-Addresses .edit,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li a,
	.cart-empty,
	.woocommerce table.shop_table,
	.woocommerce-review__author,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,
	.woocommerce .woocommerce-message .button,
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button,
	.woocommerce .price > span,
	.woocommerce .price
	{
	font-family: "<?php echo esc_attr($secondary_font['name']); ?>";
	}
<?php endif; ?>