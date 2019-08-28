<!--Link start-->

<div class="stm_single_product__image">

    <!--Image, onsale label-->
    <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

    <div class="stm_single_product__button_selectors">
        <!--Add to cart, link end-->
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>


        <a class="stm_single_product__more stm_lightgallery__selector"
           title="<?php the_title(); ?>"
           href="<?php echo esc_url(pearl_get_image_url(get_post_thumbnail_id($id), 'full')); ?>">
            <i class="stmicon-zoom-in3"></i>
        </a>
    </div>

</div>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="stm_single_product__meta">
        <!--Title-->
        <?php do_action( 'woocommerce_shop_loop_item_title' ); ?>

        <!--Price, rating-->
        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
    </div>
</a>
