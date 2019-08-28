<?php
$details = pearl_check_string(pearl_get_option('stm_vacancies_details'));
$share = pearl_check_string(pearl_get_option('stm_vacancies_share'));
$button = pearl_check_string(pearl_get_option('stm_vacancies_button'));

$tpl = 'partials/content/stm_vacancies/single/'; ?>

<div class="stm_vacancies_style_3">
	<div class="stm_markup stm_markup_left stm_mgb_30">
		<div class="stm_markup__content">

            <h2 class="ttc"><?php the_title(); ?></h2>

            <?php if ($share) get_template_part("partials/content/post/single/_share"); ?>

            <?php if(get_the_excerpt()): ?>
                <div class="stm_mgb_40">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <?php if ($details) get_template_part("{$tpl}_details"); ?>

            <div class="stm_mgb_40">
                <?php the_content(); ?>
            </div>

            <?php if ($button) get_template_part("{$tpl}_button"); ?>

		</div>
		<div class="stm_markup__sidebar stm_markup__sm-top">
            <div class="sidebar_inner">
                <?php get_template_part("{$tpl}parts/_vacancies"); ?>
            </div>
		</div>
	</div>
</div>