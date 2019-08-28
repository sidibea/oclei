<?php
$id = get_the_ID();

$prices = get_post_meta($id, 'service_rental_prices', true);
$badge = get_post_meta($id, 'service_rental_badge', true);
$details = get_post_meta($id, 'service_rental_details', true);
$features = get_post_meta($id, 'service_rental_features', true);
$form = pearl_get_option('stm_services_single_form');
$phone = pearl_get_option('stm_services_single_phone');

?>

<?php if(!empty($prices)): ?>
    <ul class="stm_services_single__prices">
        <?php foreach($prices as $value) : ?>
            <?php if(!empty($value['label']) and !empty($value['name']) and !empty($badge)): ?>
                <li><span><?php echo sanitize_text_field($badge); ?><?php echo sanitize_text_field($value['label']); ?></span> <?php echo sanitize_text_field($value['name']); ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php the_content(); ?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php if(!empty($details)): ?>
            <h5><?php esc_html_e('Item details', 'pearl'); ?></h5>
            <ul class="stm_services_single__details">
                <?php foreach($details as $value) : ?>
                    <?php if(!empty($value['label']) and !empty($value['name'])) : ?>
                        <li>
                            <div><?php echo sanitize_text_field($value['label']); ?></div>
                            <div><?php echo sanitize_text_field($value['name']); ?></div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <?php if(!empty($features)): ?>
            <h5 class="stm_mgb_15"><?php esc_html_e('Features', 'pearl'); ?></h5>
            <ul class="stm_services_single__features">
                <?php foreach($features as $value) : ?>
                    <?php if(!empty($value)) : ?>
                        <li><div><?php echo sanitize_text_field($value); ?></div></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<div class="stm_services_single__panel">
<?php if( !empty( $form ) ): ?>
    <a href="#" data-toggle="modal" data-target="#stm_services_single__form" class="btn btn_outline btn_primary btn_gradient"><span><?php esc_html_e('Request a Call back', 'pearl'); ?></span></a>

    <div class="modal fade stm_donation_popup in" id="stm_services_single__form" tabindex="-1" role="dialog" aria-labelledby="searchModal">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="close_popup" data-dismiss="modal"><i class="fa fa-times"></i></div>
                        <?php echo do_shortcode("[contact-form-7 id={$form}]"); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if( !empty( $phone ) ): ?>
    <span class="stm_services_single__info">
        <?php if(!empty( $form ) and !empty( $phone ) ): ?>
            <span class="stm_services_single__phone_text"><?php esc_html_e('or call us', 'pearl'); ?></span>
        <?php endif; ?>
        <span class="stm_services_single__phone"><?php echo wp_kses_post( $phone ); ?></span>
    </span>
<?php endif; ?>
<?php get_template_part('partials/content/post/single/_share'); ?>
</div>