<?php get_header('404'); ?>

<?php
$bg = pearl_get_option('error_page_bg');
$bg_style = '';
if (!empty($bg)) {
	$bg = pearl_get_image_url($bg);
	$bg_style = 'style="background-image:url(\'' . $bg . '\')"';
}
?>

	<div class="stm_errorpage">
		<div class="stm_errorpage__bg" <?php echo sanitize_text_field($bg_style); ?>>
			<div class="stm_errorpage__inner">
				<h2 class="no_line"><?php esc_html_e('Oops!', 'pearl'); ?></h2>
				<h5 class="stm_errorpage__message">
					<?php esc_html_e('That page can`t be found.', 'pearl'); ?>
				</h5>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn_primary btn_solid">
					<?php esc_html_e('Home page', 'pearl'); ?>
				</a>
			</div>
		</div>
	</div>
<?php get_footer('404'); ?>