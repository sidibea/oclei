<?php
$classes = 'stm_loop__single stm_loop__list stm_loop__single_style3 no_deco';
$classes .= (has_post_thumbnail()) ? ' stm_has_thumbnail' : ' stm_no_thumbnail';
?>
<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>"
       class="inner"
       title="<?php the_title(); ?>">

		<?php if(is_sticky()): ?>
			<span class="stm_sticky_post wtc no_deco mbc"><?php esc_html_e('Sticky', 'pearl'); ?></span>
		<?php endif; ?>

        <h3 class="wtc"><span><?php the_title(); ?></span></h3>

        <?php if (has_post_thumbnail()) { ?>
            <div class="post_thumbnail">
                <?php the_post_thumbnail('pearl-img-1110-630', array('class' => 'img-responsive fullimage')); ?>
            </div>
        <?php } ?>

    </a>

    <?php get_template_part('partials/content/post/parts/postinfo'); ?>
</div>
