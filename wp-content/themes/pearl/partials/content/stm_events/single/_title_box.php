<?php
$id = get_the_ID();
$style = '';
if(has_post_thumbnail()) {
    $image = pearl_get_image_url(get_post_thumbnail_id($id));
    if(!empty($image)) {
        $style = "style=\"background-image:url('{$image}')\"";
    }
}

$date_start = get_post_meta($id, 'date_start', true);
$date = (!empty($date_start)) ? pearl_get_formatted_date($date_start, 'M') : '';
?>

<div class="vc_container-fluid-force mbc" <?php echo sanitize_text_field($style); ?>>
    <div class="container">
        <div class="inner">
            <?php if(!empty($date)): ?>
                <div class="date">
                <span class="number heading_font">
                    <?php echo esc_attr(pearl_get_formatted_date($date_start, 'j')); ?>
                </span>
                    <span><?php echo esc_attr($date); ?></span>
                </div>
            <?php endif; ?>
            <h2 class="wtc"><?php the_title(); ?></h2>
        </div>
    </div>
</div>