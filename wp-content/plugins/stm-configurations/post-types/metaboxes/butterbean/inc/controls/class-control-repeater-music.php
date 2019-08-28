<?php
/**
 * Image control class.  This control allows users to set an image.  It passes the attachment
 * ID the setting, so you'll need a custom control class if you want to store anything else,
 * such as the URL or other data.
 *
 * @package    ButterBean
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Image control class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_Control_Repeater_Music extends ButterBean_Control
{

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'repeater-music';

	/**
	 * Array of text labels to use for the media upload frame.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

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
	 * Creates a new control object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager
	 * @param  string $name
	 * @param  array $args
	 * @return void
	 */
	public function __construct($manager, $name, $args = array())
	{
		parent::__construct($manager, $name, $args);

		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'add'    => esc_html__('Add', 'butterbean'),
				'remove' => esc_html__('Delete', 'butterbean'),
				'change' => esc_html__('Change', 'butterbean'),
				'nothing' => esc_html__('No file', 'butterbean'),
				'url' => esc_html__('Enter audio title', 'butterbean'),
				'enter_url' => esc_html__('Enter audio url', 'butterbean'),
				'add_url' => esc_html__('Add url', 'butterbean'),
			)
		);
	}

	/**
	 * Adds custom data to the json array.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json()
	{
		parent::to_json();

		$this->json['l10n'] = $this->l10n;

		$value = $this->get_value();

		$values = array();

		if (!empty($value)) {
			foreach ($value as $song) {
				if(!empty($song['name'])) {
					$song['filename'] = get_the_title($song['name']);
				}
				if (!empty($song)) {
					$values[] = $song;
				}
			}
		}

		$this->json['values'] = $values;


		/*Add icons*/
		$fonts = array();

		$defaults = get_option('stm_fonts');
		if(!empty($defaults) and !empty($defaults['stmicons'])) {
			$info = $defaults['stmicons'];
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

			//$set_name = $json_file['metadata']['name'];
			$font_prefix = $json_file['preferences']['fontPref']['prefix'];

			foreach($json_file['icons'] as $icon) {
				$fonts[] = $font_prefix . $icon['properties']['name'];
			}
		}

		if(function_exists('pearl_fontawesome_list')) {
			$fa = pearl_fontawesome_list();
			foreach($fa as $icon => $name) {
				$fonts[] = $icon;
			}
		}

		$this->json['fonts'] = implode(',', $fonts);

	}
}