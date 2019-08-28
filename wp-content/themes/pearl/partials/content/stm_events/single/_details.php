<?php
$tpl = '/partials/content/stm_events/single/';
$id = get_the_ID();
$address = get_post_meta($id, 'address', true);

$date_start = get_post_meta($id, 'date_start', true);

$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);

$date = $time = '';
$date = (!empty($date_start)) ? pearl_get_formatted_date($date_start) : '';

if(!empty($date_start_time)) $time .= $date_start_time;
if(!empty($date_end_time)) $time .= ' - ' . $date_end_time;

$terms = pearl_get_terms_array($id, 'event_category', 'name', true, array('class' => 'ttc no_deco mtc_h'));
?>

<div class="stm_single_event_details">
    <?php if(!empty($address)): ?>
        <div class="stm_single_event_detail address">
            <h4 class="title">
                <i class="stmicon-pin_b stc"></i>
                <?php esc_html_e('Venue', 'pearl'); ?>
            </h4>
            <p><?php echo sanitize_text_field($address); ?></p>

            <?php get_template_part($tpl . '_map'); ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($date) or !empty($time) or !empty($terms)): ?>
        <div class="stm_single_event_detail date_time">
            <h4 class="title">
                <i class="stc stmicon-date_time"></i>
                <?php esc_html_e('Details', 'pearl'); ?>
            </h4>
            <?php if(!empty($date)): ?>
                <div class="stm_event_date_info date">
                    <div class="stm_event_label"><?php esc_html_e('Date:', 'pearl'); ?></div>
                    <strong><?php echo sanitize_text_field($date); ?></strong>
                </div>
            <?php endif; ?>
            <?php if(!empty($time)): ?>
                <div class="stm_event_date_info time">
                    <div class="stm_event_label"><?php esc_html_e('Time:', 'pearl'); ?></div>
                    <strong><?php echo sanitize_text_field($time); ?></strong>
                </div>
            <?php endif; ?>

            <?php if(!empty($terms)): ?>
                <div class="stm_event_date_info terms">
                    <div class="stm_event_label"><?php esc_html_e('Categories:', 'pearl'); ?></div>
                    <strong><?php echo implode(', ', $terms); ?></strong>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php get_template_part($tpl . '_details', 2); ?>

</div>