<?php
$details = pearl_check_string(pearl_get_option('stm_vacancies_details'));
$share = pearl_check_string(pearl_get_option('stm_vacancies_share'));
$button = pearl_check_string(pearl_get_option('stm_vacancies_button'));

$markup_position = ($details) ? 'right' : 'full';

$tpl = 'partials/content/stm_vacancies/single/'; ?>

<div class="stm_vacancies_style_2">

	<div class="mbc">
		<?php if ($details) get_template_part("{$tpl}_details"); ?>
	</div>

	<?php the_content(); ?>

	<div class="stm_separator-line stm_separator-line_grey"></div>

	<div class="stm_flex stm_flex_center stm_mgb_40 stm_flex_last">
		<?php
		if ($button) get_template_part("{$tpl}_button");

		if ($share) get_template_part("partials/content/post/single/_share");
		?>
	</div>
</div>

