<?php
$id = get_the_ID();
$participants = get_post_meta($id, 'cur_participants', true);
$max_participants = get_post_meta($id, 'participants_num', true);

if(empty($participants)) $participants = 0;

if($participants < $max_participants): ?>
    <div class="stm_event_wide_details text-center">
        <div class="stm_single_event_part-label mbc wtc">
            <i class="stmicon-bon-user"></i>
            +<span><?php echo esc_attr($participants); ?></span>
        </div>
        <a href="#stm_event_<?php echo intval($id); ?>"
           class="btn btn_outline btn_primary ttc wtc_h">
            <?php esc_html_e('Join now', 'pearl'); ?>
        </a>
    </div>
<?php endif;