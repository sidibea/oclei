<?php
$post_meta = get_post_meta(get_the_ID());


?>

<div class="media_event__links">

	<?php if (!empty($video_link = $post_meta['video_url'][0])) : ?>
        <a href="<?php echo esc_url($video_link); ?>"
           class="no_deco media_event__link media_event__link_video mtc ttc_h stm_lightgallery__iframe">
            <i class="stmicon-church-video"></i>
        </a>
	<?php endif; ?>

	<?php if (!empty($music_link = $post_meta['music_url'][0])) : ?>
        <a href="#media_event__audio_modal_<?php echo get_the_ID(); ?>"
           class="no_deco media_event__link media_event__link_audio mtc ttc_h" data-toggle="modal">
            <i class="stmicon-church-audio"></i>
        </a>

        <div class="media_event__audio_modal stm_audio_modal modal fade" id="media_event__audio_modal_<?php echo get_the_ID(); ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-body">
                        <audio controls preload="none">
                            <source src="<?php echo esc_url($music_link); ?>">
                        </audio>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

	<?php endif; ?>

	<?php if (!empty($download_link = $post_meta['download_url'][0])) : ?>
        <a target="_self" href="<?php echo esc_url($download_link) ?>" download="true" class="no_deco media_event__link media_event__link_download mtc ttc_h">
            <i class="stmicon-church-download"></i>
        </a>
	<?php endif; ?>

    <a href="<?php the_permalink(); ?>" class="no_deco media_event__link media_event__link_document mtc ttc_h">
        <i class="stmicon-church-document"></i>
    </a>

</div>