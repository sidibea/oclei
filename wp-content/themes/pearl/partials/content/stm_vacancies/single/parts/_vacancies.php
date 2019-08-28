<?php
$current_id = get_the_ID();
$args = array(
    'post_type' => 'stm_vacancies',
    'posts_per_page' => '-1',
    'post_status' => 'publish'
);

$q = new WP_Query($args);

if($q->have_posts()): ?>
    <div class="stm_vacancies_single_list">
        <?php while($q->have_posts()): $q->the_post();
            $id = get_the_ID();
            $active = ($id == $current_id) ? 'active' : '';
            ?>
            <a href="<?php the_permalink(); ?>"
               title="<?php the_title(); ?>"
               class="ttc no_deco stm_animated mbc_h <?php echo esc_attr($active); ?>">
                <div class="stm_mf text-transform"><?php the_title(); ?></div>
            </a>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_query(); ?>
<?php endif; ?>