<?php
$image_id = $image = '';
/*Get image id*/
if(!empty($element['data']['uselogo']) and pearl_check_string($element['data']['uselogo'])) {
	$image_id = pearl_get_option('logo');
} elseif(!empty($element['value'])) {
	$image_id = $element['value'];
}

/*Default width*/
$attrs = array();
$size = 'full';
if(!empty($element['data']['width'])) {
	$attrs['style'] = 'width:' . intval($element['data']['width']) . 'px';
}

/*Get image*/
$image = wp_get_attachment_image($image_id, 'full', false, $attrs);

/*Get url*/
$url = get_home_url();
if(!empty($element['data']['url'])) {
	$url = $element['data']['url'];
}



if(!empty($image)):
    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
    ?>

	<div class="stm-logo">
		<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($image_alt); ?>">
			<?php echo wp_kses_post($image); ?>
		</a>
	</div>

<?php elseif(!empty($image_id)):
	$logo = pearl_get_layout_config(pearl_get_option('stm_layout'));
	$logo = $logo['logo'];
	?>
	<a class="h3 stm_mgb_0 text-transform no_deco no_line" href="<?php echo esc_url($url); ?>">
		<img width="100" height="30" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/pearl_logo_' . $logo . '.svg') ?>" alt="<?php echo esc_html__('Pearl', 'pearl') ?>">
	</a>
<?php endif; ?>