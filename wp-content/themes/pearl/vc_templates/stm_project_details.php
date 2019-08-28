<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_project_details');
$classes[] = 'stm_project_details_' . $style;
$classes[] = ($style == 'style_3') ? 'mbdc' : '';
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
pearl_add_element_style('project_details', $style);

$fields = array(
    'client' => esc_html__('Client name:', 'pearl'),
    'location'=> esc_html__('Location:', 'pearl'),
    'surface'=> esc_html__('Surface Area:', 'pearl'),
    'started'=> esc_html__('Started', 'pearl'),
    'completed'=> esc_html__('Completed:', 'pearl'),
    'date'=> esc_html__('Date:', 'pearl'),
    'value'=> esc_html__('Value:', 'pearl'),
    'category'=> esc_html__('Category:', 'pearl'),
    'architect'=> esc_html__('Architect:', 'pearl')
);

$id = get_the_ID();
?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <?php if(!empty($title)): ?>
        <h4><?php echo sanitize_text_field($title); ?></h4>
    <?php endif; ?>
    <div class="stm_project_details__table">
        <?php foreach($fields as $field => $field_name):
            $value = get_post_meta($id, $field, true);
            if(empty($value)) continue;
            ?>
            <div class="stm_project_details__single">
                <div class="stm_project_details__label"><?php echo sanitize_text_field($field_name); ?></div>
                <div class="stm_project_details__value heading_font"><?php echo sanitize_text_field($value); ?></div>
            </div>
        <?php endforeach; ?>
        <?php if(!empty($site_url)): ?>
            <div class="stm_project_details__single">
                <div class="stm_project_details__label">
                    <?php esc_html_e('Website', 'pearl'); ?>
                </div>
                <div class="stm_project_details__value heading_font">
                    <a href="<?php echo esc_url($site_url); ?>">
                        <?php echo esc_attr($site_url); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>