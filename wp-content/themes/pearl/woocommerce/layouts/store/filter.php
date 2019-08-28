<?php if ( is_active_sidebar( 'shop_sidebar' ) ) { ?>
<div class="woo_filter">
    <div class="woo_filter_title"><?php esc_html_e('Filter', 'pearl'); ?></div>
    <div class="woo_filter_dropdown">
        <?php dynamic_sidebar( 'shop_sidebar' ); ?>
    </div>
</div>
<?php } ?>