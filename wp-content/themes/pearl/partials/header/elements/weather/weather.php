<?php
if (!empty($element['value'])) :
	$city = $element['value']['city'];
	$units = $element['value']['units'];

	$weather = pearl_get_temp_by_city_name($city, $units);
	wp_enqueue_style('pearl_' . $element['type'], $theme_info['css'] . 'header/builder_elements/' . $element['type'] . '/element.css', array(), $theme_info['v']);
	?>

    <div class="stm_weather" title="<?php echo esc_attr($city); ?>">
        <div class="temperature">
            <i class="stmweathericon-<?php echo wp_kses_post($weather['icon']); ?>"></i>
            <span class="degree"><?php echo intval($weather['temp']) . ' '; ?></span><?php echo sprintf(esc_html__('in %s', 'pearl'), $city); ?>
        </div>
    </div>
<?php endif;