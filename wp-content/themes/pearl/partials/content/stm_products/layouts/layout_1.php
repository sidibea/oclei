<?php
$id = get_the_ID();

$product_tab_content_1_1 = get_post_meta($id, 'product_tab_content_1_1', true );
$product_tab_content_2_1 = get_post_meta($id, 'product_tab_content_2_1', true);
$product_tab_content_2_3 = get_post_meta($id, 'product_tab_content_2_3', true);
$product_tab_content_3_1 = get_post_meta($id, 'product_tab_content_3_1', true);
$product_tab_content_3_5 = get_post_meta($id, 'product_tab_content_3_5', true);
$product_tab_content_4_1 = get_post_meta($id, 'product_tab_content_4_1', true);
$product_tab_content_5_1 = get_post_meta($id, 'product_tab_content_5_1', true);

wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');

?>

<div class="products_title_box">
    <div class="title_box_info">
        <h2><?php the_title(); ?></h2>
        <?php if(!empty($product_tab_content_3_5)): ?>
            <div class="products_certificate_icons">
                <?php echo html_entity_decode(pearl_get_VC_img(intval($product_tab_content_3_5), 'full')); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if( has_post_thumbnail() ){ ?>
        <div class="title_box_thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="sharethis-inline-share-buttons"></div>
        </div>
    <?php } ?>
</div>

<div id="products__tab" class="container">
    <ul class="nav nav-tabs" id="products__tabs">
        <?php if(!empty($product_tab_content_1_1 == 'true')): ?>
        <li class="active">
            <a  href="#products__tab_1" data-toggle="tab"><span><?php esc_html_e('Product Details', 'pearl'); ?></span></a>
        </li>
        <?php endif; ?>
        <?php if (!empty($product_tab_content_2_1) and $product_tab_content_2_3): ?>
        <li>
            <a href="#products__tab_2" data-toggle="tab"><span><?php esc_html_e('Images gallery', 'pearl'); ?></span></a>
        </li>
        <?php endif; ?>
        <?php if(!empty($product_tab_content_3_1 == 'true')): ?>
        <li>
            <a href="#products__tab_3" data-toggle="tab"><span><?php esc_html_e('Certificates', 'pearl'); ?></span></a>
        </li>
        <?php endif; ?>
        <?php if(!empty($product_tab_content_4_1 == 'true')): ?>
        <li>
            <a href="#products__tab_4" data-toggle="tab"><span><?php esc_html_e('Trim Products', 'pearl'); ?></span></a>
        </li>
        <?php endif; ?>
        <?php if(!empty($product_tab_content_5_1 == 'true')): ?>
        <li>
            <a href="#products__tab_5" data-toggle="tab"><span><?php esc_html_e('Enquiry', 'pearl'); ?></span></a>
        </li>
        <?php endif; ?>
    </ul>

    <div class="tab-content clearfix">
        <?php get_template_part("partials/content/stm_products/parts/tab_1"); ?>
        <?php get_template_part("partials/content/stm_products/parts/tab_2"); ?>
        <?php get_template_part("partials/content/stm_products/parts/tab_3"); ?>
        <?php get_template_part("partials/content/stm_products/parts/tab_4"); ?>
        <?php get_template_part("partials/content/stm_products/parts/tab_5"); ?>
    </div>
</div>

<?php the_content(); ?>
