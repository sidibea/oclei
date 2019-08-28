<?php $classes = 'stm_loop__single stm_loop__list stm_loop__single_style8 no_deco'; ?>
<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>"
       class="inner no_deco tbc"
       title="<?php the_title(); ?>">

        <?php if (has_post_thumbnail()) { ?>
            <div class="post_thumbnail">
				<?php if(wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ): ?>
					<span class="wtc mbc"><?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ); ?></span>
				<?php endif; ?>
                <?php the_post_thumbnail('pearl-img-1110-630', array('class' => 'img-responsive fullimage')); ?>
            </div>
        <?php } ?>

		<div class="post-infometa">
			<h3 class="mtc_h stm_animated"><span><?php the_title(); ?></span></h3>
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
			<?php get_template_part('partials/content/post/parts/postinfo', 8); ?>
		</div>

    </a>
</div>
