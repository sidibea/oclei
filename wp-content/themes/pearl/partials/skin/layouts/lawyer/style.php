<?php
$site_width = intval(pearl_get_option('site_width', '1170'));

/*Default layout styles*/
$default = pearl_get_layout_config();

/*Colors*/
$main_color = pearl_get_option('main_color', $default['main_color']);
$secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
$third_color = pearl_get_option('third_color', $default['third_color']);

$elements_list = array(
	'colors'        => array(
		'main_color'      => array(
            '.mc4wp-form .stmicon-lawyer_arrow:before',
			'.owl-nav .owl-next:after, .owl-nav .owl-prev:after',
            '.stm_testimonials_style_10 .stm_testimonials:before',
            '.widget_contacts_style_3 .widget_contacts_inner .stm-icontext_style2 .stm-icontext__icon',
            '.stm_services_text_carousel_style_3 .stm_services_carousel .content:hover h5.stm_counter',
		),
		'secondary_color' => array(
            '.owl-nav .owl-next:before, .owl-nav .owl-prev:before',
            '.mc4wp-form button[type="submit"] i',
		),
		'third_color'     => array(
            'button[type=submit]:not(.btn), input[type=submit]:not(.btn)'
		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
            'strong a:after',
            'body table.booked-calendar td.today:hover .date span',
            '.stm_services_style_8 .stm_loop__grid:hover .stm_services__content:after',
            '.stm_partners_style_4 .stm_partners__single:hover .stm_partners__image',
		),
		'secondary_color' => array(
            '.stm_layout_lawyer .stm_testimonials_style_10 .stm_testimonials__info h6:before'
		),
		'third_color'     => array(

		)
	),
	'border_colors' => array(
		'main_color'      => array(
            'body table.booked-calendar td.today .date span'
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

.stm-header__row_color_top:after {
	width: <?php echo (intval($site_width) - 30); ?>px;
}

.stm_carousel_dots_bottom .owl-dots {
    text-align: center;
}

/*Lawyer*/
.stm_testimonials.stm_testimonials_style_10 .title_sep {
    display: none;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials:before {
    display: block;
    margin-bottom: 37px;
    content: "";
    font-family: 'stmicons';
    font-size: 56px;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__item {
    padding: 30px 0;
    text-align: left;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__item:hover:after {
    opacity: 1;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__avatar {
    margin: 0 0 20px 95px;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__review {
    margin-bottom: 34px !important;
    font-size: 20px !important;
    font-style: italic;
    font-weight: 500;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__info {
    position: relative;
    padding-left: 95px;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__info h6 {
    margin-bottom: 3px;
    font-size: 18px !important;
    color: #fff !important;
    text-transform: uppercase !important;
    font-weight: 600 !important;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__info h6:before {
    content: '' !important;
    position: absolute;
    top: 9px;
    left: 0;
    width: 65px;
    height: 2px;
}

.stm_testimonials.stm_testimonials_style_10 .stm_testimonials__info span {
    opacity: .5;
    color: #fff;
    font-size: 16px;
    font-style: italic;
}

.stm_partners_style_4 .stm_partners__single {
    width: 50% !important;
}

.stm_partners_style_4 .stm_partners__single:nth-child(2) a:before {
    position: absolute;
    top: -15px;
    right: -1px;
    content: '';
    display: block;
    width: 1px;
    height: 30px;
    background-color: #ccc;
}

.stm_partners_style_4 .stm_partners__single:nth-child(2) a:after {
    position: absolute;
    top: 0px;
    right: -15px;
    content: '';
    display: block;
    width: 30px;
    height: 1px;
    background-color: #ccc;
}

.stm_layout_lawyer .stm-footer .footer-widgets aside.widget .widgettitle h4 {
    color: #fff !important;
    font-size:22px;
    text-transform: none !important;
}

.widget_contacts_style_3 .widget_contacts_inner i {
    position: relative;
    top: 1px;
}

.widget_contacts_style_3 .widget_contacts_inner .fa-envelope:before {
    position: relative;
    top: 3px;
}

.stmicon-med_time:before {
    content: "\e91c";
}

.mc4wp-form {
    position: relative;
}

.mc4wp-form button {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
}

.mc4wp-form button[type="submit"] {
    background: transparent !important;
    padding: 7px 15px !important;
}

.mc4wp-form input[type="email"] {
    padding-right: 50px;
}

.mc4wp-form button[type="submit"] i {
    display: block;
    position: relative;
    overflow: hidden;
}

.mc4wp-form button[type="submit"] i:before {
    display:block;
    transform: translateX(0);
}

.mc4wp-form button[type="submit"]:hover i:before {
    transform: translateX(47px);
}

.mc4wp-form button[type="submit"]:hover i:after {
    transform: translateX(0px);
}

.mc4wp-form button[type="submit"] i:after,
.mc4wp-form button[type="submit"] i:before {
    transition: .3s ease;
}

.mc4wp-form button[type="submit"] i:after {
    content: "\7004";
    position:absolute;
    top: 0;
    left: 0;
    transform: translateX(-47px);
}

.stm-footer__bottom {
    border-top: 1px solid rgba(255,255,255,.25);
}

.stm-footer__bottom .stm-socials {
    margin: 0 -15px;
}

.stm-footer__bottom .stm-socials__icon {
    width: auto;
    margin: 0 15px;
    background: none !important;
    opacity: 0.5;
}

.stm-footer__bottom .stm-socials__icon:hover {
    opacity: 1;
}

.stm-footer__bottom .stm-socials__icon i {
    color: #fff !important;
}

.stm_bottom_copyright {
    font-size: 14px;
}

.stm_layout_lawyer .stm_iconlist ul li i {
    top: -2px;
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
    color: #595959 !important;
    border-color: #d9d9d9 !important;
}

.wpcf7-textarea {
    min-height: 192px;
}

.stm-navigation > ul > li > a {
    letter-spacing: 2px;
}

.stm-header__row_color_center:before {
    border-bottom: 1px solid #bfbfbf;
}

.stm_sidebar_style_1 .stm-footer {
    padding: 87px 0 0;
}

.stm-footer .footer-widgets {
    padding-bottom: 8px;
}

button[type=submit]:not(.btn), input[type=submit]:not(.btn) {
    padding: 12px 43px;
    font-size:18px;
    letter-spacing: 1.2px;
    font-weight: 600;
}

button[type=submit]:not(.btn):hover,
input[type=submit]:not(.btn):hover {
    color: #fff !important;
}

@media (max-width:1023px) {
    .stm-navigation__default>ul {
        margin: 0;
    }
    body .stm-navigation__default ul li.href_empty a{
        position:relative
    }

    body .stm-navigation__default ul li ul li .stm_mobile__dropdown{
        display:block!important
    }

    body .stm-navigation__default ul li .stm_mobile__dropdown{
        right:0;
        width:40px;
        height:100%
    }

    body .stm-navigation__default ul li .stm_mobile__dropdown:after{
        position:absolute;
        right:15px;
        top:50%;
        margin-top:-2px;
        content:'';
        width:0;
        height:0;
        border-style:solid;
        border-width: 6px 5px 0;
        border-color: <?php echo esc_attr($main_color); ?> transparent transparent;
    }
}

body .stm_donation_style_2 .stm_donation__details-wrapper {
    padding-top: 10px;
    padding-bottom: 15px;
}

.stm_projects_carousel__name {
    font-size: 17px;
    line-height: 24px;
}

.stm_pagination_style_10 .owl-dots .owl-dot {
    display: inline-block;
}