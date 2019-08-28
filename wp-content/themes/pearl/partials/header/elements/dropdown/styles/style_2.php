<?php
if(empty($element)) return;

if($element['value'] == 'wpml') {
    $element['dropdown'] = pearl_get_wpml_langs();
}

$element_id = pearl_random();

if(!empty($element['dropdown'])) {
    $dropdown = pearl_get_dropdown($element['dropdown']);
}

if(!empty($dropdown)): ?>
    <div class="dropdown">
        <?php if(!empty($dropdown['first'])): ?>
            <div class="dropdown-toggle"
                 id="<?php echo sanitize_text_field($element_id); ?>"
                 data-toggle="dropdown"
                 aria-haspopup="true"
                 aria-expanded="true"]
                 type="button">
                <?php esc_html_e($dropdown['first']['label'], 'pearl'); ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($dropdown['others'])): ?>
            <ul class="dropdown-list tbc"
                aria-labelledby="<?php echo sanitize_text_field($element_id); ?>">
                <?php foreach($dropdown['others'] as $key => $value): ?>
                    <li>
                        <a href="<?php echo esc_url($value['url']) ?>" class="stm-switcher__option">
                            <?php esc_html_e($value['label'], 'pearl'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>