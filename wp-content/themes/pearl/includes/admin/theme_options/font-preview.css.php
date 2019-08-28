<?php
$fonts = pearl_get_font();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
?>

.stm_to-single_control-body_font .stm-font-preview {
	<?php pearl_css_styles($main_font); ?>
}

.stm_to-single_control-h1_settings .stm-font-preview,
.stm_to-single_control-h2_settings .stm-font-preview,
.stm_to-single_control-h3_settings .stm-font-preview,
.stm_to-single_control-h4_settings .stm-font-preview,
.stm_to-single_control-h5_settings .stm-font-preview,
.stm_to-single_control-h6_settings .stm-font-preview {
	<?php pearl_css_styles($secondary_font); ?>
}