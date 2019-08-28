<!--Rental-->
<div <?php post_class('stm_loop__single stm_loop__single_style1 no_deco'); ?>>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php if(is_sticky()): ?>
            <span class="stm_sticky_post wtc no_deco mbc"><?php esc_html_e('Sticky', 'pearl'); ?></span>
        <?php endif; ?>
        <span class="stm_loop__thumbnail">
            <?php the_post_thumbnail('stm-img-270-160', array('class' => 'stm_mgb_23 img-responsive')); ?>
        </span>
        <h6 class="no_line ttc mtc_h stm_animated text-transform">
            <?php echo pearl_minimize_word(get_the_title(), 70); ?>
        </h6>
    </a>
    <p class="stm_loop_excerpt ttc">
        <?php echo get_the_excerpt() ?>
    </p>
    <div class="postinfo_grid ttc">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php esc_html_e('Learn more', 'pearl') ?>
        </a>
        <div class="post_comments">
            <span class="stmicon-quote4 post_comments_icon"></span>
            <span><?php comments_number('0', '1', '%'); ?></span>
        </div>
    </div>
</div>
