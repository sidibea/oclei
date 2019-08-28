<?php get_header('404'); ?>

<?php
$bg = pearl_get_option('error_page_bg');
$bg_style = '';
if(!empty($bg)) {
    $bg = pearl_get_image_url($bg);
    $bg = (!empty($bg)) ? $bg : get_template_directory_uri() . '/assets/img/404.jpeg';
    $bg_style = 'style="background-image:url(\''.$bg.'\')"';
}
?>

    <div class="stm_errorpage tbc" <?php echo sanitize_text_field($bg_style); ?>>
        <div class="stm_errorpage__inner">
            <h1 class="no_line"><?php esc_html_e('404', 'pearl'); ?></h1>
            <h2 class="text-transform stm_mgb_43 wtc">
                <?php esc_html_e('The page you are looking for does not exist.', 'pearl'); ?>
            </h2>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn_primary btn_solid">
                <?php esc_html_e('Go back to homepage', 'pearl'); ?>
            </a>
        </div>
    </div>
<?php get_footer('404'); ?>