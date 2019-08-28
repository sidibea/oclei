<?php
//Register scripts and styles for admin pages
function pearl_startup_styles()
{
	wp_enqueue_style('stm-startup_css', get_template_directory_uri() . '/includes/admin/product_registration/assets/css/style.css', null, 1.6, 'all');
}
add_action('admin_enqueue_scripts', 'pearl_startup_styles');

//Register Startup page in admin menu
function pearl_register_startup_screen()
{
	$theme = pearl_get_theme_info();
	$theme_name = $theme['name'];
	$theme_name_sanitized = 'my-pearl';

	// Work around for theme check.
	$stm_admin_menu_page_creation_method = 'add' . '_menu_page';
	$stm_admin_submenu_page_creation_method = 'add' . '_submenu_page';

	if (!defined('ENVATO_HOSTED_SITE')) {
		/*Item Registration*/
		$stm_admin_menu_page_creation_method(
			$theme_name,
			esc_html__('Pearl', 'pearl'),
			'manage_options',
			$theme_name_sanitized,
			'pearl_theme_admin_page_functions',
			get_template_directory_uri() . '/includes/admin/product_registration/assets/img/icon.png',
			'2.1111111111'
		);

		/*My pearl*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('My pearl', 'pearl'),
			esc_html__('My pearl', 'pearl'),
			'manage_options',
			'my-pearl',
			'pearl_theme_admin_page_functions'
		);

		/*Theme options*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Theme options', 'pearl'),
			esc_html__('Theme options', 'pearl'),
			'manage_options',
			'pearl-theme-options',
			'pearl_theme_options'
		);
		/*Demo Import*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Demo import', 'pearl'),
			esc_html__('Demo import', 'pearl'),
			'manage_options',
			$theme_name_sanitized . '-demos',
			'pearl_theme_admin_install_demo_page'
		);

		/*System status*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('System status', 'pearl'),
			esc_html__('System status', 'pearl'),
			'manage_options',
			$theme_name_sanitized . '-system-status',
			'pearl_theme_admin_system_status_page'
		);

		/*Support page*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Support', 'pearl'),
			esc_html__('Support', 'pearl'),
			'manage_options',
			$theme_name_sanitized . '-support',
			'pearl_theme_admin_support_page'
		);
	} else {
		/*Demo Import*/
		$stm_admin_menu_page_creation_method(
			$theme_name,
			esc_html__('Pearl', 'pearl'),
			'manage_options',
			$theme_name_sanitized,
			'pearl_theme_admin_install_demo_page',
			get_template_directory_uri() . '/includes/admin/product_registration/assets/img/icon.png',
			'2.1111111111'
		);

		/*Theme options*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Theme options', 'pearl'),
			esc_html__('Theme options', 'pearl'),
			'manage_options',
			'pearl-theme-options',
			'pearl_theme_options'
		);
	}



	/*Theme options export*/
	if (!empty($_GET['stm_get_to'])) {
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Theme options export', 'pearl'),
			esc_html__('Theme options export', 'pearl'),
			'manage_options',
			'gigant-theme-options-export',
			'pearl_theme_options_export'
		);
	}
}

add_action('admin_menu', 'pearl_register_startup_screen', 20);

function pearl_startup_templates($path)
{
	$path = 'includes/admin/product_registration/screens/' . $path . '.php';

	$located = locate_template($path);

	if ($located) {
		load_template($located);
	}
}

//Startup screen menu page welcome
function pearl_theme_admin_page_functions()
{
	pearl_startup_templates('startup');
}

/*Support Screen*/
function pearl_theme_admin_support_page()
{
	pearl_startup_templates('support');
}

/*Install Plugins*/
function pearl_theme_admin_plugins_page()
{
	pearl_startup_templates('plugins');
}

/*Install Demo*/
function pearl_theme_admin_install_demo_page()
{
	pearl_startup_templates('install_demo');
}

/*System status*/
function pearl_theme_admin_system_status_page()
{
	pearl_startup_templates('system_status');
}

//Admin tabs
function pearl_get_admin_tabs($screen = 'welcome')
{
	$theme = pearl_get_theme_info();
	$creds = stm_get_creds();
	$theme_name = $theme['name'];
	$theme_name_sanitized = 'stm-admin';
	if (empty($screen)) {
		$screen = $theme_name_sanitized;
	}
	?>
    <div class="clearfix">
        <div class="stm_theme_info">
            <div class="stm_theme_version"><?php echo substr($theme['v'], 0, 3); ?></div>
        </div>
        <div class="stm-about-text-wrap">
            <h1><?php printf(esc_html__('Welcome to %s', 'pearl'), $theme_name); ?></h1>
        </div>
    </div>
	<?php $notice = get_site_transient('stm_auth_notice');
	if( !empty($creds['t']) && !empty($notice) ): ?>
		<div class="stm-admin-message"><strong>Theme Registration Error:</strong> <?php echo $notice; ?></div>
	<?php endif; ?>
    <h2 class="nav-tab-wrapper">
		<?php if (!defined('ENVATO_HOSTED_SITE')): ?>
            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-pearl')); ?>"
               class="<?php echo ('welcome' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Product Registration', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-pearl-demos')); ?>"
               class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=tgmpa-install-plugins')); ?>"
               class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=pearl-theme-options')); ?>"
               class="nav-tab"><?php esc_attr_e('Theme Options', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-pearl-support')); ?>"
               class="<?php echo ('support' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Support', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-pearl-system-status')); ?>"
               class="<?php echo ('system-status' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('System Status', 'pearl'); ?></a>
		<?php else: ?>
            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-pearl')); ?>"
               class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=tgmpa-install-plugins')); ?>"
               class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'pearl'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=pearl-theme-options')); ?>"
               class="nav-tab"><?php esc_attr_e('Theme Options', 'pearl'); ?></a>
		<?php endif; ?>
    </h2>
	<?php
}