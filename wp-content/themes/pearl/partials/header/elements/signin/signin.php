<?php if( class_exists( 'WooCommerce' )) : ?>
    <div class="stm_woo__signin">
        <?php if ( is_user_logged_in() ) { ?>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="no_deco"><i class="fa fa-user stm_mgr_8"></i><?php esc_html_e('My account','pearl'); ?></a>
        <?php }
        else { ?>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="no_deco"><i class="fa fa-user stm_mgr_8"></i><?php esc_html_e('Login / Register','pearl'); ?></a>
        <?php } ?>
	</div>
<?php endif; ?>