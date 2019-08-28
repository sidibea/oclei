<?php
$classes = 'stm_loop__single stm_loop__grid_11 stm_loop__single_style3 no_deco';
$classes .= (has_post_thumbnail()) ? ' stm_has_thumbnail' : ' stm_no_thumbnail';
?>
<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink() ?>"
	   class="inner text-center no_deco"
	   title="<?php the_title(); ?>">

		<?php if (has_post_thumbnail()) { ?>
			<div class="post_thumbnail">
				<?php the_post_thumbnail('pearl-img-1110-630', array('class' => 'img-responsive fullimage')); ?>
			</div>
		<?php } ?>

		<?php get_template_part('partials/content/post/parts/postinfo', 11); ?>
	</a>
</div>