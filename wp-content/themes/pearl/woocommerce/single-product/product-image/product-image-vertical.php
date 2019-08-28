<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product;
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

$thumbnails_quantity = pearl_get_option('thumbnails_quantity', '5');

wp_enqueue_style('slick.js');
wp_enqueue_script('slick.js');
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <figure class="woocommerce-product-gallery__wrapper">
        <?php
        $attributes = array(
            'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
            'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
            'data-src'                => $full_size_image[0],
            'data-large_image'        => $full_size_image[0],
            'data-large_image_width'  => $full_size_image[1],
            'data-large_image_height' => $full_size_image[2],
        );

        if ( has_post_thumbnail() ) {
            $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="product_vertical_single_thumbnail"><a href="' . esc_url( $full_size_image[0] ) . '">';
            $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
            $html .= '</a></div>';
        } else {
            $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
            $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
            $html .= '</div>';
        }

        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
        $attachment_ids = $product->get_gallery_image_ids();
        echo '<div class="stm_product_vertical_carousel"><div class="inner">';
        if ( $attachment_ids ) {
            echo '<div class="woocommerce-product-gallery__thumbnail">';
            echo get_the_post_thumbnail($post->ID, 'shop_single', $attributes);
            echo '</div>';
        }
            get_template_part('woocommerce/single-product/thumbnails/product-thumbnails-vertical');
        echo '</div></div>';

        ?>
    </figure>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        "use strict";

        $('.woocommerce-product-gallery__thumbnail').click(function(e){
            e.preventDefault();
            $('.woocommerce-product-gallery__thumbnail').removeClass('slick-current');
            $(this).addClass('slick-current');
            var photo_fullsize =  $(this).find('img').attr('src');

            $('.stm_lightgallery__selector img').attr('srcset', photo_fullsize);
            $('.stm_lightgallery__selector img').attr('src', photo_fullsize);
            $('.stm_lightgallery__selector img').attr('data-src', photo_fullsize);
            $('.stm_lightgallery__selector img').attr('data-large_image', photo_fullsize);
            $('.stm_lightgallery__selector').attr('href', photo_fullsize);

        });

        $('.stm_product_vertical_carousel').click(function(e){
            var photo_fullsize =  $('.slick-current').find('img').attr('src');
            $('.stm_lightgallery__selector img').attr('srcset', photo_fullsize);
            $('.stm_lightgallery__selector img').attr('src', photo_fullsize);
            $('.stm_lightgallery__selector img').attr('data-src', photo_fullsize);
            $('.stm_lightgallery__selector img').attr('data-large_image', photo_fullsize);
            $('.stm_lightgallery__selector').attr('href', photo_fullsize);
        });

        $(".stm_product_vertical_carousel").each(function () {
            var $el = $(this).find('.inner');
            var breakpoint_tablet = 1199;
            var breakpoint_mobile = 479;
            $el.slick({
                dots: false,
                arrows: true,
                infinite: false,
                vertical: true,
                slidesToScroll: 3,
                verticalSwiping: true,
                slidesToShow: <?php echo $thumbnails_quantity?>,
                responsive: [
                    {
                        breakpoint: breakpoint_tablet,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: breakpoint_mobile,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                ]
            });
        });

    });
</script>
