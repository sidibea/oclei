<?php
$id = get_the_ID();
$participants = get_post_meta($id, 'cur_participants', true);
$max_participants = get_post_meta($id, 'participants_num', true);

if(empty($participants)) $participants = 0;

if($participants < $max_participants): ?>
    <a href="#stm_event_<?php echo intval($id); ?>"
       class="btn btn_outline btn_primary ttc wtc_h">
        <?php esc_html_e('Join now', 'pearl'); ?>
        <span class="stm_single_event_part-label ttc">
            <?php echo esc_attr($participants); ?>
        </span>
    </a>
<?php endif;