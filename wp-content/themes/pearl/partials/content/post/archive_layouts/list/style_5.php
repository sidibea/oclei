<?php $classes = 'stm_loop__single stm_loop__list stm_loop__single_style5 no_deco'; ?>
<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>"
       class="inner no_deco"
       title="<?php the_title(); ?>">

        <?php if (has_post_thumbnail()) { ?>
            <div class="post_thumbnail">
                <?php the_post_thumbnail('pearl-img-1110-630', array('class' => 'img-responsive fullimage')); ?>
                <div class="bump"></div>
            </div>
        <?php } ?>

        <h3><span><?php the_title(); ?></span></h3>

    </a>

    <?php get_template_part('partials/content/post/parts/postinfo', 5); ?>

    <?php the_excerpt(); ?>
</div>
