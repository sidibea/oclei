<?php
if(empty($element['data']['id'])) {
	$element['data']['id'] = 'primary';
}

if (!empty($element['data']['id'])):
	$classes = array(
		'stm-navigation'
	);
	$style_string = array();

	$item_classes = array();

	$divider = '';
	$style = 'default';
	$line = 'none';
	$fwn = '';

	if (!empty($element['data'])) {

		$data = $element['data'];

		/*Divider*/
		if (!empty($data['divider'])) {
			$divider = $data['divider'];
		}

		/*Style*/
		if (!empty($data['style'])) {
			$style = $data['style'];
			if ($data['style'] == 'fullwidth') {
				$classes[] = 'tbc';
			}
		}

		/*Line*/
		if (!empty($data['line'])) {
			$line = $data['line'];
		}

		/*Font*/
		$font = 'hf';

		if(!empty($data['font'])) {
			$font = $data['font'];
		}

		if ($font === 'mf') {
			$classes[] = 'main_font';
		} else if ($font === 'hf') {
			$classes[] = 'heading_font';
		}

		/*Font size*/
		if (!empty($data['fsz'])) {
			$classes[] = 'fsz_' . intval($data['fsz']);
		}

		/*Line height*/
		if (!empty($data['lh'])) {
			$style_string['line-height'] = intval($data['lh']) . 'px';
		}

		/*FWN*/
		if (!empty($data['fwn'])) {
			$fwn = $data['fwn'];
		}
	}


	$classes[] = 'stm-navigation__default';
	$classes[] = 'stm-navigation__' . $style;
	$classes[] = 'stm-navigation__' . $line;
	$classes[] = 'stm-navigation__' . $fwn;

	$hamburger_styles = [
	        'icon' => array()
    ];
	if ($data['style'] === 'hamburger') {
		$classes[] = 'stm-navigation__hamburger';
		if (!empty($data['hamburgerIconColor'])) {
		    $hamburger_styles['icon']['background-color'] = $data['hamburgerIconColor'];
        }
        if(empty($data['position'])) {
		    $data['position'] = 'right';
        }
        $classes[] = 'stm-navigation__hamburger_' . $data['position'];
	}

	if (!empty($element['data'])) {
		if(!empty($element['data']['divider'])) {
			if (!empty($element['data']['divider']))
			{
				$classes[] = 'stm-navigation__divider';

				if ($element['data']['divider'] === 'icon' && !empty($element['data']['dividerIcon'])) {
					$divider = "<i class='divider " . esc_attr($element['data']['dividerIcon']) . "'></i>";
				}
				if ($element['data']['divider'] === 'symbol' && !empty($element['data']['dividerSymbol'])) {
					$divider = '<span class="divider">' . esc_html($element['data']['dividerSymbol']) . '</span>';
				}
			}

		}
	}

	if (!empty($style_string)) {
		$style_string = 'style="' . pearl_array_to_style_string($style_string) . '"';
	} else {
		$style_string = '';
	}

	if (!empty($hamburger_styles['icon'])) {
	    $hamburger_styles['icon'] = 'style=' . pearl_array_to_style_string($hamburger_styles['icon'], true);
    } else {
	    $hamburger_styles['icon'] = '';
    }

	?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo sanitize_text_field($style_string) ?>>
        <?php if ($data['style'] == 'vertical_left') : ?>
            <div class="stm_mobile__switcher stm_flex_last js_trigger__click" data-toggle="false">
                <span class="mbc"></span>
                <span class="mbc second"></span>
                <span class="mbc"></span>
            </div>
        <?php endif; ?>

		<?php if ($data['style'] == 'hamburger') : ?>
            <div class="stm_mobile__switcher stm_flex_last js_trigger__click" data-toggle="false" data-element=".stm-header, .stm-header__overlay, body">
                <span <?php echo esc_attr($hamburger_styles['icon']); ?> class="mbc"></span>
                <span <?php echo esc_attr($hamburger_styles['icon']); ?> class="mbc second"></span>
                <span <?php echo esc_attr($hamburger_styles['icon']); ?> class="mbc"></span>
            </div>
		<?php endif; ?>

        <ul <?php if ($data['style'] == 'vertical_left') : ?>class="stm-navigation__vertical"<?php endif; ?>>
			<?php

			$menu_args = array(
				'depth' => 3,
				'container' => false,
				'items_wrap' => '%3$s',
				'link_after' => $divider,
				'fallback_cb' => false,
				'stm_megamenu' => true
			);

			if(!empty(intval($element['data']['id']))) {
				if(is_nav_menu($element['data']['id'])) {
					$menu_args['menu'] = intval($element['data']['id']);
				} else {
					$menu_args['theme_location'] = 'primary';
				}
			} else {
				$menu_args['theme_location'] = $element['data']['id'];
			}

			wp_nav_menu($menu_args); ?>
        </ul>


		<?php if (in_array('stm-navigation__fullwidth', $classes)) {
			/*Iconbox*/
			if (!empty($element['data'])) {
				$iconbox = array(
					'data' => array()
				);
				$iconbox['data']['icon'] = (!empty($element['data']['icon'])) ? $element['data']['icon'] : '';
				$iconbox['data']['title'] = (!empty($element['data']['title'])) ? $element['data']['title'] : '';
				$iconbox['data']['description'] = (!empty($element['data']['description'])) ? $element['data']['description'] : '';
				pearl_load_element('iconbox', array('element' => $iconbox));
			}
		} ?>

    </div>

<?php endif; ?>
