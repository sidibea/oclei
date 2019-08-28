<div <?php post_class('stm_loop__single stm_loop__single_grid_style_13 no_deco'); ?>>

    <div class="stm_loop__container">
        <a href="<?php the_permalink(); ?>" class="stm_single__image" title="<?php the_title(); ?>">
            <?php
            if (function_exists('pearl_get_VC_img')) {
                echo pearl_get_VC_img(get_post_thumbnail_id(), '398x249');
            } else {
                the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_28 img-responsive'));
            };

            ?>
        </a>

        <div class="stm_loop__meta">
            <div class="stm_single-date stm_loop__date mbdc">
                <span class="day mtc stm_mf"><?php echo get_the_date('j'); ?></span>
                <span class="month mtc"><?php echo get_the_date('M'); ?></span>
            </div>
            <h5 class="no_line mtc_h fwn stm_animated">
                <a href="<?php the_permalink(); ?>" class="stm_single__image" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>
            <p class="stm_loop_excerpt mtc"><?php echo get_the_excerpt() ?></p>
        </div>
    </div>


</div>