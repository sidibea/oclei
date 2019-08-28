<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_icon_links');
$classes[] = 'stm_icon_links_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

$classes[] = 'text-' . $align;

pearl_add_element_style('icon_links', $style);

if (isset($atts['icons']) && strlen($atts['icons']) > 0) {
	$atts['icons'] = vc_param_group_parse_atts($atts['icons']);
}

if (!empty($atts['icons']) and is_array($atts['icons'])):
	$icons = $atts['icons']; ?>

	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php foreach ($icons as $icon_num => $icon):
			if (empty(array_filter($icon))) continue;

			$url = (empty($icon['url'])) ? '#' : $icon['url']; ?>
			<a href="<?php echo esc_url($url) ?>"
               target="_blank"
               class="wtc tbc sbc_h">
				<i class="<?php echo esc_attr($icon['icon']) ?>"></i>
                <?php if(!empty($icon['subheading'])): ?>
                    <span><?php echo esc_attr($icon['subheading']); ?></span>
                <?php endif; ?>
			</a>
		<?php endforeach; ?>
	</div>
<?php endif;

?>

