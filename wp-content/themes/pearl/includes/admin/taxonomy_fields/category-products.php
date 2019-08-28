<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

add_action('products_category_add_form_fields', 'stm_taxonomy_products_add_field', 10);
add_action('products_category_edit_form_fields', 'stm_taxonomy_products_edit_field', 10, 2);
/** Save Custom Field Of Form */
add_action('created_products_category', 'stm_taxonomy_products_image_save', 10, 1);
add_action('edited_products_category', 'stm_taxonomy_products_image_save', 10, 1);


/*Add field*/
if (!function_exists('stm_taxonomy_products_add_field')) {
	function stm_taxonomy_products_add_field($taxonomy)
	{
		$default_image = get_template_directory_uri() . '/assets/admin/img/default_170x50.gif';
		?>
		<div class="form-field">
			<label for="stm_taxonomy_listing_image"><?php esc_html_e('Category Image'); ?></label>
			<div class="stm-choose-listing-image">
				<input
					type="hidden"
					name="pearl_products_category_image"
					id="pearl_products_category_image"
					value=""
					size="40"
					aria-required="true"/>

				<img class="stm_taxonomy_listing_image_chosen" src="<?php echo esc_url($default_image); ?>"/>

				<input type="button" class="button-primary" value="Choose image"/>
			</div>
			<script type="text/javascript">
                jQuery(function ($) {
                    $(".stm-choose-listing-image .button-primary").click(function () {
                        var custom_uploader = wp.media({
                            title: "Select image",
                            button: {
                                text: "Attach"
                            },
                            multiple: false
                        }).on("select", function () {
                            var attachment = custom_uploader.state().get("selection").first().toJSON();
                            $('#pearl_products_category_image').val(attachment.id);
                            $('.stm_taxonomy_listing_image_chosen').attr('src', attachment.url);
                        }).open();
                    });
                });
			</script>
		</div>
	<?php }
}

/*Edit field*/
if (!function_exists('stm_taxonomy_products_edit_field')) {
	function stm_taxonomy_products_edit_field($tag)
	{
		$default_image_placeholder = get_template_directory_uri() . '/assets/admin/img/default_170x50.gif';
		$default_image = get_template_directory_uri() . '/assets/admin/img/default_170x50.gif';
		$make_custom_order = $current_image = get_term_meta($tag->term_id, 'pearl_products_category_image', true);
		if (!empty($current_image)) {
			$default_image = wp_get_attachment_image_src($current_image, 'thumbnail');
			if (!empty($default_image[0])) {
				$default_image = $default_image[0];
			}
		}

		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label
					for="stm_taxonomy_listing_image"><?php esc_html_e('Category Image'); ?></label></th>
			<td>
				<div class="stm-choose-listing-image">
					<input
						type="hidden"
						name="pearl_products_category_image"
						id="pearl_products_category_image"
						value="<?php echo esc_attr($make_custom_order) ? esc_attr($make_custom_order) : ''; ?>"
						size="40"
						aria-required="true"/>

					<img class="stm_taxonomy_listing_image_chosen" src="<?php echo esc_url($default_image); ?>"/>

					<input type="button" class="button-primary" value="Choose image"/>
					<input type="button" class="button-primary-delete" value="Remove image"/>
				</div>
			</td>
			<script type="text/javascript">
                jQuery(function ($) {
                    $(".stm-choose-listing-image .button-primary").click(function () {
                        var custom_uploader = wp.media({
                            title: "Select image",
                            button: {
                                text: "Attach"
                            },
                            multiple: false
                        }).on("select", function () {
                            var attachment = custom_uploader.state().get("selection").first().toJSON();
                            $('#pearl_products_category_image').val(attachment.id);
                            $('.stm_taxonomy_listing_image_chosen').attr('src', attachment.url);
                        }).open();
                    });

                    $(".stm-choose-listing-image .button-primary-delete").click(function () {
                        $('#pearl_products_category_image').val('');
                        $('.stm_taxonomy_listing_image_chosen').attr('src', '<?php echo esc_url($default_image_placeholder); ?>');
                    })
                });
			</script>
		</tr>
	<?php }
}

/*Save value*/
if (!function_exists('stm_taxonomy_products_image_save')) {
	function stm_taxonomy_products_image_save($term_id)
	{
		if (isset($_POST['pearl_products_category_image'])) {
			$option_name = 'pearl_products_category_image';
			$value = sanitize_text_field($_POST['pearl_products_category_image']);
			update_term_meta($term_id, $option_name, $value);
		}
	}
}