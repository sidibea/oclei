<div id="post-<?php the_ID(); ?>"
    <?php post_class( 'stm_loop__single stm_loop__list stm_repeating_line stm_loop__single_style3 no_deco' ); ?>>
    <a href="<?php the_permalink() ?>"
       class="h3 no_deco mtc_h stm_mgb_31 stm_dpb"
       title="<?php the_title(); ?>">
        <span class="text-transform"><?php the_title(); ?></span>
    </a>

    <?php get_template_part('partials/content/post/parts/postinfo', 3); ?>

    <?php get_template_part('partials/content/post/parts/image'); ?>

    <div class="post_excerpt stm_mgb_34">
        <?php the_excerpt(); ?>
    </div>
    <div class="post_read_more">
        <a class="btn btn_primary btn_solid"
           href="<?php the_permalink(); ?>"
           title="<?php the_title(); ?>">
            <?php esc_html_e( 'Read more', 'pearl' ); ?>
            <i class="fa fa-angle-right __icon icon_18px stm_mgl_5"></i>
        </a>
    </div>
</div>