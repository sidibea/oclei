<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_partners');
$classes[] = 'stm_partners_' . $style;
$classes[] = $grayscale;
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );

pearl_add_element_style('partners', $style);

if (isset($atts['partners']) && strlen($atts['partners']) > 0) {
    $partners = vc_param_group_parse_atts($atts['partners']);
    if (!is_array($partners)) {
        $temp = explode(',', $atts['partners']);
        $paramValues = array();
        foreach ($temp as $value) {
            $data = explode('|', $value);
            $newLine = array();
            $newLine['logo'] = isset($data[0]) ? $data[0] : 0;
            $newLine['url'] = isset($data[1]) ? $data[1] : '';
            $newLine['title'] = isset($data[2]) ? $data[2] : '';
            $newLine['description'] = isset($data[3]) ? $data[3] : '';
            $paramValues[] = $newLine;
        }
        $atts['partners'] = urlencode(json_encode($paramValues));
    }
}

if(!empty($partners) and is_array($partners)):
    $partners = array_filter($partners);
    if(!empty($partners)): ?>
        <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
            <?php foreach($partners as $partner):
                if(empty($partner['logo'])) continue;
                if(!empty($image_size)) {
                    $img = pearl_get_VC_img($partner['logo'], $image_size);
                } else {
                    $img = wp_get_attachment_image($partner['logo'], 'full', false);
                }
                
                ?>
                <div class="stm_partners__single">
                    <a href="<?php echo esc_url((!empty($partner['url'])) ? $partner['url'] : '#'); ?>"
                       target="_blank"
                       class="no_deco"
                       title="<?php esc_html_e('Partner Logo', 'pearl') ?>">
                        <div class="stm_partners__image mbdc_h">
                            <?php echo html_entity_decode($img); ?>
                        </div>

                        <?php if($style == 'style_2'): ?>
                            <div class="stm_partners__text">
                                <?php if(!empty($partner['title'])): ?>
                                    <h5 class="stm_partners__title ttc">
                                        <?php echo sanitize_text_field($partner['title']); ?>
                                    </h5>
                                <?php endif; ?>
                                <?php if(!empty($partner['description'])): ?>
                                    <p class="stm_partners__description">
                                        <?php echo wp_kses_post($partner['description']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </a>
					<div class="stm_partners__single_plus"></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
