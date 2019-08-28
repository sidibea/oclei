<?php $img_size = '350x185'; ?>

<div class="stm_posts_list_single animated fadeIn">
    <div class="stm_posts_list_single__container">

        <div class="stm_posts_list_single__image">
            <?php if (!empty($category = get_the_category())): ?>
                <div class="stm_posts_list_single__category text-transform">
                    <?php foreach($category as $single_category): ?>
                        <a class="no_deco sbc" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                            <?php echo esc_attr($single_category->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($badge)):
                $badge_class = array(
                    $badge['class'],
                    'no_deco stm_posts_list_single__icon_box'
                );

                ?>
                <a href="<?php echo esc_attr($badge['url']); ?>" class="<?php echo esc_attr(implode(' ', $badge_class)); ?>">
                    <span class="stmicon-viral_<?php echo esc_attr($badge['class']); ?>"></span>
                </a>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>"
               title="<?php the_title() ?>" class="no_deco">
				<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
            </a>
        </div>

        <div class="stm_posts_list_single__body">
            <h4>
                <a href="<?php the_permalink(); ?>"
                   title="<?php the_title() ?>" class="no_deco mtc stc_h">
					<?php the_title() ?>
                </a>
            </h4>

            <div class="stm_posts_list_single__info">

                <div class="date">
                    <?php
                        $posted = get_the_time('U');
                        echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                    ?>
                </div>

                <div class="views">
                    <?php
                        $post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
                        if(empty($post_views)) {
                            $post_views = 0;
                        }

                        echo esc_attr($post_views);
                    ?>
                    <?php if($post_views == 1) : ?>
                        <?php esc_html_e('view', 'pearl'); ?>
                    <?php else: ?>
                        <?php esc_html_e('views', 'pearl'); ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
</div>