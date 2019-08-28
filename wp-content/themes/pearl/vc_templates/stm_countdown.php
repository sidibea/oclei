<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$classes = array("stm_countdown stm_countdown_{$style} heading_font");
$uniq = uniqid('stm_countdown_');
$classes[] = $uniq;

$custom_css = '';
if(!empty($text_color)) {
	$custom_css = ".{$uniq} {
        color: {$text_color};
    }";
}

pearl_add_element_style('countdown', $style, $custom_css);
wp_enqueue_script('jquery.countdown');

$translations = array(
	'days' => esc_html__('days, days', 'pearl'),
	'hours' => esc_html__('hours, hours', 'pearl'),
	'minutes' => esc_html__('minutes, minutes', 'pearl'),
	'seconds' => esc_html__('seconds, seconds', 'pearl'),
);

wp_localize_script('pearl_countdown', 'pearl_countdown_translations', $translations);
wp_enqueue_script( 'pearl_countdown' );


if(!empty($count_date)):
?>

<div class="<?php echo implode(' ', $classes); ?>">
	<div class="stm_countdown-container" data-date="<?php echo esc_js(date("Y/m/d", strtotime($count_date))); ?>"></div>
</div>

<?php endif;