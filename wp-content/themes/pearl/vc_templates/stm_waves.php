<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$offset = 0;

$rand = uniqid('stm_wave');

$classes = array();
$classes[] = $rand;
$classes[] = 'stm_waves_module stm_waves_module_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

pearl_add_element_style('waves', $style);

$url = get_template_directory_uri() . '/assets/img/';

?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="waveWrapper <?php if($animation == true) : ?>waveAnimation<?php endif; ?>">
        <div class="waveWrapperInner first">
            <div class="wave" style="background-image: url('<?php if(!empty($wave_1)) {echo pearl_get_image_url($wave_1);} else {echo esc_url($url . 'bg-wave2.png'); } ?>')"></div>
        </div>
        <div class="waveWrapperInner second">
            <div class="wave" style="background-image: url('<?php if(!empty($wave_2)) {echo pearl_get_image_url($wave_2);} else {echo esc_url($url . 'bg-wave1.png'); } ?>')"></div>
        </div>
    </div>
</div>



<style type="text/css">
    .<?php echo esc_attr($rand); ?> {
        height: <?php echo esc_attr($container_height) ?>px !important;
    }
    .<?php echo esc_attr($rand); ?> .first .wave {
        top: <?php echo esc_attr($wave_1_top_indent) ?>px !important;
    }
    .<?php echo esc_attr($rand); ?> .first {
         opacity: <?php echo esc_attr($wave_1_opacity) ?> !important;
    }
    .<?php echo esc_attr($rand); ?> .second .wave {
        top: <?php echo esc_attr($wave_2_top_indent) ?>px !important;
    }
    .<?php echo esc_attr($rand); ?> .second {
        opacity: <?php echo esc_attr($wave_2_opacity) ?> !important;
    }
    <?php if($animation == true) : ?>
    .<?php echo esc_attr($rand); ?> .waveAnimation .first .wave {
        animation: move_wave  <?php echo esc_attr($wave_1_animation_speed) ?>s linear infinite !important;
    }
    .<?php echo esc_attr($rand); ?> .waveAnimation .second .wave {
        animation: move_wave  <?php echo esc_attr($wave_2_animation_speed) ?>s linear infinite !important;
    }
    <?php endif; ?>
</style>



