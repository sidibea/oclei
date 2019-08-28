<?php
$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);
$address = get_post_meta($id, 'address', true);

$date = $time = '';
$date = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'M') : '';

if(!empty($date_start_time)) $time .= $date_start_time;
if(!empty($date_end_time)) $time .= ' - ' . $date_end_time;

?>

<a href="<?php the_permalink(); ?>"
   title="<?php the_title(); ?>"
   <?php echo esc_attr(post_class('stm_event_single_list no_deco')); ?>>


    <?php if(has_post_thumbnail()):
        $img_id = get_post_thumbnail_id($id);
        $image = pearl_get_VC_img($img_id, '350x150');
        echo wp_kses_post($image);
    endif; ?>


    <div class="inner">
        <?php if($date): ?>
            <div class="date">
                <span class="number heading_font">
                    <?php echo esc_attr(pearl_get_formatted_date($date_start, 'j')); ?>
                </span>
                <span><?php echo esc_attr($date); ?></span>
            </div>
        <?php endif; ?>
        <div class="stm_event_single_list__alone hasTitle">
            <h3 class="ttc"><?php the_title(); ?></h3>
        </div>
        <?php if($time): ?>
            <div class="stm_event_single_list__alone hasDate ttc">
                <i class="__icon icon_16px mtc stmicon-date_time"></i>
                <?php echo esc_attr($time); ?>
            </div>
        <?php endif; ?>
        <div class="stm_event_single_list__alone hasAddress ttc">
            <i class="__icon icon_16px mtc stmicon-pin_b"></i>
            <?php echo sanitize_text_field($address); ?>
        </div>
    </div>
</a>