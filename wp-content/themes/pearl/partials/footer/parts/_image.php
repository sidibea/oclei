<?php
$copyright_image = pearl_get_option('copyright_image', '');
if(!empty($copyright_image)):
	$copyright_image_width = pearl_get_option('copyright_image_width', 250);
	?>
	<div class="footer_copyright__image">
		<img width="<?php echo intval($copyright_image_width); ?>"
			 src="<?php echo pearl_get_image_url($copyright_image); ?>" />
	</div>
<?php endif;