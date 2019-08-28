<?php if(!empty($element['data'])):
    $btn_c = array(
        'btn',
        'btn_secondary',
        'btn_solid',
        'btn_fullwidth',
        'btn_extended',
        'btn_primary_hover',
    );

    $icon = $text = $url = '';
    if(!empty($element['data']['icon'])) {
        $icon = $element['data']['icon'];
        $btn_c[] = 'stm-button_icon';
    }

    $url = (!empty($element['data']['url'])) ? $element['data']['url'] : '';

    $text = (!empty($element['data']['text'])) ? $element['data']['text'] : '';

    $description = (!empty($element['data']['description'])) ? $element['data']['description'] : '';

    ?>

    <a href="<?php echo esc_url($url); ?>" class="<?php echo implode(' ', $btn_c); ?>">
        <i class="stm-button__icon <?php echo esc_attr($icon); ?>"></i>
        <div class="stm-button__text"><?php esc_html_e($text, 'pearl'); ?></div>
        <div class="stm-button__description"><?php esc_html_e($description, 'pearl'); ?></div>
    </a>

<?php endif; ?>