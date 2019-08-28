<?php
wp_enqueue_script('pearl_' . $element['type'], $theme_info['js'] . 'builder_elements/' . $element['type'] . '/font-resizer.js', array(), $theme_info['v']);
wp_enqueue_style('pearl_' . $element['type'], $theme_info['css'] . '/header/builder_elements/' . $element['type'] . '/element.css', array(), $theme_info['v']);
?>
<div class="pearl-font-resizer tbc"></div>