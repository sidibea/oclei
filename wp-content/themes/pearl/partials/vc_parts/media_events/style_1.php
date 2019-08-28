<?php $post_meta = get_post_meta(get_the_ID()); ?>

<div class="stm_media_event__single">
    <div class="stm_media_event__image">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'medium', false, false); ?>
        </a>
    </div>
    <div class="stm_media_event__meta stc">
		<?php echo sprintf(__('%s<span> by </span>%s', 'pearl'), get_the_date('M j, Y'), get_the_author()); ?>
    </div>
    <div class="stm_media_event__title">
        <h6>
            <a class="ttc mtc_h no_deco" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
            </a>
        </h6>
    </div>
    <div class="stm_media_event__excerpt">
		<?php echo get_the_excerpt(); ?>
    </div>
    <div class="stm_media_event__links">
		<?php get_template_part('partials/content/stm_media_events/parts/_media_links'); ?>
    </div>
</div>