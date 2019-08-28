<?php
$post_id = get_the_ID();

$classes = array(
    'stm_loop__single stm_loop__story_1 no_deco no_deco',
);

$intro = get_post_meta($post_id, 'stm_intro', true);

?>


<a href="<?php the_permalink(); ?>"
    <?php post_class(implode(' ', $classes)); ?>
   title="<?php the_title(); ?>">
    <div class="inner stm_animated">
        <div class="stm_story_image">
            <?php if (!empty($img_size)): ?>
                <?php echo wp_kses_post(pearl_get_VC_img(get_post_thumbnail_id(), $img_size)); ?>
            <?php else: ?>
                <?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_15 img-responsive')); ?>
            <?php endif; ?>
        </div>
        <h4 class="mtc stm_animated"><?php the_title(); ?></h4>
        <?php if(!empty($intro)): ?>
            <span class="stm_story_intro ttc"><?php echo esc_attr($intro); ?></span>
        <?php endif; ?>
    </div>
</a>