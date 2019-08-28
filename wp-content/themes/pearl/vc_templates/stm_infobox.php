<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
/**
 * @var $image
 * @var $image_size
 * @var $content
 * @var $style
 * @var $url
 * @var $link_title
 */
extract( $atts );
$atts['content'] = (!empty($content)) ? $content : '';
pearl_load_vc_element('infobox', $atts, $style);