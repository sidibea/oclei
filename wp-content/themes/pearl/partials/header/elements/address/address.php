<?php if(!empty($element['data']['address'])):
    $address = $element['data']['address'];
    $google_api_key = pearl_get_option('google_api_key');
    ?>
    <?php foreach($address as $key=>$item): ?>
    <div class="stm-address-box" style="z-index: <?php echo sanitize_text_field($item['position']); ?>">

        <div class="stm-address-hours-title" data-switch="<?php echo intval($key); ?>">
            <?php esc_html_e($item['title'], 'pearl'); ?>
            <strong><?php esc_html_e($item['phone'], 'pearl'); ?></strong>
        </div>

        <div class="stm-address-info">
            <div class="stm-address-hours" data-switch="<?php echo intval($key); ?>">
                <strong><?php esc_html_e($item['hoursTitle'], 'pearl'); ?></strong>
                <?php esc_html_e($item['hours'], 'pearl'); ?>
            </div>

            <div class="stm-address-address" data-switch="<?php echo intval($key); ?>">
                <strong><?php esc_html_e($item['addressTitle'], 'pearl'); ?></strong>
                <?php esc_html_e($item['address'], 'pearl'); ?>
            </div>

            <div class="stm-address-map" data-switch="<?php echo intval($key); ?>">
                <?php echo stripslashes($item['map']); ?>
            </div>

            <?php if(!empty(sanitize_text_field($item['lat'])) and !empty(sanitize_text_field($item['long'])) ) : ?>
            <iframe
                width="100%"
                height="100"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
                src="https://maps.google.com/maps?q=<?php echo sanitize_text_field($item['lat']); ?>,<?php echo sanitize_text_field($item['long']); ?>&hl=es;z=14&amp;output=embed"
            >
            </iframe>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>