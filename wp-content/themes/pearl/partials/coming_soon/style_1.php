<?php
$bg_style = '';
if (has_post_thumbnail()) {
    $bg = pearl_get_image_url(get_post_thumbnail_id());
    $bg_style = 'style="background-image:url(\'' . $bg . '\')"';
}
?>


<div class="stm_coming_soon" <?php echo sanitize_text_field($bg_style); ?>>
    <div class="stm_coming_soon__inner container">
        <h1><?php the_title(); ?></h1>
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }
        ?>
    </div>
</div>