<?php
$q = new WP_Query($args);
if($q->have_posts()): ?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php while($q->have_posts()):
        $q->the_post();
        $id = get_the_ID();
        $department = get_post_meta($id, 'department', true);
        $location = get_post_meta($id, 'location', true);
        $date = get_the_date();
        ?>

        <a href="<?php the_permalink(); ?>"
           title="<?php the_title(); ?>"
           class="stm_vacancies__single no_deco mbc_b">

            <div class="stm_vacancies__title"><?php the_title(); ?></div>

            <?php if(!empty($department) and empty($show_department)): ?>
                <div class="stm_vacancies__department">
                    <?php echo sanitize_text_field($department); ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($location) and empty($show_location)): ?>
                <div class="stm_vacancies__location">
                    <i class="__icon fa fa-map-marker mtc stm_mgr_5"></i>
                    <?php echo sanitize_text_field($location); ?>
                </div>
            <?php endif; ?>

            <?php if(empty($show_date)): ?>
                <div class="stm_vacancies__date">
                    <i class="__icon fa fa-calendar mtc stm_mgr_5"></i>
                    <?php echo sanitize_text_field($date); ?>
                </div>
            <?php endif; ?>
        </a>
    <?php endwhile; ?>
</div>

<?php wp_reset_postdata(); ?>
<?php endif; ?>