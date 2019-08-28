<?php get_header();

if (have_posts()): ?>

	<!--Title box-->
	<?php pearl_get_titlebox(); ?>

	<!--Breadcrumbs-->
	<?php if (pearl_check_string(get_post_meta(get_the_ID(), 'page_bc', true))):
		$fullwidth = (pearl_check_string(pearl_get_option('page_bc_fullwidth', false))) ? 'vc_container-fluid-force' : 'container'; ?>
		<div class="stm_page_bc <?php echo esc_attr($fullwidth); ?>">
			<?php get_template_part('partials/global/breadcrumbs'); ?>
		</div>
	<?php endif; ?>

	<?php while (have_posts()): the_post(); ?>
		<?php get_template_part('partials/content/page/main'); ?>
	<?php endwhile; ?>

	<?php pearl_wp_link_pages(); ?>

<?php endif; ?>

<?php get_footer(); ?>