<?php
$style = (!empty($element['value'])) ? $element['value'] : 'style_1';
$tpl = 'partials/header/elements/search/styles/' . $style;
$file = get_template_directory() . '/partials/header/elements/search/styles/' . $style;
if (!file_exists(get_template_directory() . '/partials/header/elements/search/styles/' . $style . '.php')) {
    $tpl = 'partials/header/elements/search/styles/style_2';
} else
?>

<div class="stm-search stm-search_<?php echo esc_attr($element['value']); ?>">
    <?php get_template_part($tpl); ?>
</div>