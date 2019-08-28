<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$three_hundred_sixty   = get_post_meta( get_the_ID(), 'three_hundred_sixty', true );
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
        <?php if($three_hundred_sixty == 'true') : ?>
            <div class="store-360">
                <span class="stmicon-store-360"></span>
            </div>
        <?php endif; ?>
        <div id="myTurntable" class="turntable">
            <ul>
                <?php
                    get_template_part('woocommerce/single-product/thumbnails/product-thumbnails-360');
                ?>
            </ul>
        </div>
	</figure>
</div>

<?php
wp_enqueue_script('pearl_three_hundred_sixty');
wp_enqueue_script('three_hundred_sixty');
?>