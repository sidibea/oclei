<?php
pearl_add_element_style('posts_list', $style);
?>

<div class="stm_posts_list_single">
    <div class="stm_posts_list_single__container">
        <?php if (!empty($show_image) and has_post_thumbnail() ): ?>
            <div class="stm_posts_list_single__image">
                <a href="<?php the_permalink(); ?>"
                   title="<?php the_title() ?>" class="no_deco">
                    <?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="stm_posts_list_single__body <?php if ( has_post_thumbnail() ): ?>has_single__image<?php endif; ?>">

            <?php if (!empty($show_title)): ?>
                <h5>
                    <a href="<?php the_permalink(); ?>"
                       title="<?php the_title() ?>" class="no_deco stc mtc_h">
                        <?php the_title() ?>
                    </a>
                </h5>
            <?php endif; ?>

            <div class="stm_posts_list_single__info">
                <?php if (!empty($show_date)): ?>
                    <div class="date">
                        <i class="fa fa-clock-o mtc" aria-hidden="true"></i>
                        <?php echo get_the_date('M j, Y') ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>