<?php

$image = (!empty($image)) ? pearl_get_image_url($image) : '';
if (!empty($image)) {
	$height = (!empty(intval($height))) ? intval($height) : '320';
}

$styles = array();


if (!empty($image)) {
	$styles[] = "height: {$height}px;";
	$classes[] = 'tbc has_poster';
}

$video_label = false;
//Check if url is youtube url
$url = pearl_generate_youtube($url);


if (!empty($url)): ?>

	<a href="<?php echo esc_url($url); ?>"
	   class="<?php echo esc_attr(implode(' ', $classes)); ?>"
	   style="<?php echo esc_attr(implode(';', $styles)); ?>"
	   data-iframe="true">
        <?php if (!empty($image)) : ?>
            <span class="stm_video__cover" style="background-image: url(<?php echo esc_url($image); ?>);"></span>
        <?php endif; ?>
		<div class="stm_playb"></div>
		<?php if (!empty($video_label)) : ?>
			<div class="video__label">
				<?php echo wp_kses_post($video_label); ?>
			</div>
		<?php endif; ?>
	</a>

<?php endif; ?>