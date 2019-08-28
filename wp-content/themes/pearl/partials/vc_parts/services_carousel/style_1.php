<?php

$services = new WP_Query( array(
    'post_type'      => 'stm_services',
    'posts_per_page' => $posts_per_page
) );


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_class .= ' stm_services_text_carousel_' . $style;

wp_enqueue_script( 'pearl-owl-carousel2' );
wp_enqueue_style( 'owl-carousel2' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

$image_size = (!empty($image_size)) ? $image_size : '265x170';



?>

<?php if ( $services->have_posts() ): ?>
    <div class="stm_services_text_carousel <?php echo esc_attr( $css_class ); ?>">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php echo wpb_js_remove_wpautop( $content, true ); ?>
                <div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="stm_services_carousel_wr">
                    <div class="stm_services_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
                        <?php while ( $services->have_posts() ): $services->the_post(); ?>
                            <div class="item">
                                <div class="item_wr">
                                    <?php if ( has_post_thumbnail() ): ?>
                                        <div class="item_thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo pearl_get_VC_img(get_post_thumbnail_id(), $image_size) ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="content">
                                        <h5><a class="ttc mtc_h" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <?php if(has_excerpt()): ?>
                                            <p class="excerpt"><?php echo wpb_js_remove_wpautop(get_the_excerpt()); ?></p>
                                        <?php endif; ?>
                                        <div class="stm_read_more_link style_3">
                                            <a class="mtc_h" href="<?php the_permalink(); ?>">
                                                <?php echo esc_html__( 'Read more', 'pearl' ); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
                    dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
                    items: <?php echo esc_js( $items ); ?>,
                    slideBy: 'page',
                    <?php if( $autoplay ): ?>
                    autoplay: true,
                    <?php endif; ?>
                    <?php if( $hide_pagination_control ): ?>
                    dots: false,
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
                            items: <?php echo esc_js( $items ); ?>,
                        }
                    },
                });
            });
        </script>
    </div>
<?php endif;
wp_reset_postdata(); ?>