<?php
if(empty($element)) return;

if(!empty($element) and !empty($element['data']) and !empty($element['data']['offices'])):
    $offices = $element['data']['offices'];

    $iconColor = $textColor = '';

    if(!empty($element['data']['iconColor'])) {
        $iconColor = $element['data']['iconColor']['value'];
    }

    if (!empty($element['data']['textColor'])) {
        $textColor = $element['data']['textColor']['value'];
    }
    ?>


    <div class="stm-offices">
        <div class="stm-switcher">
            <div
                class="stm-switcher__trigger stm-switcher__trigger_default stm-switcher__trigger_uppercase mbc">
                <?php if(!empty($element['data']['icon'])): ?>
                    <i class="stm-switcher__icon <?php echo esc_attr($element['data']['icon']) ?>"></i>
                <?php endif; ?>
                <span class="stm-switcher__text"><?php esc_html_e($offices[0]['name'], 'pearl'); ?></span>
            </div>
            <div class="stm-switcher__list tbc">
                <?php foreach($offices as $key=>$office): ?>
                    <div class="stm-switcher__option " data-switch="<?php echo intval($key); ?>">
                        <?php esc_html_e($office['name'], 'pearl'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php foreach($offices as $key=>$office):
            $hidden = ($key == 0) ? 'active' : 'hidden'; ?>
            <div class="stm-icontext js-switcher js-switcher__<?php echo esc_attr($hidden); ?> js-switcher_<?php echo intval($key); ?>">
    		<?php  if(!empty($office['info'])) : ?>
                <?php foreach($office['info'] as $k => $info):
                    $tag = 'div';
                    $url = '';
                    if(!empty($info['url'])) {
                        $tag = 'a';
                        $url = ' href="' . esc_url($info['url']) . '"';
                    }

                    ?>
                    <<?php echo sanitize_text_field($tag.$url); ?> class="stm-icontext__info  stm-icontext__info_divider no_deco">
                        <?php if(!empty($info['icon'])):?>
                            <i class="stm-icontext__icon <?php echo esc_attr($info['icon']) . ' '; echo esc_attr($iconColor) ?>"></i>
                        <?php endif; ?>
                        <?php if(!empty($info['label'])): ?>
                            <span class="stm-icontext__text <?php echo esc_attr($textColor) ?>"><?php esc_html_e($info['label'], 'pearl') ?></span>
                        <?php endif; ?>
                    </<?php echo esc_attr($tag); ?>>
                <?php endforeach; ?>
   			<?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>


