<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$atts['content'] = (!empty($content)) ? $content : '';

$flippable = (!empty($atts['flip']) and $atts['flip'] == 'enable') ? 'flipbox' : 'iconbox';

pearl_load_vc_element('iconbox', $atts, $flippable);