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
        <div class="stm_errorpage__inner text-center">
            <h1 class="no_line wtc"><?php esc_html_e('404', 'pearl'); ?></h1>
            <p class="stm_mgb_43 wtc">
                <?php esc_html_e('The page you are looking for does not exist.', 'pearl'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn_white btn_outline">
                <?php esc_html_e('Go back to homepage', 'pearl'); ?>
            </a>
        </div>
    </div>
<?php get_footer('404'); ?>