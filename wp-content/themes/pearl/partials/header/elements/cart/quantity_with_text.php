<span class="cart__quantity-item">
    <?php printf (_n( '%d item in Cart', '%d items in Cart', WC()->cart->get_cart_contents_count(), 'pearl' ), WC()->cart->get_cart_contents_count()); ?>
</span>