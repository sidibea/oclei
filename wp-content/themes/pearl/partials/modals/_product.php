<?php
$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');
if($stm_shop_layout == 'store' and class_exists('WooCommerce')) : ?>

<?php
    $id = intval($id);
    $product = wc_get_product( $id );
    if(!empty($product)): ?>
        <div class="quick-view-preloader"></div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="quick-view-thumbnail">
                    <img src="<?php echo get_the_post_thumbnail_url( $product->get_id(), 'full' ); ?>" alt="<?php echo $product->get_title(); ?>" />
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="quick-view-box-info">
                    <?php if ( $product->get_title() ) : ?>
                    <div class="quick-view-title">
                        <h3><?php echo $product->get_title(); ?></h3>
                    </div>
                    <?php endif; ?>
                    <?php if ( $product->get_stock_status() ) : ?>
                    <div class="quick-view-stock-status">
                        <?php
                            $stock_status = $product->get_stock_status();
                            if ($stock_status == 'instock') {
                                echo '<span class="quick-view-instock">';
                                echo $product->get_stock_status();
                                echo '</span>';
                            } else {
                                echo '<span class="quick-view-outstock">';
                                echo $product->get_stock_status();
                                echo '</span>';
                            }
                        ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $product->get_sku() ) : ?>
                    <div class="quick-view-sku">
                        <?php esc_html_e('Sku:', 'pearl'); ?> <?php echo $product->get_sku(); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $product->get_price_html() ) : ?>
                    <div class="quick-view-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $product->get_short_description() ) : ?>
                    <div class="quick-view-description">
                        <?php echo pearl_minimize_word($product->get_short_description(), 220); ?>
                    </div>
                    <?php endif; ?>
                    <div class="stm-button">
                        <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="btn btn_solid btn_primary btn_right btn_default btn_lg btn_icon-right " title="" target="_self">
                            <span class="btn__label"><?php esc_html_e('Show details', 'pearl'); ?></span>
                            <i class="stmicon-store-arrow-left2 icon_12px" style="margin-left: 10px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>