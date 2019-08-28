<?php
$post_id = get_the_ID();

$before = get_post_meta($post_id, 'stm_before', true);
$after = get_post_meta($post_id, 'stm_after', true);


if (!empty($before) and !empty($after)):

    $before = pearl_get_VC_img($before, '500x320');
    $after = pearl_get_VC_img($after, '500x320');

    ?>

    <div class="personal-result-photo">
        <div class="personal-result-photo-inner clearfix">
            <div class="result-photo result-photo_before">
                <div class="result-photo-inner">
                    <?php echo wp_kses_post($before); ?>
                    <div class="result-photo__caption">
                        <div class="result-photo__caption-title mtc">
                            <?php esc_html_e('Before', 'pearl'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="result-photo result-photo_after">
                <div class="result-photo-inner">
                    <?php echo wp_kses_post($after); ?>
                    <div class="result-photo__caption">
                        <div class="result-photo__caption-title mtc">
                            <?php esc_html_e('After', 'pearl'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>