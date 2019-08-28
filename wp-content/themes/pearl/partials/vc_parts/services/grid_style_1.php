<?php
$per_row = (empty($per_row)) ? 3 : $per_row;

$classes = array(
    'stm_loop__single stm_loop__grid stm_loop__single_style1 no_deco stm_loop__grid_' . $per_row,
    'stm_repeating_line ttc_h ttc'
);

?>


<a href="<?php the_permalink(); ?>"
    <?php post_class(implode(' ', $classes)); ?>
   title="<?php the_title(); ?>">
    <div class="stm_separator tbc stm-effects_opacity stm_separator_doubled mbc_b"></div>
    <h4 class="no_line mtc_h stm_animated text-transform"><?php the_title(); ?></h4>
    <?php if (!empty($img_size)): ?>
        <?php echo wp_kses_post(pearl_get_VC_img(get_post_thumbnail_id(), $img_size)); ?>
    <?php else: ?>
        <?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_15 img-responsive')); ?>
    <?php endif; ?>
    <p><?php echo html_entity_decode(get_the_excerpt()); ?></p>
    <div class="stm_loop__meta">
        <span class="btn btn_primary btn_solid btn_xs">
            <i class=" btn__icon mtc icon_20px"></i>
            <?php esc_html_e('View more', 'pearl'); ?>
        </span>
    </div>
</a>