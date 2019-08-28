<?php

$image = (!empty($image)) ? "url('" . pearl_get_image_url($image) . "')" : '';
if (!empty($image)) {
	$height = (!empty(intval($height))) ? intval($height) : '320';
}

$styles = array();

//For style 2 make video play smaller
if ($style == 'style_2' and $height < 500) {
	$classes[] = 'stm_video_small';
}

if ($style == 'style_2' and $height < 300) {
	$classes[] = 'stm_video_xsmall';
}

if (!empty($image)) {
	$styles[] = "height: {$height}px;";
	$styles[] = "background-image: {$image}";
	$classes[] = 'tbc has_poster';
}

$video_label = false;

if ($style == 8) {
	$video_label = esc_html('Video', 'pearl');
	if ($video_duration = get_post_meta(get_the_ID(), 'single_post_video_duration', true)) {
		if ($video_duration && $video_duration !== 0) {
			$video_duration = new DateInterval($video_duration);
			if ($video_duration->format('%H') > 0) {
				$video_label = $video_duration->format('%H:%I:%S');
			} else {
				$video_label = $video_duration->format('%I:%S');
			}
		}
	}
}


//Check if url is youtube url
$url = pearl_generate_youtube($url);


if (!empty($url)): ?>

	<a href="<?php echo esc_url($url); ?>"
	   class="<?php echo esc_attr(implode(' ', $classes)); ?>"
	   style="<?php echo esc_attr(implode(';', $styles)); ?>"
	   data-iframe="true">
		<div class="stm_playb"></div>
		<?php if (!empty($video_label)) : ?>
			<div class="video__label">
				<?php echo wp_kses_post($video_label); ?>
			</div>
		<?php endif; ?>
	</a>

<?php endif; ?>