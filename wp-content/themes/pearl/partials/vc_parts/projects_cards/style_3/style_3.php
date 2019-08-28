<?php
wp_enqueue_script('isotope.js');
wp_enqueue_script('lazysizes');
wp_enqueue_script('packery');

$vars['number'] = 6;
?>

<div class="inner">
	<?php pearl_load_vc_element('projects_cards', $vars, $vars['style'] . '/cards'); ?>
</div>

<?php get_template_part('partials/vc_parts/projects_cards/'.$vars['style'].'/js'); ?>