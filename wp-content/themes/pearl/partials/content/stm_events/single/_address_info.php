<?php
$id = get_the_ID();
$address = get_post_meta($id, 'address', true);

$date_start = get_post_meta($id, 'date_start', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end = get_post_meta($id, 'date_end', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);

$date = $time = '';
$date = (!empty($date_start)) ? pearl_get_formatted_date($date_start) : '';
if(!empty($date) and !empty($date_end)) {
    $date .= ' - ' . pearl_get_formatted_date($date_end);
}

if(!empty($date_start_time)) $time .= $date_start_time;
if(!empty($date_end_time)) $time .= ' - ' . $date_end_time;

if(!empty($date) or !empty($address) or !empty($time)): ?>
    <div class="stm_single_event__info clearfix wtc">
        <div class="stm_single_event__overlay mbc"></div>
        <?php if(!empty($address)): ?>
            <div class="stm_single_event__addr">
                <i class="wtc __icon icon_27px stmicon-pin_b"></i>
                <h4 class="wtc">
                    <?php esc_html_e('Location', 'pearl'); ?>
                </h4>
                <p><?php echo sanitize_text_field($address); ?></p>
            </div>
        <?php endif; ?>
        <?php if(!empty($date) or !empty($time)): ?>
            <div class="stm_single_event__date">
                <i class="wtc __icon icon_27px stmicon-date_time"></i>
                <h4 class="wtc">
                    <?php esc_html_e('Date & Time', 'pearl'); ?>
                </h4>
                <p>
                    <?php echo sanitize_text_field($date); ?>
                    <?php echo sanitize_text_field($time); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>