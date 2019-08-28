<?php if( class_exists( 'WooCommerce' )) : ?>
    <div class="cart cart_rounded">
        <!--Quantitiy-->
        <?php get_template_part('partials/header/elements/cart/quantity_with_text'); ?>

        <!--Cart icon-->
        <span class="cart__icon stmicon stmicon-cart-flat fa-16px"></span>

        <!--Mini cart-->
        <?php get_template_part('partials/header/elements/cart/mini', 'cart'); ?>
    </div>
<?php endif; ?>