<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<div class="wrap about-wrap stm-admin-wrap stm-system-status stm-admin-status-screen">
	<?php pearl_get_admin_tabs('system-status'); ?>
	<h3 class="screen-reader-text"><?php _e( 'WordPress Environment', 'pearl' ); ?></h3>
	<table class="widefat" cellspacing="0">
		<thead>
		<tr>
			<th colspan="3" data-export-label="WordPress Environment"><?php _e( 'WordPress Environment', 'pearl' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td data-export-label="Home URL"><?php _e( 'Home URL:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The URL of your site\'s homepage.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo home_url(); ?></td>
		</tr>
		<tr>
			<td data-export-label="Site URL"><?php _e( 'Site URL:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The root URL of your site.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo site_url(); ?></td>
		</tr>
		<tr>
			<td data-export-label="WP Version"><?php _e( 'WP Version:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of WordPress installed on your site.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php bloginfo( 'version' ); ?></td>
		</tr>
		<tr>
			<td data-export-label="WP Multisite"><?php _e( 'WP Multisite:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo ( is_multisite() ) ? '&#10004;' : '&ndash;'; ?></td>
		</tr>
		<tr>
			<td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td>
				<?php
				$memory = pearl_convert_memory( WP_MEMORY_LIMIT );
				if ( $memory < 128000000 ) {
					echo '<mark class="error">' . sprintf( '%1$s - We recommend setting memory to at least <strong>128MB</strong>. <br /> To import classic demo data, <strong>256MB</strong> of memory limit is required. <br /> Please define memory limit in <strong>wp-config.php</strong> file. To learn how, see: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing memory allocated to PHP.</a>', size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
				} else {
					echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
					if ( $memory < 256000000 ) {
						echo '<br /><mark class="error">' . wp_kses_post( __('Your current memory limit is sufficient, but if you need to import classic demo content, the required memory limit is <strong>256MB.</strong>', 'pearl')  ) . '</mark>';
					}
				}
				?>
			</td>
		</tr>
		<tr>
			<td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td>
				<?php if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) : ?>
					<mark class="yes">&#10004;</mark>
				<?php else : ?>
					<mark class="no">&ndash;</mark>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td data-export-label="Language"><?php _e( 'Language:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The current language used by WordPress. Default = English', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo get_locale() ?></td>
		</tr>
		</tbody>
	</table>

	<h3 class="screen-reader-text"><?php _e( 'Server Environment', 'pearl' ); ?></h3>
	<table class="widefat" cellspacing="0">
		<thead>
		<tr>
			<th colspan="3" data-export-label="Server Environment"><?php _e( 'Server Environment', 'pearl' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td data-export-label="Server Info"><?php _e( 'Server Info:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Information about the web server that is currently hosting your site.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
		</tr>
		<tr>
			<td data-export-label="PHP Version"><?php _e( 'PHP Version:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of PHP installed on your hosting server.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php if ( function_exists( 'phpversion' ) ) { echo esc_html( phpversion() ); } ?></td>
		</tr>
		<?php if ( function_exists( 'ini_get' ) ) : ?>
			<tr>
				<td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size:', 'pearl' ); ?></td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest file size that can be contained in one post.', 'pearl' ) . '">[?]</a>'; ?></td>
				<td><?php echo size_format( pearl_convert_memory( ini_get( 'post_max_size' ) ) ); ?></td>
			</tr>
			<tr>
				<td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit:', 'pearl' ); ?></td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'pearl' ) . '">[?]</a>'; ?></td>
				<td>
					<?php
					$time_limit = ini_get( 'max_execution_time' );

					if ( 180 > $time_limit && 0 != $time_limit ) {
						echo '<mark class="error">' . sprintf( wp_kses_post (__( '%1$s - We recommend setting max execution time to at least 180. <br /> To import classic demo content, <strong>300</strong> seconds of max execution time is required.<br />See: <a href="%2$s" target="_blank" rel="noopener noreferrer">Increasing max execution to PHP</a>', 'pearl' )), $time_limit, 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) . '</mark>';
					} else {
						echo '<mark class="yes">' . $time_limit . '</mark>';
						if ( 300 > $time_limit && 0 != $time_limit ) {
							echo '<br /><mark class="error">' . wp_kses_post(__( 'Current time limit is sufficient, but if you need import demo content, the required time is <strong>300</strong>.', 'pearl' )) . '</mark>';
						}
					}
					?>
				</td>
			</tr>
			<tr>
				<td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars:', 'pearl' ); ?></td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'pearl' ) . '">[?]</a>'; ?></td>
				<?php
				$registered_navs = get_nav_menu_locations();
				$menu_items_count = array( '0' => '0' );
				foreach ( $registered_navs as $handle => $registered_nav ) {
					$menu = wp_get_nav_menu_object( $registered_nav );
					if ( $menu ) {
						$menu_items_count[] = $menu->count;
					}
				}

				$max_items = max( $menu_items_count );
				$required_input_vars = $max_items * 12;
				?>
				<td>
					<?php
					$max_input_vars = ini_get( 'max_input_vars' );
					$required_input_vars = $required_input_vars + ( 500 + 1000 );
					// 1000 = theme options
					if ( $max_input_vars < $required_input_vars ) {
						echo '<mark class="error">' . sprintf( wp_kses_post (__( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'pearl')  ), $max_input_vars, '<strong>' . $required_input_vars . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
					} else {
						echo '<mark class="yes">' . $max_input_vars . '</mark>';
					}
					?>
				</td>
			</tr>
			<tr>
				<td data-export-label="SUHOSIN Installed"><?php _e( 'SUHOSIN Installed:', 'pearl' ); ?></td>
				<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself.
			If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'pearl'  ) . '">[?]</a>'; ?></td>
				<td><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&ndash;'; ?></td>
			</tr>
			<?php if ( extension_loaded( 'suhosin' ) ) :  ?>
				<tr>
					<td data-export-label="Suhosin Post Max Vars"><?php _e( 'Suhosin Post Max Vars:', 'pearl' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'pearl' ) . '">[?]</a>'; ?></td>
					<?php
					$registered_navs = get_nav_menu_locations();
					$menu_items_count = array( '0' => '0' );
					foreach ( $registered_navs as $handle => $registered_nav ) {
						$menu = wp_get_nav_menu_object( $registered_nav );
						if ( $menu ) {
							$menu_items_count[] = $menu->count;
						}
					}

					$required_input_vars = $max_items * 12;

					?>
					<td>
						<?php
						$max_input_vars = ini_get( 'suhosin.post.max_vars' );
						$required_input_vars = $required_input_vars + ( 500 + 1000 );

						if ( $max_input_vars < $required_input_vars ) {
							echo '<mark class="error">' . sprintf( wp_kses_post(__( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'pearl' )), $max_input_vars, '<strong>' . ( $required_input_vars ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . $max_input_vars . '</mark>';
						}
						?>
					</td>
				</tr>
				<tr>
					<td data-export-label="Suhosin Request Max Vars"><?php _e( 'Suhosin Request Max Vars:', 'pearl' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'pearl' ) . '">[?]</a>'; ?></td>
					<?php
					$registered_navs = get_nav_menu_locations();
					$menu_items_count = array( '0' => '0' );
					foreach ( $registered_navs as $handle => $registered_nav ) {
						$menu = wp_get_nav_menu_object( $registered_nav );
						if ( $menu ) {
							$menu_items_count[] = $menu->count;
						}
					}

					$max_items = max( $menu_items_count );
					$required_input_vars = ini_get( 'suhosin.request.max_vars' );
					?>
					<td>
						<?php
						$max_input_vars = ini_get( 'suhosin.request.max_vars' );
						$required_input_vars = $required_input_vars + ( 500 + 1000 );

						if ( $max_input_vars < $required_input_vars ) {
							echo '<mark class="error">' . sprintf( wp_kses_post(__( '%1$s - Recommended Value: %2$s.<br />Max input vars limitation will truncate POST data such as menus. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Increasing max input vars limit.</a>', 'pearl' )), $max_input_vars, '<strong>' . ( $required_input_vars + ( 500 + 1000 ) ) . '</strong>', 'http://sevenspark.com/docs/ubermenu-3/faqs/menu-item-limit' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . $max_input_vars . '</mark>';
						}
						?>
					</td>
				</tr>
				<tr>
					<td data-export-label="Suhosin Post Max Value Length"><?php _e( 'Suhosin Post Max Value Length:', 'pearl' ); ?></td>
					<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Defines the maximum length of a variable that is registered through a POST request.', 'pearl' ) . '">[?]</a>'; ?></td>
					<td><?php
						$suhosin_max_value_length = ini_get( 'suhosin.post.max_value_length' );
						$recommended_max_value_length = 2000000;

						if ( $suhosin_max_value_length < $recommended_max_value_length ) {
							echo '<mark class="error">' . sprintf( wp_kses_post(__( '%1$s - Recommended Value: %2$s.<br />Post Max Value Length limitation may prohibit the Theme Options data from being saved to your database. See: <a href="%3$s" target="_blank" rel="noopener noreferrer">Suhosin Configuration Info</a>.', 'pearl' )), $suhosin_max_value_length, '<strong>' . $recommended_max_value_length . '</strong>', 'http://suhosin.org/stories/configuration.html' ) . '</mark>';
						} else {
							echo '<mark class="yes">' . $suhosin_max_value_length . '</mark>';
						}
						?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>
		<tr>
			<td data-export-label="ZipArchive"><?php _e( 'ZipArchive:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo class_exists( 'ZipArchive' ) ? '<mark class="yes">&#10004;</mark>' : '<mark class="error">ZipArchive is not installed on your server, but is required if you need to import demo content.</mark>'; ?></td>
		</tr>
		<tr>
			<td data-export-label="MySQL Version"><?php _e( 'MySQL Version:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of MySQL installed on your hosting server.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td>
				<?php
				/** @global wpdb $wpdb */
				global $wpdb;
				echo html_entity_decode($wpdb->db_version());
				?>
			</td>
		</tr>
		<tr>
			<td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size:', 'pearl' ); ?></td>
			<td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest file size that can be uploaded to your WordPress installation.', 'pearl' ) . '">[?]</a>'; ?></td>
			<td><?php echo size_format( wp_max_upload_size() ); ?></td>
		</tr>
		</tbody>
	</table>

	<h3 class="screen-reader-text"><?php _e( 'Active Plugins', 'pearl' ); ?></h3>
	<table class="widefat" cellspacing="0" id="status">
		<thead>
		<tr>
			<th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php _e( 'Active Plugins', 'pearl' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		foreach ( $active_plugins as $plugin ) {

			$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			$version_string = '';
			$network_string = '';

			if ( ! empty( $plugin_data['Name'] ) ) {

				// Link the plugin name to the plugin url if available.
				$plugin_name = esc_html( $plugin_data['Name'] );

				if ( ! empty( $plugin_data['PluginURI'] ) ) {
					$plugin_name = '<a target="_blank" href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . esc_html__( 'Visit plugin homepage' , 'pearl' ) . '">' . $plugin_name . '</a>';
				}
				?>
				<tr>
					<td><?php echo html_entity_decode($plugin_name); ?></td>
					<td class="help">&nbsp;</td>
					<td><?php printf( _x( 'by %s', 'by author', 'pearl' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
				</tr>
				<?php
			}
		}
		?>
		</tbody>
	</table>
</div>