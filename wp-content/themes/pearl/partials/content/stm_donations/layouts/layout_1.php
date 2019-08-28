<?php

/**
 * @var $donation STM_Donation
 */

$donation = STM_Donation::instance(get_the_ID());


$parts = 'partials/content/stm_donations/parts/';
$path = 'partials/content/stm_donations/single/';

get_template_part($parts . '_post_info');
get_template_part($parts . '_image');
get_template_part($parts . '_details');


?>

<div class="stm_single_donation__content">
    <?php the_content(); ?>
</div>

<?php
get_template_part($path . '_actions');

get_template_part($path . '_comments');


$donation->print_form_modal();