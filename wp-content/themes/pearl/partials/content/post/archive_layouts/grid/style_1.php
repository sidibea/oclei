<div href="<?php the_permalink(); ?>"
   <?php post_class('stm_loop__single stm_loop__single_style1 no_deco'); ?>
   title="<?php the_title(); ?>">
	<?php if(is_sticky()): ?>
		<span class="stm_sticky_post wtc no_deco mbc"><?php esc_html_e('Sticky', 'pearl'); ?></span>
	<?php endif; ?>
    <a href="<?php the_permalink(); ?>"
         class="no_deco"
         title="<?php the_title(); ?>">
        <?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_28 img-responsive')); ?>
        <h5 class="no_line ttc mtc_h stm_animated text-transform">
            <?php echo pearl_minimize_word(get_the_title(), 70); ?>
        </h5>
    </a>
    <div class="postinfo_grid ttc">
        <div class="post_date">
            <i class="stmicon-calendar3 mtc"></i>
            <span><?php echo get_the_date(); ?></span>
        </div>
        <div>
            <i class="stmicon-tag2 mtc"></i>
            <span>
                <?php echo implode(', ', pearl_get_terms_array(
                    get_the_ID(),
                    'category',
                    '',
                    true,
                    array(
                        'class' => 'no_deco'
                    )
                )); ?>
            </span>
        </div>
    </div>
</div>