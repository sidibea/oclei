<?php
$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$date_end = get_post_meta($id, 'date_end', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);
$address = get_post_meta($id, 'address', true);

$date_day_start = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'j') : '';
$date_day_end = (!empty($date_end)) ? pearl_get_formatted_date($date_end, 'j') : '';
$date_month_start = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'F') : '';
$date_month_end = (!empty($date_end)) ? pearl_get_formatted_date($date_end, 'F') : '';
$date_year_start = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'Y') : '';
$date_year_end = (!empty($date_end)) ? pearl_get_formatted_date($date_end, 'Y') : '';

$date = $time = '';
if( $date_month_start === $date_month_end ) {
    $date .= $date_month_start;
    if( $date_day_start < $date_day_end ) {
        $date .= ' ' . $date_day_start . ' &ndash; ' . $date_day_end;
    } else {
        $date .= ' ' .$date_day_start;
    }
    $date .= ', ' . $date_year_start;
} elseif(empty($date_month_end)) {
    $date .= $date_month_start . ' ' . $date_day_start . ', ' . $date_year_start;
} elseif($date_year_start != $date_year_end) {
    $date .= $date_month_start . ' ' . $date_day_start . ', ' . $date_year_start . ' &ndash; ' . $date_month_end . ' ' . $date_day_end . ', ' . $date_year_end;
} else {
    $date .= $date_month_start . ' ' . $date_day_start;
    $date .= ' &ndash; ' . $date_month_end . ' ' . $date_day_end;
    $date .= ', ' . $date_year_start;
}


if(!empty($date_start_time)) $time .= $date_start_time;

?>

<div <?php echo esc_attr(post_class('stm_event_single_list no_deco')); ?>>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >

        <span class="stm_event_single_list__alone hasThumbnail">
            <?php if(has_post_thumbnail()):
                $img_id = get_post_thumbnail_id($id);
                $image = pearl_get_VC_img($img_id, '370x220');
                echo wp_kses_post($image);
            endif; ?>
        </span>

        <span class="stm_event_single_list__alone hasTitle">
            <h3 class="ttc"><?php the_title(); ?></h3>
        </span>
    </a>
    <div class="inner">
        <?php if(!empty($date) and $time): ?>
        <div class="stm_event_single_list__alone hasDate ttc">
            <i class="__icon icon_16px mtc stmicon-date_time"></i>
            <?php echo esc_attr($date); ?>
            <?php echo esc_attr($time); ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($address)): ?>
        <div class="stm_event_single_list__alone hasAddress ttc">
            <i class="__icon icon_16px mtc stmicon-pin_b"></i>
            <?php echo sanitize_text_field($address); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="stm_event_single_list__alone hasButton">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php esc_html_e('View details', 'pearl') ?>
        </a>
    </div>
</div>
