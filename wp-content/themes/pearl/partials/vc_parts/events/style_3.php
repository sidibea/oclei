<?php
$id = get_the_ID();
$date_start = get_post_meta($id, 'date_start', true);
$date_start_time = get_post_meta($id, 'date_start_time', true);
$date_end_time = get_post_meta($id, 'date_end_time', true);
$address = get_post_meta($id, 'address', true);

$day = $month = '';

if (!empty($date_start)) {
	$day = pearl_get_formatted_date($date_start, 'j');
	$month = pearl_get_formatted_date($date_start, 'F');
} else {
	$day = '';
	$month = '';
}


?>
<div <?php echo esc_attr(post_class('stm_event_single_list no_deco')); ?>>
	<div class="inner">
		<?php if (!empty($day) and $month): ?>
			<div class="stm_event_single_list__alone stm_event_single_list__calendar  hasDate ttc">
				<div class="stm_event_single_list__calendar_main-page">
					<span class="puncher-holes"></span>
					<div class="day h2 stc"><?php echo esc_attr($day); ?></div>
					<div class="month"><?php echo esc_attr($month); ?></div>
				</div>
				<div class="stm_event_single_list__calendar_second-page">

				</div>
				<div class="stm_event_single_list__calendar_third-page">

				</div>

			</div>
		<?php endif; ?>

		<div class="stm_event_single_list__alone hasTitle">
			<h6 class="ttc stc_H">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h6>
		</div>

		<div class="stm_event_single_list__sep">
			<div class="sep__circles">
				<span class="sep__circle sep__circle-1"></span>
				<span class="sep__circle sep__circle-2"></span>
				<span class="sep__circle sep__circle-3"></span>
			</div>
		</div>

		<div class="stm_event_single_list__alone hasAddress ttc">
			<?php echo sanitize_text_field($address); ?>
		</div>
		<div class="stm_event_single_list__alone hasButton">
        <a class="btn btn_outline btn_primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php esc_html_e('More details', 'pearl') ?>
        </a>
		</div>
	</div>
</div>
