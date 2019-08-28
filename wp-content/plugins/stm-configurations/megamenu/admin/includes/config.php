<?php
add_filter('stm_nav_menu_item_additional_fields', 'mytheme_menu_item_additional_fields');
function mytheme_menu_item_additional_fields($fields)
{
    $fields['stm_mega'] = array(
        'name' => 'stm_mega',
        'label' => __('Megamenu type', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_0',
        'container_class' => 'stm_mega stm_megamenu_select',
        'input_type' => 'select',
        'options' => array(
            'disabled' => __('Disabled', 'stm_domain'),
            'boxed' => __('Boxed', 'stm_domain'),
            'wide' => __('Wide', 'stm_domain'),
        )
    );

    $fields['stm_mega_cols'] = array(
        'name' => 'stm_mega_cols',
        'label' => __('Megamenu columns', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_0',
        'container_class' => 'stm_mega_cols stm_megamenu_select',
        'input_type' => 'select',
        'options' => array(
            'default' => __('Default', 'stm_domain'),
            '1' => '1 column',
            '2' => '2 columns',
            '3' => '3 columns',
            '4' => '4 columns',
            '5' => '5 columns',
            '6' => '6 columns',
            '7' => '7 columns',
            '8' => '8 columns',
            '9' => '9 columns',
            '10' => '10 columns',
            '11' => '11 columns',
            '12' => '12 columns'
        )
    );

    $fields['stm_mega_col_width'] = array(
        'name' => 'stm_mega_col_width',
        'label' => __('Megamenu column width', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_1',
        'container_class' => 'stm_mega_col_width stm_megamenu_select',
        'input_type' => 'select',
        'options' => array(
            'default' => __('Default', 'stm_domain'),
            '1' => '1 column - 1/12',
            '2' => '2 columns - 1/6',
            '3' => '3 columns - 1/4',
            '4' => '4 columns - 1/3',
            '5' => '5 columns - 5/12',
            '6' => '6 columns - 1/2',
            '7' => '7 columns - 7/12',
            '8' => '8 columns - 2/3',
            '9' => '9 columns - 3/4',
            '10' => '10 columns - 5/6',
            '11' => '11 columns - 11/12',
            '12' => '12 columns - 1/1',
        )
    );

    $fields['stm_mega_cols_inside'] = array(
        'name' => 'stm_mega_cols_inside',
        'label' => __('Megamenu child columns width', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_1',
        'container_class' => 'stm_mega_cols_inside stm_megamenu_select',
        'input_type' => 'select',
        'options' => array(
            'default' => __('Default', 'stm_domain'),
            '1' => '1 column - 1/12',
            '2' => '2 columns - 1/6',
            '3' => '3 columns - 1/4',
            '4' => '4 columns - 1/3',
            '5' => '5 columns - 5/12',
            '6' => '6 columns - 1/2',
            '7' => '7 columns - 7/12',
            '8' => '8 columns - 2/3',
            '9' => '9 columns - 3/4',
            '10' => '10 columns - 5/6',
            '11' => '11 columns - 11/12',
            '12' => '12 columns - 1/1',
        )
    );

    $fields['stm_mega_second_col_width'] = array(
        'name' => 'stm_mega_second_col_width',
        'label' => __('Megamenu column width', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_2',
        'container_class' => 'stm_mega_second_col_width stm_megamenu_select',
        'input_type' => 'select',
        'options' => array(
            'default' => __('Default', 'stm_domain'),
            '1' => '1 column - 1/12',
            '2' => '2 columns - 1/6',
            '3' => '3 columns - 1/4',
            '4' => '4 columns - 1/3',
            '5' => '5 columns - 5/12',
            '6' => '6 columns - 1/2',
            '7' => '7 columns - 7/12',
            '8' => '8 columns - 2/3',
            '9' => '9 columns - 3/4',
            '10' => '10 columns - 5/6',
            '11' => '11 columns - 11/12',
            '12' => '12 columns - 1/1',
        )
    );

    $fields['stm_menu_icon'] = array(
        'name' => 'stm_menu_icon',
        'label' => __('Megamenu icon', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_1 stm_visible_lvl_2',
        'container_class' => 'stm_mega_icon',
        'input_type' => 'text',
    );

    $fields['stm_menu_image'] = array(
        'name' => 'stm_menu_image',
        'label' => __('Megamenu image', 'stm_domain'),
        'new' => __('Add image', 'stm_domain'),
        'delete' => __('Remove image', 'stm_domain'),
        'replace' => __('Replace image', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_2',
        'container_class' => 'stm_mega_image',
        'input_type' => 'image',
    );

    $fields['stm_mega_textarea'] = array(
        'name' => 'stm_mega_textarea',
        'label' => __('Megamenu textarea', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_2',
        'container_class' => 'stm_mega_textarea',
        'input_type' => 'textarea',
    );

    $fields['stm_menu_bg'] = array(
        'name' => 'stm_menu_bg',
        'label' => __('Megamenu background', 'stm_domain'),
        'new' => __('Add image', 'stm_domain'),
        'delete' => __('Remove image', 'stm_domain'),
        'replace' => __('Replace image', 'stm_domain'),
        'wrap' => 'stm_visible_lvl_0',
        'container_class' => 'stm_menu_bg',
        'input_type' => 'image',
    );

    return $fields;
}