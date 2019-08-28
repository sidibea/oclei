<?php
/**
 * Color control class.  This class uses the core WordPress color picker.  Expected
 * values are hex colors.  This class also attempts to strip `#` from the hex color.
 * By design, it's recommended to add the `#` on output.
 *
 * @package    ButterBean
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Color control class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_Control_Iconpicker extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'iconpicker';

	/**
	 * Custom options to pass to the color picker.  Mostly, this is a wrapper for
	 * `iris()`, which is bundled with core WP.  However, if they change pickers
	 * in the future, it may correspond to a different script.
	 *
	 * @link   http://automattic.github.io/Iris/#options
	 * @link   https://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $options = array();

	/**
	 * Enqueue scripts/styles for the control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
	    $butterbean = STM_CONFIGURATIONS_URL . 'post-types/metaboxes/butterbean/';
        wp_enqueue_script(
            'fonticonpicker.js',
            $butterbean . 'js/jquery.fonticonpicker.min.js',
            array('jquery')
        );
        wp_enqueue_style(
            'fonticonpicker',
            $butterbean . 'css/jquery.fonticonpicker.min.css'
        );
        wp_enqueue_style(
            'fonticonpicker-inverted',
            $butterbean . 'css/jquery.fonticonpicker.inverted.min.css'
        );
	}

	/**
	 * Gets the attributes for the control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_attr() {
		$attr = parent::get_attr();

		$setting = $this->get_setting();

		$attr['class']              = 'butterbean-iconpicker widefat';
		$attr['type']               = 'text';

		return $attr;
	}

	/**
	 * Get the value for the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $setting
	 * @return mixed
	 */
	public function get_value( $setting = 'default' ) {

		$value = parent::get_value( $setting );

		return $value;
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

        $value = $this->get_value();


        $fonts = array();

        $sets = get_option('stm_fonts');
        $fonts_layout = get_option('stm_fonts_layout');
        if(!empty($fonts_layout)) $sets = array_merge($sets, $fonts_layout);
        if(!empty($sets)) {
			foreach($sets as $set_name => $set_info) {
				$info = $set_info;
				$upload_dir = wp_upload_dir();
				$url = trailingslashit($upload_dir['basedir']);

				/*Read json and get fontprefix*/
				global $wp_filesystem;

				if (empty($wp_filesystem)) {
					require_once ABSPATH . '/wp-admin/includes/file.php';
					WP_Filesystem();
				}

				$json_file = $url . $info['include'] . '/' . 'selection.json';
				$json_file = json_decode($wp_filesystem->get_contents($json_file), true);

				$font_prefix = $json_file['preferences']['fontPref']['prefix'];

				foreach ($json_file['icons'] as $icon) {
					$fonts[] = $font_prefix . $icon['properties']['name'];
				}
			}
		}

        $this->json['fonts'] = implode(',', $fonts);
        $this->json['value'] = $value;
		$this->json['options'] = $this->options;
	}
}