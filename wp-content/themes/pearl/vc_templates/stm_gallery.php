<?php
/**@var $this WPBakeryShortCode_Stm_Gallery
 *
 **/
$atts = vc_map_get_attributes($this->getShortcode(), $atts);


$gallery = new Pearl_Masonry_Gallery($this);

$gallery->print_gallery();