<?php
/**
 * @var $atts
 * @var $style
 * @var $title
 * @var $description
 * @var $year
 */
$style = (!empty($atts['style'])) ? $atts['style'] : 'style_1';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

pearl_load_vc_element('stm_company_history', $atts, $style); ?>