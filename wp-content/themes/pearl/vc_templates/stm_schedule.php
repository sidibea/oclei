<?php
$style = 'style_1';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

pearl_add_element_style('schedule', $style);
wp_enqueue_script('pearl_schedule');

$content = str_replace('[stm_schedule_item', '[stm_schedule_item stm_date_format="' . $stm_event_lesson_date_format . '" stm_time_format="' . $stm_event_lesson_time_format . '"', $content);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
?>

<div class="stm_schedule stm_schedule_<?php echo esc_attr($style); ?>">
    <div class="events_lessons_box">
        <?php echo wpb_js_remove_wpautop($content); ?>
    </div>
</div>