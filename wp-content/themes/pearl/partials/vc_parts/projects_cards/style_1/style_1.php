<?php
wp_enqueue_style('owl-carousel2');
wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_script('imagesloaded');

$vars['number'] = pearl_posts_per_page();

?>

<div class="stm_projects_cards__preloader"></div>
<div class="inner clearfix">
	<?php pearl_load_vc_element('projects_cards', $vars, $vars['style'] . '/cards'); ?>
</div>

<?php if(!empty($vars['hint'])): ?>
    <div class="stm_projects_cards__hint">
		<span><?php echo sanitize_text_field($vars['hint']); ?></span>
    </div>
<?php endif; ?>

<?php
ob_start();
get_template_part('partials/vc_parts/projects_cards/'.$vars['style'].'/js');
$script = str_replace(array('<script type="text/javascript">', '</script>'), array('', ''), ob_get_clean());

wp_add_inline_script( 'imagesloaded', $script);
?>