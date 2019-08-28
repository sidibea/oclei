<?php
$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');
if($stm_shop_layout == 'store' and class_exists('WooCommerce')) : ?>

<div class="modal fade stm_donation_popup in" id="woo_quick_view" tabindex="-1" role="dialog" aria-labelledby="searchModal">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="close_popup" data-dismiss="modal"><span class="stmicon-close_13"></span></div>
                    <div id="quick_view_box"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>