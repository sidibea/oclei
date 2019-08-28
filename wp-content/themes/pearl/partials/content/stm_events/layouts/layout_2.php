<?php $tpl = 'partials/content/stm_events/single/'; ?>


<?php get_template_part($tpl . '_title_box'); ?>

<div class="stm_markup stm_markup_right">

    <div class="stm_markup__content">

        <div class="stm_single_event__content"><?php the_content(); ?></div>

        <?php get_template_part($tpl . '_join_form'); ?>

    </div>

    <div class="stm_markup__sidebar">
        <?php get_template_part($tpl . '_details'); ?>
    </div>
</div>