'use strict';

jQuery(document).ready(function () {
    if (jQuery('#stm_single_donation_form_modal').length === 0) {
        $('body').append('<?php echo json_encode($modal_page_html) ?>');
    }
});