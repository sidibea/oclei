<?php

$services = new WP_Query( array(
    'post_type'      => 'stm_services',
    'posts_per_page' => $posts_per_page
) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_class .= ' stm_services_text_carousel_' . $carousel_style;

wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');

wp_enqueue_script( 'pearl-owl-carousel2' );
wp_enqueue_style( 'owl-carousel2' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

$image_size = (!empty($image_size)) ? $image_size : '270x170';

?>

<?php if ( $services->have_posts() ): ?>
    <div class="stm_services_text_carousel <?php echo esc_attr( $css_class ); ?>">
        <div class="stm_services_carousel_wr">
            <div class="stm_services_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
                <?php while ( $services->have_posts() ): $services->the_post(); ?>
                    <div class="item">
                        <div class="item_wr">
                            <?php if ( has_post_thumbnail() ): ?>
                                <div class="item_thumbnail">
                                    <?php
                                    $id = get_the_ID();
                                    $img_id = get_post_thumbnail_id($id);
                                    $full_image = pearl_get_image_url($img_id);
                                    echo pearl_get_VC_img(get_post_thumbnail_id(), $image_size);
                                    ?>
                                    <div class="content stm_lightgallery">
                                        <a href="<?php echo esc_url($full_image); ?>" class="item_thumbnail_popup stm_lightgallery__selector"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                        <a href="<?php the_permalink(); ?>" class="item_link"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
                    dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
                    items: <?php echo esc_js( $items ); ?>,
                    <?php if( $autoplay ): ?>
                    autoplay: true,
                    <?php endif; ?>
                    <?php if( $hide_pagination_control ): ?>
                    dots: false,
                    <?php endif; ?>
                    <?php if( $show_arrows_control ): ?>
                    nav: true,
                    <?php endif; ?>
                    <?php if( $loop ): ?>
                    loop: true,
                    <?php endif; ?>
                    autoplayTimeout: <?php echo esc_js( $timeout ); ?>,
                    smartSpeed: <?php echo esc_js( $smart_speed ); ?>,
                    responsive: {
                        0: {
                            items: <?php echo esc_js( $items_mobile ); ?>
                        },
                        768: {
                            items: <?php echo esc_js( $items_tablet ); ?>
                        },
                        980: {
                            items: <?php echo esc_js( $items_small_desktop ); ?>
                        },
                        1199:{
                            items: <?php echo esc_js( $items ); ?>
                        }
                    },
                });
            });
        </script>
    </div>
<?php endif;
wp_reset_postdata(); ?>