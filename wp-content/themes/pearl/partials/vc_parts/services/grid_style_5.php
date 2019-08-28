<?php
$per_row = (empty($per_row)) ? 3 : $per_row;

$classes = array(
    'stm_loop__single stm_loop__grid stm_loop__single_style5 no_deco stm_loop__grid_' . $per_row
);

$icon = get_post_meta(get_the_ID(), 'service_icon', true);
$icon = (empty($icon)) ? 'stmicon-text-align-left' : $icon;

?>


<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <a href="<?php the_permalink(); ?>"
       title="<?php the_title(); ?>"
       class="no_deco">
        <?php if (has_post_thumbnail()): ?>
			<div class="stm_service__image">
				<?php if (!empty($img_size)): ?>
					<?php echo wp_kses_post(pearl_get_VC_img(get_post_thumbnail_id(), $img_size)); ?>
				<?php else: ?>
					<?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_15 img-responsive')); ?>
				<?php endif; ?>
			</div>
        <?php endif; ?>
        <div class="stm_post_type_list__content stc_b no_deco">
            <i class="stm_service_icon_single <?php echo esc_attr($icon); ?> stc"></i>
            <h4 class="ttc text-uppercase stm_animated">
                <?php echo pearl_minimize_word(get_the_title()); ?>
            </h4>
        </div>
    </a>

    <?php the_excerpt(); ?>
</div>
