<?php
$id = get_the_ID();
$participants = get_post_meta($id, 'cur_participants', true);
$max_participants = get_post_meta($id, 'participants_num', true);

if(empty($participants)) $participants = 0;

if($participants < $max_participants): ?>
    <a href="#stm_event_<?php echo intval($id); ?>"
       class="btn btn_solid btn_secondary btn_gradient">
        <span><?php esc_html_e('Book Now', 'pearl'); ?></span>
    </a>
<?php endif; ?>