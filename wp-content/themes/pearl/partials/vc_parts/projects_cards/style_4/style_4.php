<?php
wp_enqueue_script('isotope.js');
wp_enqueue_script('lazysizes');
wp_enqueue_script('packery');

$vars['number'] = 6;

$terms = get_terms(array(
	'taxonomy'   => 'project_category',
	'hide_empty' => false,
));
?>

<?php if(!empty($terms)): ?>
	<ul class="stm_projects_cards__filter js_active_switcher">
		<li class="active js_active_switcher__a">
			<a href="#" data-category="*"><?php esc_html_e('All', 'pearl'); ?></a>
		</li>
		<?php foreach($terms as $term): ?>
			<li class="js_active_switcher__a">
				<a href="#" data-category=".<?php echo esc_attr($term->slug) ?>">
					<?php echo esc_attr($term->name); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
<div class="inner">
	<?php pearl_load_vc_element('projects_cards', $vars, $vars['style'] . '/cards'); ?>
</div>

<?php get_template_part('partials/vc_parts/projects_cards/'.$vars['style'].'/js'); ?>