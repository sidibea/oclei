<?php
    $right_text = pearl_get_option('right_text');
    if (!empty($right_text) ) : ?>

    <div class="stm_markup__sidebar text-right">
        <?php if (!empty($right_text)): ?>
            <div class="stm_footer_bottom__right">
                <?php echo wp_kses_post($right_text); ?>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>