<?php
$parts = 'partials/content/post/parts/';

$id = get_the_ID();
$stm_single_banner = get_post_meta($id, 'single_post_banner', true);

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'orderby'   => 'rand',
);

$loop = new WP_Query( $args );

?>
<div class="stm_markup__in_content">
    <?php if(!empty( $stm_single_banner )) : ?>
        <div class="post_single_banner">
            <?php echo do_shortcode( $stm_single_banner ); ?>
        </div>
    <?php endif; ?>
    <h2><?php esc_html_e('Recommended Articles', 'pearl'); ?></h2>
    <?php if ( $loop->have_posts() ) : ?>
        <ul class="stm_recommended_posts_list">
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <?php

            $img_size = !empty($img_size) ? $img_size : '350x185';
            $post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
            if(empty($post_views)) {
                $post_views = 0;
            }
            ?>

            <li class="stm_posts_list_single">
                <?php if ( has_post_thumbnail() ): ?>
                    <div class="stm_posts_list_single__image">

                        <?php if (!empty($category = get_the_category())): ?>
                            <div class="stm_posts_list_single__category">
                                <?php foreach($category as $single_category): ?>
                                    <a class="no_deco sbc" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                                        <?php echo esc_attr($single_category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>"
                           title="<?php the_title() ?>" class="no_deco">
                            <?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="stm_posts_list_single__body <?php if ( has_post_thumbnail() ): ?>has_single__image<?php endif; ?>">
                    <h5>
                        <a href="<?php the_permalink(); ?>"
                           title="<?php the_title() ?>" class="no_deco">
                            <?php the_title() ?>
                        </a>
                    </h5>
                    <div class="stm_posts_list_single__info">
                        <div class="date">
                            <?php
                            $posted = get_the_time('U');
                            echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                            ?>
                        </div>

                        <div class="views">
                            <?php echo esc_attr($post_views); ?>
                            <?php if($post_views == 1) : ?>
                                <?php esc_html_e('view', 'pearl'); ?>
                            <?php else: ?>
                                <?php esc_html_e('views', 'pearl'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php if (pearl_check_string(pearl_get_option('post_comments'))) {
        get_template_part("{$parts}/comments");
    } ?>
</div>
