<?php if( class_exists( 'WooCommerce' )) : ?>
    <div class="cart cart_rounded mbc_h">
        <i class="cart__icon fa fa-shopping-cart fa-16px"></i>

        <!--Quantitiy-->
        <?php get_template_part('partials/header/elements/cart/quantity'); ?>

        <!--Mini cart-->
        <?php get_template_part('partials/header/elements/cart/mini', 'cart'); ?>
    </div>
<?php endif; ?>