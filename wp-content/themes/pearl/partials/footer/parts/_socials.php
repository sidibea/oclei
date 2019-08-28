<?php
    $footer_socials = pearl_get_option('footer_socials');
    $show_footer_socials = pearl_check_string(pearl_get_option('copyright_socials', 'false'));

    if ($show_footer_socials and !empty($footer_socials)): ?>
    <div class="stm-socials">
        <?php foreach ($footer_socials as $item):
            if (!empty($item['social']) and !empty($item['url'])): ?>
                <a href="<?php echo esc_attr($item['url']); ?>"
                   class="stm-socials__icon stm-socials__icon_round stm-socials__icon_filled icon_17px mbc_h"
                   target="_blank"
                   title="<?php esc_html_e('Social item', 'pearl'); ?>">
                    <i class="<?php echo esc_attr($item['social']); ?> ttc"></i>
                </a>
            <?php endif;
        endforeach; ?>
    </div>
<?php endif; ?>