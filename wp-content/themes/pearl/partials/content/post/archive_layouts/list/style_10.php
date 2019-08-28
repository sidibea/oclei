<!--Rental-->
<?php
$classes = 'stm_loop__single stm_loop__list stm_loop__single_style3 no_deco';
$classes .= (has_post_thumbnail()) ? ' stm_has_thumbnail' : ' stm_no_thumbnail';
?>
<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>" class="inner" title="<?php the_title(); ?>">
        <?php if (has_post_thumbnail()) { ?>
            <div class="post_thumbnail">
                <?php the_post_thumbnail('stm-img-850-500', array('class' => 'img-responsive fullimage')); ?>
            </div>
        <?php } ?>

        <h6><span><?php the_title(); ?></span></h6>
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