<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

pearl_add_element_style('woo_products', $style);

$post_type = 'product';
$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

if ($sortable == 'bestsellers') {
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
    );
} else {
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
    );
}

if(!empty($category) and $category !== 'all') {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'id',
            'terms'    => $category,
        )
    );
}

$loop = new WP_Query( $args );

$uniq = uniqid('stm_woo_products');

?>
<div class="woocommerce woo_products_<?php echo esc_attr($style); ?> <?php echo esc_attr($css); ?>">

    <?php if(($carousel == 'enable')) : ?>
        <div class="<?php echo esc_attr($uniq) ?> stm_woo_products stm_products_<?php echo intval($columns); ?>">
            <div class="row owl-carousel">
                <?php
                if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post();
                        wc_get_template_part( 'content', 'product-carousel' );
                    endwhile;
                }
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    <?php else: ?>
        <ul class="products stm_products stm_products_<?php echo intval($columns); ?>">
            <?php
            if ( $loop->have_posts() ) {
                while ( $loop->have_posts() ) : $loop->the_post();
                    wc_get_template_part( 'content', 'product' );
                endwhile;
            }
            ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    <?php endif; ?>

</div>

<!--Carousel for all styles-->
<?php if(($carousel == 'enable')) :
    wp_enqueue_style('owl-carousel2');
    wp_enqueue_script('pearl-owl-carousel2');
    $autoplay = (!empty($autoplay) and $autoplay === 'true') ? 'true' : 'false';
    $arrows = (!empty($carousel_arrows) and $carousel_arrows === 'true') ? 'true' : 'false';
?>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){

            var owlRtl = false;
            if ($('body').hasClass('rtl')) {
                owlRtl = true;
            }

            var $carousel = $('.<?php echo esc_js($uniq); ?> .row');
            $carousel.owlCarousel({
                rtl: owlRtl,
                items: '.owl-item',
                dots: false,
                nav: <?php echo esc_js($arrows) ?>,
                autoplay: <?php echo esc_js($autoplay); ?>,
                loop: true,
                slideBy: 1,
                smartSpeed: 800,
                responsive:{
                    0: {
                        items: 1,
                    },
                    568: {
                        items: 2,
                    },
                    667: {
                        items: 2,
                    },
                    768:{
                        items: <?php echo intval($columns); ?>,
                    },
                    1000:{
                        items: <?php echo intval($columns); ?>
                    }
                },
                navText: '',
            })
        });
    })(jQuery);
</script>
<?php endif;