<?php
$q = new WP_Query($args);
if($q->have_posts()): ?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="stm_vacancies_row_3 clearfix">
        <?php while($q->have_posts()):
            $q->the_post();
            $id = get_the_ID();
            $department = get_post_meta($id, 'department', true);
            $location = get_post_meta($id, 'location', true);
            $icon = get_post_meta($id, 'vacancy_icon', true);
            $date = get_the_date();
            ?>

            <a href="<?php the_permalink(); ?>"
               title="<?php the_title(); ?>"
               class="stm_vacancies__single no_deco wtc">
                <div class="inner mbc_b tbc_b_h">

                    <?php if(!empty($icon)): ?>
                        <div class="<?php echo esc_attr($icon) ?> __icon icon_55px stm_mgb_25"></div>
                    <?php endif; ?>

                    <div class="stm_vacancies__title stm_mf"><?php the_title(); ?></div>

                    <?php if(!empty($department) and empty($show_department)): ?>
                        <div class="stm_vacancies__department">
                            <?php echo sanitize_text_field($department); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($location) and empty($show_location)): ?>
                        <div class="stm_vacancies__location">
                            <?php echo sanitize_text_field($location); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(empty($show_date)): ?>
                        <div class="stm_vacancies__date">
                            <?php echo sanitize_text_field($date); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</div>

<?php wp_reset_postdata(); ?>
<?php endif; ?>