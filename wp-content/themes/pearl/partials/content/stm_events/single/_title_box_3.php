<?php
$post = get_queried_object();
$id = (!empty($post->ID)) ? $post->ID : '';
/*If is shop*/
$id = (pearl_is_shop() or pearl_is_account_page()) ? pearl_shop_page_id() : $id;

$settings = pearl_title_box_settings($id);
?>

<?php if (pearl_check_string($settings['page_title_box'])): ?>
<?php else: ?>
    <h2 class="stm_single_event__title text-transform"><?php the_title(); ?></h2>
<?php endif; ?>