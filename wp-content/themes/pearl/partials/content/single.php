<!--Breadcrumbs-->
<?php if(pearl_check_string(get_post_meta($id, 'page_bc', true))): ?>
    <div class="stm_page_bc container">
        <?php get_template_part('partials/global/breadcrumbs'); ?>
    </div>
<?php endif; ?>

<?php
$id = get_the_ID();
$post_type = get_post_type();
$sidebar_position = pearl_get_sidebar_setting($post_type, false);

$sidebar_mobile = pearl_get_sidebar_mobile($post_type);
$sidebar_mobile = "{$sidebar_mobile}-sm {$sidebar_mobile}-xs";

/*If attachment - like post*/
if($post_type == 'attachment') {
	$post_type = 'post';
	$sidebar_position = 'full';
}

$tpl = "partials/content/{$post_type}/single/main";

$row = ($sidebar_position !== 'full' || get_post_meta($id, '_wpb_vc_js_status', true) === 'true') ? '' : 'row';

$vc_status = get_post_meta($id, '_wpb_vc_js_status', true);

$container = (empty($vc_status) or !pearl_check_string($vc_status)) ? '' : 'container';

$single_post_layout = get_post_meta($id, 'single_post_layout', true);
$post_layout = pearl_get_option('post_layout', '1');

if(!empty($single_post_layout)) $post_layout = $single_post_layout;

$container .= ' stm_single_post_layout_' . $post_layout;

$disable_post_sidebar = get_post_meta($id, 'disable_post_sidebar', true);
if(!empty($disable_post_sidebar)) $sidebar_position = 'full';
?>

<div class="<?php echo esc_attr($container); ?>">

    <div class="<?php echo esc_attr($row); ?>">
        <div class="stm_markup stm_markup_<?php echo esc_attr($sidebar_position . ' stm_single_' . $post_type); ?>">

            <div class="stm_markup__content">
                <?php while (have_posts()): the_post();?>
                    <?php get_template_part($tpl); ?>
                <?php endwhile; ?>
            </div>

            <?php if('full' !== $sidebar_position): ?>
                <div class="stm_markup__sidebar stm_markup__sidebar_divider <?php echo esc_attr($sidebar_mobile); ?>">
                    <div class="sidebar_inner">
                        <?php pearl_sidebar(false); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($post_layout == '17' || $post_layout == '18' || $post_layout == '19' || $post_layout == '20') {
                get_template_part("partials/content/post/parts/after_content");
            } ?>

        </div>
    </div>
</div>