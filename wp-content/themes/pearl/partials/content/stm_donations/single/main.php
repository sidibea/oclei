<?php



$layout = pearl_get_option('stm_donations_layout', 1);
$style = 'partials/content/stm_donations/layouts/layout_' . $layout;

$classes = array(
	'stm_single_donation',
	'stm_single_donation_style_' . $layout,
);

pearl_load_element_style(
	'post_types',
	'donations',
	'style_' . $layout
);
?>
<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
	<?php get_template_part($style); ?>
</div>
