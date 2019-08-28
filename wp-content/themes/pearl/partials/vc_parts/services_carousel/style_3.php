<?php

$services = new WP_Query( array(
    'post_type'      => 'stm_services',
    'posts_per_page' => $posts_per_page
) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_class .= ' stm_services_text_carousel_' . $carousel_style;
//$css_class .= ' ' . $anim;

wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');

wp_enqueue_script( 'pearl-owl-carousel2' );
wp_enqueue_style( 'owl-carousel2' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

$image_size = (!empty($image_size)) ? $image_size : '270x170';

$i = 0;
?>

<?php if ( $services->have_posts() ): ?>
    <div class="stm_services_text_carousel <?php echo esc_attr( $css_class ); ?>">
        <div class="stm_services_carousel_wr">
            <div class="stm_services_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
                <?php while ( $services->have_posts() ): $services->the_post(); $i++;
                $current = ($services->current_post < 10) ? '0' . ($services->current_post + 1) : ($services->current_post + 1);
                ?>
                    <div class="item">
                        <div class="item_wr animation_timeout_<?php echo intval($i); ?> <?php echo esc_attr(pearl_vpb_animate_style('fadeInUp')); ?>">
                            <?php if ( has_post_thumbnail() ): ?>
                                <div class="item_thumbnail">
                                    <?php
                                    $id = get_the_ID();
                                    $img_id = get_post_thumbnail_id($id);
                                    $full_image = pearl_get_image_url($img_id);
                                    echo pearl_get_VC_img(get_post_thumbnail_id(), $image_size);
                                    ?>
                                    <div class="content">
                                        <div class="sbc content_layer"></div>
                                        <h5 class="stm_counter"><?php echo sanitize_text_field($current); ?></h5>
                                        <a class="h5" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                        <a href="<?php the_permalink(); ?>" class="no_deco">
                                            <?php esc_html_e('Read more', 'pearl'); ?>
                                            <i class="stmicon-lawyer_arrow"></i>
                                        </a>
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
                    margin: 30,
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
                    navText: '',
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