<?php
$speaker_id = get_post_meta(get_the_ID(), 'speaker', true);

if (!empty($speaker_id)) {
	$classes = array(
		'stm_speaker'
	);
	$speaker_meta = (get_post_meta($speaker_id));
	$speaker_photo_id = !empty($speaker_meta['staff_photo']) ? $speaker_meta['staff_photo'][0] : '';
	$speaker_photo = '';
	if ($speaker_photo_id) {
		$speaker_photo = pearl_get_VC_attachment_img_safe($speaker_photo_id, '100x100', 'thumbnail', true, true);
		$classes[] = 'has_photo';
	}

	$speaker_name = !empty($speaker_meta['staff_name']) ? $speaker_meta['staff_name'][0] : '';
	$speaker_description = !empty($speaker_meta['staff_description']) ? $speaker_meta['staff_description'][0] : '';
	?>

    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <div class="stm_speaker__container">

			<?php if (!empty($speaker_photo)) : ?>
                <div class="stm_speaker__photo">
                    <img src="<?php echo sanitize_text_field($speaker_photo); ?>"
                         alt="<?php echo sanitize_text_field($speaker_name); ?>">
                </div>
			<?php endif; ?>

            <div class="stm_speaker__content">
			<span class="stm_speaker__label">
				<?php echo esc_html__('Speaker', 'pearl'); ?>
			</span>


				<?php if (!empty($speaker_name)) : ?>
                    <div class="stm_speaker__name">
                        <h6>
							<?php echo wp_kses($speaker_name); ?>
                        </h6>
                    </div>
				<?php endif; ?>


				<?php if (!empty($speaker_description)) : ?>
                    <div class="stm_speaker__info">
						<?php echo wp_kses($speaker_description); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>


	<?php
}
