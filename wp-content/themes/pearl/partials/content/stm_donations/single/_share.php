<?php
$link = get_the_permalink();
$image = pearl_get_image_url(get_post_thumbnail_id());

$socials = array();

$socials['facebook'] = "https://www.facebook.com/sharer/sharer.php?u={$link}";
$socials['twitter'] = "https://twitter.com/home?status={$link}";
$socials['google-plus'] = "https://plus.google.com/share?url={$link}";
$socials['linkedin'] = "https://www.linkedin.com/shareArticle?mini=true&url={$link}&title=&summary=&source=";
$socials['pinterest'] = "https://pinterest.com/pin/create/button/?url={$link}&media={$image}&description=";
?>

<div class="stm_share stm_js__shareble">
    <?php foreach ($socials as $social => $url): ?>
        <a href="#"
           class="__icon icon_12px stm_share_<?php echo esc_attr($social); ?>"
           data-share="<?php echo esc_url($url); ?>"
           data-social="<?php echo esc_attr($social); ?>">
            <i class="fa fa-<?php echo esc_attr($social); ?>"></i>
        </a>
    <?php endforeach; ?>
</div>