<?php
/*Require TGM CLASS*/
require_once $pearl_include_path . 'admin/tgm/plugin-activation.php';

/*Register plugins to activate*/
add_action('tgmpa_register', 'pearl_require_plugins');

function pearl_require_plugins($return = false)
{
	$plugins_path = get_template_directory() . '/includes/admin/tgm/plugins';

	$plugins = array(
		'stm-configurations' => array(
			'name' => 'STM Configurations',
			'slug' => 'stm-configurations',
			'source' => get_package( 'stm-configurations', 'zip' ),
			'required' => true,
			'version' => '2.3.4',
			'external_url' => 'https://stylemixthemes.com/'
		),
        'stm-gdpr-compliance' => array(
            'name' => 'GDPR Compliance & Cookie Consent',
            'slug' => 'stm-gdpr-compliance',
            'source' => get_package( 'stm-gdpr-compliance', 'zip' ),
            'required' => false,
            'version' => '1.0',
            'external_url' => 'https://stylemixthemes.com/'
        ),
		'js_composer' => array(
			'name' => 'WPBakery Page Builder',
			'slug' => 'js_composer',
			'source' => $plugins_path . '/js_composer.zip',
			'required' => true,
			'version' => '5.4.7',
			'external_url' => 'http://vc.wpbakery.com'
		),
		'revslider' => array(
			'name' => 'Revolution Slider',
			'slug' => 'revslider',
			'source' => $plugins_path . '/revslider.zip',
			'required' => false,
			'version' => '5.4.7.3',
			'external_url' => 'http://www.themepunch.com/revolution/'
		),
		'contact-form-7' => array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false,
			'force_activation' => false,
		),
		'breadcrumb-navxt' => array(
			'name' => 'Breadcrumb NavXT',
			'slug' => 'breadcrumb-navxt',
			'required' => false,
		),
		'LayerSlider' => array(
			'name'               => 'LayerSlider WP',
			'slug'               => 'LayerSlider',
			'source'             => $plugins_path . '/LayerSlider.zip',
			'required'           => false,
			'external_url'       => 'http://codecanyon.net/user/kreatura/',
			'version'			 => '6.5.8'
		),
		/*Not required for all layouts*/
		'woocommerce' => array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
			'force_activation' => false,
		),
		'recent-tweets-widget' => array(
			'name' => 'Recent Tweets Widget',
			'slug' => 'recent-tweets-widget',
			'required' => false,
			'force_activation' => false,
		),
		'booked' => array(
			'name' => 'Booked Appointments',
			'slug' => 'booked',
			'source' => $plugins_path . '/booked.zip',
			'required' => false,
			'version' => '2.1',
			'external_url' => 'http://getbooked.io'
		),
		'mailchimp-for-wp' => array(
			'name' => 'MailChimp for WordPress',
			'slug' => 'mailchimp-for-wp',
			'required' => false,
			'external_url' => 'https://mc4wp.com/'
		),
		'open-table-widget' => array(
			'name' => 'Open Table Widget',
			'slug' => 'open-table-widget',
			'force_activation' => false,
			'required' => false,
		),
		'yith-woocommerce-wishlist' => array(
			'name' => 'YITH WooCommerce Wishlist',
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false,
			'external_url' => 'http://yithemes.com/themes/plugins/yith-woocommerce-wishlist/'
		),
        'sharethis-share-buttons' => array(
            'name' => 'ShareThis Share Buttons',
            'slug' => 'sharethis-share-buttons',
            'force_activation' => false,
            'external_url' => 'https://www.sharethis.com/'
        ),
        'instagram-feed' => array(
            'name' => 'Instagram Feed',
            'slug' => 'instagram-feed',
            'required' => false,
            'external_url' => 'https://smashballoon.com/'
        ),
		'amp' => array(
			'name' => 'AMP',
			'slug' => 'amp',
			'required' => false,
			'external_url' => 'https://github.com/automattic/amp-wp'
		),
	);

	if (!defined('ENVATO_HOSTED_SITE')) {
		$plugins['adrotate'] = array(
			'name' => 'AdRotate Banner Manager',
			'slug' => 'adrotate',
			'force_activation' => false,
			'required' => false,
		);
	}

	if($return) {
		return $plugins;
	} else {
		$config = array(
			'id'           => 'pearl_id23432432432',
			'is_automatic' => true
		);

		tgmpa($plugins, $config);
	}
}