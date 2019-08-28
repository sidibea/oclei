<?php
$args = array(
    'post_type' => 'stm_projects',
    'posts_per_page' => intval($number),
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id'
        )
    )
);

$q = new WP_Query($args);

$id = 'stm_projects__carousel_' . pearl_random();

wp_enqueue_script('pearl_projects/style_2_carousel');

if ($q->have_posts()): ?>
    <div id="<?php echo esc_attr($id) ?>"
         class="stm_projects_mini"
         data-carousel="style_2"
         data-autoplay="<?php echo esc_js($autoscroll); ?>">
        <div class="stm_projects_mini__carousel stm_owl_dots">
            <?php while ($q->have_posts()): $q->the_post(); ?>
                <div class="stm_projects_mini__single stm_owl__glitches stm_projects_carousel__item">
                    <a href="<?php the_permalink(); ?>"
                       class="no_deco"
                       title="<?php the_title(); ?>">
                        <?php
                        $post_id = get_the_ID();
                        $img_id = get_post_thumbnail_id($post_id);
                        $img = pearl_get_VC_img($img_id, $img_size);
                        echo html_entity_decode($img); ?>

                        <span class="stm_projects_carousel__overlay"></span>
                        <h4 class="stm_projects_carousel__name no_line">
                            <?php the_title(); ?>
                        </h4>
                        <span class="btn btn_primary btn_solid btn_xs stm_projects_carousel__btn">
                            <?php esc_html_e('View more', 'pearl'); ?>
                        </span>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>