<?php
$id = get_the_ID();
$sidebar = get_post_meta($id, 'stm_sidebar', true);

$sidebar_position = get_post_meta($id, 'stm_sidebar_position', true);
$sidebar_position = (!empty($sidebar_position)) ? $sidebar_position : 'full';

$container = '';

if(empty($sidebar)) $sidebar_position = 'full';

if($sidebar_position != 'full') $container = 'container'; ?>

<div class="<?php echo esc_attr($container); ?>">
	<div class="stm_markup stm_markup_<?php echo esc_attr($sidebar_position); ?>">

		<div class="stm_markup__content">

			<?php if(pearl_check_string(pearl_get_option('show_page_title', 'true'))): ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php get_template_part("partials/content/post/parts/comments"); ?>
		</div>

		<?php if($sidebar_position !== 'full'): ?>
			<div class="stm_markup__sidebar stm_markup__sidebar_divider hidden-sm hidden-xs">
				<div class="sidebar_inner">
					<?php pearl_sidebar(false, $sidebar) ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>