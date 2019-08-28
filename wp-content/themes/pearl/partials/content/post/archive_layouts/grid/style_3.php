<a href="<?php the_permalink(); ?>"
   <?php post_class('stm_loop__single stm_loop__single_style3 stm_repeating_line no_deco'); ?>
   title="<?php the_title(); ?>">
    <?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_28 img-responsive')); ?>
    <div class="stm_separator tbc stm-effects_opacity stm_separator_doubled mbc_b"></div>
    <h4 class="no_line mtc_h fwn stm_animated"><?php the_title(); ?></h4>
    <div class="stm_loop__meta">
        <span class="btn btn_primary btn_solid btn_xs">
            <i class=" btn__icon mtc icon_20px"></i>
            <?php esc_html_e('View more', 'pearl'); ?>
        </span>
        <span class="stm_single-date stm_loop__date mtc_b"><?php echo get_the_date(); ?></span>
    </div>
</a>