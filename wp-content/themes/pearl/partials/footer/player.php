<?php if (pearl_check_music_enabled()):
	$args = array(
		'post_type'      => 'stm_albums',
		'posts_per_page' => '1',
	);

	$songs = array(
		'label' => '',
		'name'  => '',
	);

	$album_name = $id = '';

	$q = new WP_Query($args);
	if ($q->have_posts()) {
		pearl_add_element_style('album_info');
        $q->the_post();
        $id = get_the_ID();
        $songs = pearl_get_cached('pearl_album_' . $id, 'pearl_create_playlist', array('id' => $id));
        if (!empty($songs)) pearl_create_album_playlist($songs);
        $album_name = get_the_title();
	}
	$songs = array_filter($songs);

	if (!empty($songs)): ?>

		<div class="stm-audio-player" data-id="<?php echo intval($id); ?>">
			<div class="container">
				<div class="audio-toggle tbc"></div>
			</div>
			<?php get_template_part('partials/footer/player-list'); ?>
			<div id="audio-player-holder"></div>
			<div id="audio-player">
				<div class="container">
					<div class="row stm_audio__info">
						<div class="col-md-6 col-sm-6">
							<div class='audio-bodong'>
								<span></span>
								<span></span>
								<span></span>
							</div>
							<span class="audio-title"><?php echo sanitize_text_field($songs[0]['title']); ?></span>
						</div>
						<div class="col-md-6 col-sm-6 text-right"><span
								class="audio-album"><?php echo wp_kses_post(sprintf(__('Album - <label>%s</label>', 'pearl'), $album_name)); ?></span>
						</div>
					</div>
					<audio src="<?php echo sanitize_text_field($songs[0]['url']); ?>" type="audio/mp3"
						   controls="controls"></audio>
				</div>
			</div>
		</div>

	<?php endif; ?>
<?php endif; ?>