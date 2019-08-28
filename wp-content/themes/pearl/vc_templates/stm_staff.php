<?php
if (!empty($atts)) {

    extract($atts);

    $vc_atts = vc_map_get_attributes( $this->getShortcode(), $atts );


    /**
     * @var $style string
     * @var $layout string
     * @var $image int image id
     * @var $col int col-md-{$col}
     */


    $classes = array('stm_staff clearfix js_trigger');
    $classes[] = 'stm_staff_' . $atts['layout'] . '_' . $atts['style'];
	$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($vc_atts['css'], ' '));
	$classes[] = $this->getCSSAnimation($vc_atts['css_animation']);

    $classes[] = $style;
    $column = intval($col);
    $s_col = ($layout !== 'list') ? 'col-sm-6 col-sxs-4' : '';
    ?>

    <div class="col-md-<?php echo $column ?> <?php if($column != '12') { echo esc_attr($s_col); } ?>">
        <div class="<?php echo implode(' ', $classes); ?>">
            <?php pearl_load_vc_element('stm_staff', $atts, $layout . '/' . $style); ?>
        </div>
    </div>


    <?php


}

?>