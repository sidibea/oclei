<?php
$author_name = get_the_author_meta('display_name');
$author_bio = get_the_author_meta( 'description' );
?>

<div class="stm_author_box clearfix stm_mgb_50">
    <div class="stm_author_box__avatar">
        <?php echo get_avatar( get_the_author_meta( 'email' ), 174 ); ?>
    </div>
    <div class="stm_author_box__info">
        <div class="stm_author_box__name">
            <?php esc_html_e( 'Author:', 'pearl' ); ?>
            <strong><?php echo esc_html($author_name); ?></strong>
        </div>
        <div class="stm_author_box__content"><?php echo wp_kses_post($author_bio); ?></div>
    </div>
</div>