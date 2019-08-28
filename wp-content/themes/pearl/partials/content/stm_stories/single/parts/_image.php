<?php
if(has_post_thumbnail()):
$id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id($id);
if(function_exists('pearl_get_VC_img')) {
    $image = pearl_get_VC_img($thumbnail_id, '382x378');
} else {
    $image = pearl_get_image_url($id);
}
?>


    <?php echo wp_kses_post($image); ?>


<?php endif; ?>