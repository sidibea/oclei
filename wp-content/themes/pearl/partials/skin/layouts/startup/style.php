<?php

/*Fonts*/
$fonts = pearl_get_font();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
	'colors'        => array(
		'main_color'      => array(
			'.stm_posttimeline_style_4 .stm_posttimeline__single:hover .stm_posttimeline__date span',
		),
		'secondary_color' => array(
		),
		'third_color'     => array(
            '.stm-counter_style_1 .stm-counter__affix',
            '.stm-counter_style_1 .stm-counter__label',
            '.stm-counter_style_1 .stm-counter__value',
            '.btn.btn_white_hover:hover',
		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
            '.stm_posttimeline_style_4 .stm_posttimeline__single:hover .stm_posttimeline__icon',
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

.stm_buttons_style_6 .btn {
    border-width: 4px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
}

body.stm_buttons_style_6 .btn.btn_solid,
body.stm_buttons_style_6 .btn.btn_outline {
    padding: 19px 37px 18px;
}

.stm_buttons_style_6 .btn.btn_solid:before,
.stm_buttons_style_6 .btn.btn_outline.btn_third:before,
.stm_buttons_style_6 .btn.btn_outline.btn_secondary:before,
.stm_buttons_style_6 .btn.btn_outline.btn_primary:before {
    content: '';
    position: absolute;
    top: -30px;
    left: -20px;
    bottom: -30px;
    right: -20px;
    background: inherit;
    border-radius: 50px;
    z-index: -1;
    opacity: 0.4;
    -webkit-transform: scale3d(0.8, 0.5, 1);
    transform: scale3d(0.8, 0.5, 1);
}

.stm_buttons_style_6 .btn.btn_solid:hover,
.stm_buttons_style_6 .btn.btn_outline.btn_primary:hover,
.stm_buttons_style_6 .btn.btn_outline.btn_secondary:hover,
.stm_buttons_style_6 .btn.btn_outline.btn_third:hover {
    -webkit-animation: anim-moema-1 0.3s;
    animation: anim-moema-1 0.3s;
}

.stm_buttons_style_6 .btn.btn_solid:hover:before,
.stm_buttons_style_6 .btn.btn_outline.btn_primary:hover:before,
.stm_buttons_style_6 .btn.btn_outline.btn_secondary:hover:before,
.stm_buttons_style_6 .btn.btn_outline.btn_third:hover:before {
    -webkit-animation: anim-moema-2 0.3s 0.3s forwards;
    animation: anim-moema-2 0.3s 0.3s forwards;
}

.stm-counter_style_1 .stm-counter__affix,
.stm-counter_style_1 .stm-counter__label,
.stm-counter_style_1 .stm-counter__value {
    font-weight: 600 !important;
}

.stm-counter_style_1 .stm-counter__affix,
.stm-counter_style_1 .stm-counter__value {
    font-size: 56px !important;
}

.stm-counter_style_1 .stm-counter__label {
    margin-bottom: 17px;
    font-size: 12px !important;
    letter-spacing: 2px;
}

body .stm_testimonials_style_5 .stm_testimonials__avatar {
    max-width: 137px;
    margin: -87px auto 20px;
    border: 0;
    background: transparent;
    box-shadow: none;
}

body .stm_testimonials_style_5 .stm_testimonials__review {
    padding: 84px 70px 120px 70px;
    font-style: normal;
    font-weight: 500;
    text-align: center;
    font-size: 28px;
    line-height: 46px;
}

body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-prev:before,
body .stm_testimonials_style_5 .owl-controls .owl-nav .owl-next:before {
    font-size: 33px;
}

body .stm_testimonials_style_5 .stm_testimonials__info h6 {
    font-size: 28px;
    font-weight: 500;
}

body .stm_testimonials_style_5 .stm_testimonials__info span {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.stm_form_style_5 select,
.stm_form_style_5 input[type="text"],
.stm_form_style_5 input[type="email"],
.stm_form_style_5 input[type="search"],
.stm_form_style_5 input[type="password"],
.stm_form_style_5 input[type="number"],
.stm_form_style_5 input[type="date"],
.stm_form_style_5 input[type="tel"],
.stm_form_style_5 textarea,
.stm_form_style_5 .form-control {
    height: 60px;
    padding-left: 30px;
    padding-right: 30px;
    border-radius: 35px;
    <?php if(!empty($secondary_font['name'])): ?>
        font-family: <?php echo esc_attr($secondary_font['name']); ?>
    <?php endif; ?>
}

.btn.btn_white_hover:hover {
    background-color: #fff !important;
    border-color: #fff !important;
}

.stm_footer_layout_1 .stm-footer__bottom {
    padding: 10px 0 50px;
}

.stm_footer_layout_1 .stm-footer__bottom .stm-socials__icon {
    background-color: transparent !important;
    opacity: 0.6;
}

.stm_footer_layout_1 .stm-footer__bottom .stm-socials__icon i {
    color: #fff !important;
}

.stm_footer_layout_1 .stm-footer__bottom .stm-socials__icon:hover {
    opacity: 1;
}

.stm_layout_startup.stm_header_style_1 .stm-navigation__default > ul > li > a {
    padding: 0 30px;
    font-size: 12px;
    letter-spacing: 2.6px;
}

.stm_layout_startup.stm_header_style_1 .stm-navigation__line_bottom > ul > li:before {
    left: 30px;
    right: 30px;
}

.stm_cta.style_1 {
    padding: 14px 0 1px 0;
}

@media (max-width: 1200px) {
    .stm-socials__icon {
        margin: 0 5px;
    }
}

@media (max-width: 1024px) {
    .stm_layout_startup.stm_header_style_1 .stm-navigation__default > ul > li > a {
        padding: 15px 0;
        font-size: 15px;
    }
}

@media (max-width: 550px) {
    .h2, h2 {
        font-size: 3em !important;
    }
}

@media (max-width: 767px) {
    body .stm_testimonials_style_5 .stm_testimonials__review {
        padding: 30px 30px 60px;
        font-size: 1.3em;
        line-height: 2em;
    }
    body .stm_testimonials_style_5 .stm_testimonials__avatar {
        max-width: 90px;
        margin-top: -45px;
    }

    body .stm_cta.style_1 .stm_cta__content {
        margin-bottom: 45px;
    }
}

.stm-header__row_color.pearl_is_sticky.pearl_sticked {
    padding-top: 10px !important;
    padding-bottom: 10px !important;
}

.stm-header__row_color.pearl_is_sticky.pearl_sticked .stm-logo img {
    width: 80%;
}