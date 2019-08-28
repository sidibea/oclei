<?php
$id = get_the_ID();
$style = '';
if (has_post_thumbnail()) {
	$image = pearl_get_image_url(get_post_thumbnail_id($id));
	if (!empty($image)) {
		$style = "style=\"background-image:url('{$image}')\"";
	}
}

$date_start = get_post_meta($id, 'date_start', true);

if (!empty($date_start)) {
	$day = pearl_get_formatted_date($date_start, 'j');
	$month = pearl_get_formatted_date($date_start, 'F');
} else {
	$day = '';
	$month = '';
}
?>

<div class="vc_container-fluid-force tbc_a" <?php echo sanitize_text_field($style); ?>>
	<div class="container">
		<div class="inner">
			<?php if (!empty($date_start)): ?>
				<div class="stm_event_single__calendar">
					<div class="stm_event_single__calendar_main-page">
						<svg version="1.1" class="calendar" xmlns="http://www.w3.org/2000/svg"
							 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width="100px" height="90px" viewBox="2.5 2.5 100 90" enable-background="new 2.5 2.5 100 90"
							 xml:space="preserve">
<path d="M97.5,2.5h-90c-2.761,0-5,2.239-5,5v80c0,2.762,2.239,5,5,5h90c2.762,0,5-2.238,5-5v-80C102.5,4.739,100.262,2.5,97.5,2.5z
	 M20,23.5c-3.038,0-5.5-2.462-5.5-5.5s2.462-5.5,5.5-5.5s5.5,2.462,5.5,5.5S23.038,23.5,20,23.5z M85,23.5
	c-3.037,0-5.5-2.462-5.5-5.5s2.463-5.5,5.5-5.5s5.5,2.462,5.5,5.5S88.037,23.5,85,23.5z"/>
</svg>

						<div class="day h2 stc"><?php echo wp_kses_post($day); ?></div>
						<div class="month"><?php echo wp_kses_post($month); ?></div>
					</div>
					<div class="stm_event_single__calendar_second-page">

					</div>
					<div class="stm_event_single__calendar_third-page">

					</div>

				</div>
			<?php endif; ?>


			<div class="stm_event_single__title">
				<?php
				if (function_exists('bcn_display')) {
				?>
				<div class="stm_event_single__breadcrumbs">

					<?php
					bcn_display();
					}
					?>
				</div>

				<h2 class="wtc"><?php the_title(); ?></h2>
			</div>

		</div>
	</div>
</div>