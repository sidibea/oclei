<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_image_posts_slider');
$classes[] = 'stm_image_posts_slider_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);


//scripts & styles
pearl_add_element_style('image_posts_slider', $style);
wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_script('pearl-owl-linked');
wp_enqueue_script('pearl_image_posts_slider');
wp_enqueue_style('owl-carousel2');
wp_localize_script(
    'pearl-owl-carousel2',
    'pearl_image_posts_slider_translations',
    array(
        'of' => esc_html__('of', 'pearl')
    )
);


//vars prepare
$img_size = !empty($img_size) ? $img_size : '740x485';
$images_data = vc_param_group_parse_atts($atts['images']);
$data = array();


//build data
foreach ($images_data as $image_data) {
    if (!empty($image_data)) {
        if (empty($image_data['title'])) {
            $image_data['title'] = '';
        }
        if (empty($image_data['content'])) {
            $image_data['content'] = '';
        }

        if (empty($image_data['image'])) {
            $image_data['image'] = '';
        } else {
            $image_data['thumb'] = pearl_get_VC_attachment_img_safe($image_data['image'], '60x60', 'thumbnail');
            $image_data['image'] = pearl_get_VC_attachment_img_safe($image_data['image'], $img_size, 'full', false, false);
        }
        $data[] = $image_data;
    }
}

if (!empty($color) && $color === 'custom') {
    $color = $custom_color;
    $styles = '.stm_image_posts_slider_style_1 .slider__image_title {color: ' . $color . ' !important}';
    $styles .= '.stm_image_posts_slider_style_1 .slider__image_text {color: ' . $color . ' !important}';
    $styles .= '.stm_image_posts_slider_style_1 .slider__counter {color: ' . $color . ' !important;}';
    $styles .= '.stm_image_posts_slider_style_1 .slider__arrows [class*="owl"] {color: rgba(' . pearl_hex2rgb($color, '.6') . ') !important;}';
    $styles .= '.stm_image_posts_slider_style_1 .slider__arrows [class*="owl"] {border-color: rgba(' . pearl_hex2rgb($color, '.6') . ')!important;}';

    wp_add_inline_style('pearl-row_style_1', $styles);
}

if (!empty($data)) :
?>
    <div class="<?php echo implode(' ', $classes) ?>">
    <div class="slider__backdrop"></div>
    <div class="slider__close">
        <i class="fa fa-close"></i>
    </div>
    
    <div class="slider__wrapper">
        <div class="slider__images owl-carousel">
                <?php foreach ($data as $item) : ?>
                    <div class="slider_image"
                        data-title='<?php echo esc_attr(pearl_minimize_word($item['title'], '60')) ?>'
                        data-color='<?php echo esc_attr($color); ?>'
                        data-text='<?php echo esc_attr($item['content']); ?>'>
                        <?php echo $item['image']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="slider__content">
                <div class="slider__image_content">
                    <div class="slider__thumbnails">
                    <?php foreach ($data as $item) : ?>
                    <div class="slider__thumbnail">
                        <?php echo $item['thumb']; ?>
                    </div>
                <?php endforeach; ?>
                    </div>
                    <div class="slider__image_titles">
                    </div>

                    <div class="slider__nav">
                        <div class="slider__arrows"></div>
                        <div class="slider__counter heading_font"></div>
                    </div>

                    <div class="slider__image_texts">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>