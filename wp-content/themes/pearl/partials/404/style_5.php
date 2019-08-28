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
		<div class="stm_errorpage__bg mbc" <?php echo sanitize_text_field($bg_style); ?>>
			<span class="stm_errorpage__404 heading_font wtc"><?php esc_html_e('404', 'pearl'); ?></span>
			<div class="container">
				<div class="stm_errorpage__inner">
					<h2 class="no_line wtc"><?php esc_html_e('Error 404', 'pearl'); ?></h2>
					<h5 class="stm_mgb_43 wtc">
						<?php esc_html_e('The page you are looking for does not exist.', 'pearl'); ?>
					</h5>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn_third btn_solid">
						<?php esc_html_e('Home page', 'pearl'); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
<?php get_footer('404'); ?>