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

		),
		'secondary_color' => array(),
		'third_color'     => array(

		)
	),
	'bg_colors'     => array(
		'main_color'      => array(
            '.stm_testimonials_style_1 .stm_testimonials__review'
		),
		'secondary_color' => array(),
		'third_color'     => array(

		)
	),
	'border_colors' => array(
		'main_color'      => array(
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

.stm_video_style_9 .stm_playb:before {
    border-color: transparent transparent transparent <?php echo $main_color; ?>;
}

.stm_read_more {
    font-weight: 700;
    font-size: 14px;
}

.stm_read_more:before {
    content: '\10fff6';
    font-family: stmicons;
    display: inline-block;
    margin-right: 5px;
    font-weight: normal;
    font-size: 10px;
}


.stm_iconbox_style_1 .stm_flipbox__back h5,
.stm_iconbox_style_1 .stm_flipbox__front h5
{
    font-size: 22px;
    font-weight: bold;
}

.stm_iconbox_style_1 .stm_flipbox__back .stm_iconbox__desc p,
.stm_iconbox_style_1 .stm_flipbox__front .stm_iconbox__desc p
{
    font-size: 18px;
    line-height: 30px;
    letter-spacing: 0;
}

.stm_testimonials_style_1 .stm_testimonials__review {
    color: #fff;
    line-height: 36px !important;
    font-size: 18px;
    padding: 48px 30px 39px !important;
}
.stm_testimonials_style_1 .stm_testimonials__review:after {
    border-color: <?php echo pearl_adjust_color_brightness($main_color, -100); ?> <?php echo pearl_adjust_color_brightness($main_color, -100); ?> transparent transparent !important;
}

.stm_testimonials_style_1 .owl-controls .owl-dots  {
    margin-left: 42px;
    margin-top:15px;
}

.stm_posts_list_style_16 h5 a {
    color: <?php echo esc_attr($third_color); ?> !important;
}

.stm_posts_list_style_16 .stm_posts_list_single__info .date i {
    color: <?php echo esc_attr($third_color); ?> !important;
}
body.stm_footer_layout_3 .stm-footer__bottom {
    padding: 23px 0;
}

body.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon {
    width: 32px;
    height: 32px;
    line-height: 34px;
    border: 0;
    margin: 0 6px;
    background: #fff;
    color: <?php echo esc_attr($third_color); ?> !important;
}
body.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon i {
    color: <?php echo esc_attr($third_color); ?> !important;
}

body.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon i:hober {
    color:#fff !important;
}

body.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon:hover {
    background-color: <?php echo esc_attr($main_color); ?>;
}

.stm_gmap_wrapper.style_1 .gmap_addresses:before {
    background-color: #262626 !important;
    opacity: 1 !important;
}
.stm_gmap_wrapper.style_1 .icon i {
    color: #525252;
}

.stm_gmap_wrapper.style_1 .owl-dots-wr .owl-dots .owl-dot {
    width: 21px;
    height: 21px;
    background-color: transparent;
    border-color: transparent;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px !important;
}

.stm_gmap_wrapper.style_1 .owl-dots-wr .owl-dots .owl-dot.active {
    background-color: transparent !important;
    border-color: <?php echo esc_attr($main_color); ?>
}

.stm_gmap_wrapper.style_1 .owl-dots-wr .owl-dots .owl-dot.active span {
    background-color: <?php echo esc_attr($main_color); ?>;
}


.stm_gmap_wrapper.style_1 .owl-dots-wr .owl-dots .owl-dot span {
display: block;
    width: 5px;
    height:5px;
    background-color: rgba(255,255,255,.5);
    border-radius: 50%;
}

.stm_header_style_1 .stm-socials a {
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color:#fff;
    border-radius: 50%;
}
.stm_header_style_1 .stm-socials a:hover {
    text-decoration: none;
    background-color: <?php echo esc_attr($third_color); ?> !important;
}
.stm_header_style_1 .stm-socials a:hover i {
    color: #fff !important;
}
.stm_header_style_1 .stm-socials a i {
    font-size: 15px;
    color: <?php echo esc_attr($main_color) ?>;
}