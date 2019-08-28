<?php $style = (!empty($element['value'])) ? $element['value'] : 'style_1'; ?>

<div class="stm-cart stm-cart_<?php echo esc_attr($style); ?>">
    <?php get_template_part('partials/header/elements/cart/styles/' . $style); ?>
</div>