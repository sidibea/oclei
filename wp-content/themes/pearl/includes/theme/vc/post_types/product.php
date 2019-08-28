<?php
add_action( 'init', 'woocommerce_init_products' );

function woocommerce_init_products() {

    $category = pearl_get_terms_vc('product_cat', false);

    vc_map(array(
        'name'        => esc_html__('Product category link', 'pearl'),
        'description' => esc_html__('STM Woocommerce products categories', 'pearl'),
        'base'        => 'stm_woo_categories',
        'icon'        => 'icon-wpb-woocommerce',
        'category'    => esc_html__('Pearl', 'pearl'),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Category', 'pearl'),
                'param_name' => 'category',
                'value'      => $category
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Columns', 'pearl'),
                'param_name' => 'columns',
                'value'       => array(
                    esc_html__('One', 'pearl')      => '1',
                    esc_html__('Two', 'pearl')      => '2',
                    esc_html__('Three', 'pearl')    => '3',
                    esc_html__('Four', 'pearl')     => '4'
                    //Min 3 columns, max 4 columns - do not add more. Store layout settings!
                ),
                'std'        => '1',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Custom button text', 'pearl'),
                'param_name'  => 'button_text',
                'description' => esc_html__('If you need to change button text', 'pearl')
            ),
            pearl_load_styles(1, 'style', true),
            pearl_vc_add_css_editor()
        )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Stm_Woo_Categories extends WPBakeryShortCode {
        }
    }}

    vc_map(array(
        'name'        => esc_html__('Product', 'pearl'),
        'description' => esc_html__('Show product by title', 'pearl'),
        'base'        => 'stm_woo_product',
        'icon'        => 'icon-wpb-woocommerce',
        'category'    => esc_html__('Pearl', 'pearl'),
        'params'      => array(
            array(
                'type'        => 'autocomplete',
                'heading'     => esc_html__('Select product', 'pearl'),
                'param_name'  => 'product_id',
                'admin_label' => true,
                'settings'    => array(
                    'multiple'       => false,
                    'sortable'       => false,
                    'min_length'     => 1,
                    'no_hide'        => false,
                    'unique_values'  => true,
                    'display_inline' => true,
                )
            ),
            pearl_load_styles(3, 'style', true),
            pearl_vc_add_css_editor()
        )
    ));


    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Stm_Woo_Product extends WPBakeryShortCode
        {
        }
    }

    $category = pearl_get_terms_vc('product_cat');

    vc_map(array(
        'name'        => esc_html__('Products', 'pearl'),
        'description' => esc_html__('STM Woocommerce products', 'pearl'),
        'base'        => 'stm_woo_products',
        'icon'        => 'icon-wpb-woocommerce',
        'category'    => esc_html__('Pearl', 'pearl'),
        'params'      => array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Order by', 'pearl'),
                'param_name' => 'sortable',
                'value'       => array(
                    esc_html__('Default', 'pearl')    => 'default',
                    esc_html__('Best sellers', 'pearl')     => 'bestsellers'
                ),
                'std'        => 'default',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Filter by', 'pearl'),
                'param_name' => 'filterable',
                'value'       => array(
                    esc_html__('Default', 'pearl')    => 'default',
                    esc_html__('Categories', 'pearl')     => 'categories'
                ),
                'std'        => 'default',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Category', 'pearl'),
                'param_name' => 'category',
                'dependency' => array(
                    'element'   => 'filterable',
                    'value' => 'categories'
                ),
                'value'      => $category
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Per Page', 'pearl'),
                'param_name'  => 'posts_per_page',
                'description' => esc_html__('Number of products to show', 'pearl')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Columns', 'pearl'),
                'param_name' => 'columns',
                'value'       => array(
                    esc_html__('Three', 'pearl')    => '3',
                    esc_html__('Four', 'pearl')     => '4'
                    //Min 3 columns, max 4 columns - do not add more. Store layout settings!
                ),
                'std'        => '3',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Carousel', 'pearl'),
                'param_name' => 'carousel',
                'value'       => array(
                    esc_html__('Disable', 'pearl')      => 'disable',
                    esc_html__('Enable', 'pearl')      => 'enable',
                ),
                'std'        => 'disable',
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Enable arrows', 'pearl'),
                'param_name' => 'carousel_arrows',
                'dependency' => array(
                    'element'   => 'carousel',
                    'value' => 'enable'
                ),
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Enable Autoplay', 'pearl'),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element'   => 'carousel',
                    'value' => 'enable'
                )
            ),
            pearl_load_styles(3, 'style', true),
            pearl_vc_add_css_editor()
        )
    ));


    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Stm_Woo_Products extends WPBakeryShortCode {
        }
    }

    $pages_data = pearl_get_post_data('product');

    vc_map(array(
        'name'        => esc_html__('Special Product', 'pearl'),
        'description' => esc_html__('Show special product by title', 'pearl'),
        'base'        => 'stm_woo_special_product',
        'icon'        => 'icon-wpb-woocommerce',
        'category'    => esc_html__('Pearl', 'pearl'),
        'params'      => array(
            array(
                'type'        => 'autocomplete',
                'heading'     => esc_html__('Select product', 'pearl'),
                'param_name'  => 'product_id',
                'admin_label' => true,
                'settings'    => array(
                    'multiple'       => false,
                    'sortable'       => false,
                    'min_length'     => 1,
                    'no_hide'        => false,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'values'         => $pages_data
                )
            ),
            array(
                'type'        => 'stm_datepicker_vc',
                'heading'     => esc_html__('Date end', 'pearl'),
                'param_name'  => 'datepicker',
                'holder'      => 'div',
                'description' => 'This is a required field',
            ),
            array(
                'type'        => 'stm_timepicker_vc',
                'heading'     => esc_html__('Time end', 'pearl'),
                'param_name'  => 'timepicker',
                'description' => 'This is a required field',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Block size', 'pearl'),
                'param_name' => 'block_size',
                'value'      => array(
                    esc_html__('Normal', 'pearl') => 'normal_size',
                    esc_html__('Big', 'pearl')    => 'big_size',
                ),
                'std'        => 'normal',
            ),
            array(
                'type'       => 'textarea_html',
                'heading'    => esc_html__('Box title', 'pearl'),
                'holder'     => 'div',
                'param_name' => 'content',
                'group'      => esc_html__('Content', 'pearl'),
                'dependency' => array(
                    'element' => 'block_size',
                    'value'   => array('big_size')
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Default Spacer height', 'pearl'),
                'param_name'  => 'height',
                'admin_label' => true,
                'group'       => esc_html__('Content', 'pearl'),
                'dependency'  => array(
                    'element' => 'block_size',
                    'value'   => array('big_size')
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Desctop (max 1300px) Spacer height', 'pearl'),
                'param_name' => 'height_tablet_desktop',
                'group'      => esc_html__('Content', 'pearl'),
                'dependency' => array(
                    'element' => 'block_size',
                    'value'   => array('big_size')
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Tablet (landscape) Spacer height', 'pearl'),
                'param_name' => 'height_tablet_landscape',
                'group'      => esc_html__('Content', 'pearl'),
                'dependency' => array(
                    'element' => 'block_size',
                    'value'   => array('big_size')
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Tablet Spacer height', 'pearl'),
                'param_name' => 'height_tablet',
                'group'      => esc_html__('Content', 'pearl'),
                'dependency' => array(
                    'element' => 'block_size',
                    'value'   => array('big_size')
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Mobile Spacer height', 'pearl'),
                'param_name' => 'height_mobile',
                'group'      => esc_html__('Content', 'pearl'),
                'dependency' => array(
                    'element' => 'block_size',
                    'value'   => array('big_size')
                ),
            ),
            pearl_load_styles(1, 'style', true),
            pearl_vc_add_css_editor()
        )
    ));


    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Stm_Woo_Special_Product extends WPBakeryShortCode
        {
        }
    }