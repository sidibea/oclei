<?php
$id = get_the_ID();
$details = array(
    'department' => esc_html__('Department:', 'pearl'),
    'location' => esc_html__('Project Location(s):', 'pearl'),
    'job_type' => esc_html__('Job Type:', 'pearl'),
    'education' => esc_html__('Education:', 'pearl'),
    'compensation' => esc_html__('Compensation:', 'pearl'),
);

$details_info = array();

pearl_add_element_style('details');

foreach($details as $detail_key => $detail_title) {
    $details_info[$detail_title] = get_post_meta($id, $detail_key, true);
}

$details_info = array_filter($details_info);

if(!empty($details_info)): ?>

    <div class="stm_details">
        <?php foreach($details_info as $title => $value): ?>
            <div class="info">
                <div class="stm_details__title heading_font stm_mgb_3">
                    <?php echo sanitize_text_field($title); ?>
                </div>
                <div class="stm_details__value">
                    <?php echo sanitize_text_field($value); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>