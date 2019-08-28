<?php get_header();
$id = (pearl_is_shop() or pearl_is_shop_category()) ? pearl_shop_page_id() : get_the_ID();

$sidebar = get_post_meta($id, 'stm_sidebar', true);

$sidebar_position = get_post_meta($id, 'stm_sidebar_position', true);
$sidebar_position = (!empty($sidebar_position)) ? $sidebar_position : 'full';
if(empty($sidebar)) $sidebar_position = 'full';

if(is_product()) {
	$sidebar_position = pearl_get_sidebar_setting($post_type);
	$sidebar_mobile = pearl_get_sidebar_mobile($post_type, 'archive');
	$sidebar = pearl_get_option('product_sidebar');
}

if (have_posts()): ?>

	<!--Title box-->
	<?php pearl_get_titlebox(); ?>

	<!--Breadcrumbs-->
	<?php if (pearl_check_string(get_post_meta($id, 'page_bc', true))):
		$fullwidth = (pearl_check_string(pearl_get_option('page_bc_fullwidth', false))) ? 'vc_container-fluid-force' : 'container'; ?>
		<div class="stm_page_bc <?php echo esc_attr($fullwidth); ?>">
			<?php get_template_part('partials/global/breadcrumbs'); ?>
		</div>
	<?php endif; ?>

	<div class="stm_markup stm_markup_<?php echo esc_attr($sidebar_position); ?>">
		<div class="stm_markup__content">
			<?php woocommerce_content(); ?>
		</div>
		<?php if($sidebar_position !== 'full'): ?>
			<div class="stm_markup__sidebar stm_markup__sidebar_divider hidden-sm hidden-xs">
				<div class="sidebar_inner">
					<?php pearl_sidebar(false, $sidebar) ?>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php else: ?>
    <!--Title box-->
    <?php pearl_get_titlebox(); ?>

    <!--Breadcrumbs-->
    <?php if (pearl_check_string(get_post_meta($id, 'page_bc', true))):
        $fullwidth = (pearl_check_string(pearl_get_option('page_bc_fullwidth', false))) ? 'vc_container-fluid-force' : 'container'; ?>
        <div class="stm_page_bc <?php echo esc_attr($fullwidth); ?>">
            <?php get_template_part('partials/global/breadcrumbs'); ?>
        </div>
    <?php endif; ?>

    <div class="stm_markup stm_markup_<?php echo esc_attr($sidebar_position); ?>">
        <div class="stm_markup__content">
            <?php woocommerce_content(); ?>
        </div>
        <?php if($sidebar_position !== 'full'): ?>
            <div class="stm_markup__sidebar stm_markup__sidebar_divider hidden-sm hidden-xs">
                <div class="sidebar_inner">
                    <?php pearl_sidebar(false, $sidebar) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
