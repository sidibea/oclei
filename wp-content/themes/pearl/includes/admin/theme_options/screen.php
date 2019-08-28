<?php
function pearl_theme_options()
{ ?>
    <div class="stm-theme-options-admin-wrapper">
        <?php pearl_output_vars(); ?>
        <div ng-app="theme_options">
            <app-root></app-root>
        </div>
    </div>
<?php }

function pearl_theme_options_export() { ?>
	<div class="stm_export_settings">
		<a href="<?php echo esc_url( add_query_arg( 'export_settings', '1', '?page=pearl-theme-options-export' ) ); ?>" class="button button-primary">
			<?php esc_html_e('Get my settings', 'pearl'); ?>
		</a>
	</div>
<?php }

/*Export settings*/
function pearl_export_settings()
{
	if (!empty($_GET['export_settings'])) {
		$options = get_option('stm_theme_options');

		header('Content-disposition: attachment; filename=file.json');
		header('Content-type: application/json');
		echo json_encode($options);
		exit();
	}
}

add_action('init', 'pearl_export_settings');