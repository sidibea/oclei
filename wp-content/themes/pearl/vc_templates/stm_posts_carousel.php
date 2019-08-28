<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

pearl_add_element_style('posts_carousel', $style);

pearl_load_vc_element('posts_carousel', $atts, $style);