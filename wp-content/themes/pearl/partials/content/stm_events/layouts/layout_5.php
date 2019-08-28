<?php $tpl = 'partials/content/stm_events/single/'; ?>

<?php get_template_part($tpl . '_title_box_3'); ?>

<?php get_template_part($tpl . '_address'); ?>

<?php get_template_part($tpl . '_thumbnail'); ?>

<?php get_template_part($tpl . '_actions_2'); ?>

<div class="stm_single_event__content"><?php the_content(); ?></div>

<?php get_template_part($tpl . '_panel_2'); ?>

<div class="stm_single_event__excerpt stm_mgb_30"><?php the_excerpt(); ?></div>

<?php get_template_part($tpl . '_join_form_2'); ?>