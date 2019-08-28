<?php $tpl = 'partials/content/stm_events/single/'; ?>

<h2 class="stm_single_event__title text-transform"><?php the_title(); ?></h2>

<?php get_template_part($tpl . '_address'); ?>

<?php get_template_part($tpl . '_actions'); ?>

<div class="stm_single_event__content"><?php the_content(); ?></div>

<?php get_template_part($tpl . '_panel'); ?>

<div class="stm_single_event__excerpt stm_mgb_30"><?php the_excerpt(); ?></div>

<?php get_template_part($tpl . '_join_form'); ?>