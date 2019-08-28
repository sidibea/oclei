<?php get_header('404'); ?>

<?php
$bg = pearl_get_option('error_page_bg');
$bg_style = '';
if(!empty($bg)) {
    $bg = pearl_get_image_url($bg);
    $bg_style = 'style="background-image:url(\''.$bg.'\')"';
}
?>

    <div class="stm_errorpage" <?php echo sanitize_text_field($bg_style); ?>>
        <div class="stm_errorpage__inner">
            <h1 class="no_line"><?php esc_html_e('404', 'pearl'); ?></h1>
            <div class="stm_icon_separator stm_icon_separator_599432e5afc5f stm_icon_separator_style_1   mbdc_a mbdc_b mtc">
                <span class="stmicon-uniE6D5"></span>
            </div>
            <p class="stm_mgb_30 stm_errorpage__description">
                <?php esc_html_e('We are sorry, the page you requested cannot be found', 'pearl'); ?>
            </p>
            <p class="stm_mgb_40">
                <?php esc_html_e('You may want to check the following links:', 'pearl'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn_primary btn_outline btn_gradient">
                <span><em><?php esc_html_e('Return to home page', 'pearl'); ?></em></span>
            </a>
        </div>
    </div>
<?php get_footer('404'); ?>