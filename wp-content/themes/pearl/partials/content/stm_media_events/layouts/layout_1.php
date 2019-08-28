<?php
$post_meta = get_post_meta(get_the_ID());

$image = get_the_post_thumbnail_url(get_the_ID(), 'full');

$links = array(
	'video_url',
	'music_url',
	'download_url'
);

foreach ($links as $link) {
	${$link} = !empty($post_meta[$link]) ? $post_meta[$link][0] : false;
}

$head_styles = array();

if (!empty($image)) {
	$head_styles['background-image'] = 'url(' . $image . ')';
}


if (!empty($head_styles)) {
	$head_styles = 'style="' . pearl_array_to_style_string($head_styles) . '"';
} else {
	$head_styles = '';
}
?>

<div class="stm_media_event__single_page">
    <div class="stm_media_event__single_head vc_container-fluid-force" <?php echo sanitize_text_field($head_styles); ?>>

        <div class="stm_media_event__single_head-container">

			<?php if (function_exists('bcn_display')) : ?>
                <div class="stm_media_event__single_breadcrumbs">
					<?php bcn_display(); ?>
                </div>
			<?php endif; ?>

            <div class="stm_media_event__single_title">
                <h2>
					<?php the_title(); ?>
                </h2>
            </div>

            <div class="stm_media_event__single_meta">
				<?php get_template_part('partials/content/stm_media_events/parts/_meta'); ?>
            </div>

        </div>
    </div>
    <div class="stm_media_event__single_links">
		<?php if (!empty($video_url)) : ?>
            <a class="video_link stm_lightgallery__iframe sbc mbc_h no_deco"
               href="<?php echo esc_url($video_url); ?>">
                <i class="stmicon-church-video"></i>
                <span><?php echo esc_html__('Watch', 'pearl') ?></span>
            </a>
		<?php endif; ?>

		<?php if (!empty($music_url)) : ?>
            <a class="music_link sbc mbc_h no_deco"
               href="#media_event__audio_modal_<?php echo get_the_ID(); ?>"  data-toggle="modal">
                <i class="stmicon-church-audio"></i>
                <span><?php echo esc_html__('Listen', 'pearl') ?></span>
            </a>

            <div class="media_event__audio_modal stm_audio_modal modal fade" id="media_event__audio_modal_<?php echo get_the_ID(); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div class="modal-body">
                            <audio controls preload="none">
                                <source src="<?php echo esc_url($music_url); ?>">
                            </audio>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
		<?php endif; ?>

		<?php if (!empty($download_url)) : ?>
            <a class="download_link sbc mbc_h no_deco"
               href="<?php echo esc_url($download_url); ?>" download>
                <i class="stmicon-church-download"></i>
                <span><?php echo esc_html__('Download', 'pearl') ?></span>
            </a>
		<?php endif; ?>

    </div>
    <div class="stm_media_event__single_content">
		<?php the_content(); ?>
    </div>
</div>

