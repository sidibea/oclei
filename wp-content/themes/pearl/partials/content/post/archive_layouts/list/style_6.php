<?php $classes = 'stm_loop__single stm_loop__list stm_loop__single_style6 no_deco'; ?>
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

    </a>

    <div class="post-infometa">
        <?php get_template_part('partials/content/post/parts/postinfo', 6); ?>

        <a href="<?php the_permalink() ?>"
           class="inner no_deco"
           title="<?php the_title(); ?>">
            <h3 class="mtc_h stm_animated"><span><?php the_title(); ?></span></h3>
        </a>

        <?php the_excerpt(); ?>
    </div>
</div>
