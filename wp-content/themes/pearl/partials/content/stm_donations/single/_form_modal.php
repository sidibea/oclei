<?php


$modal_page_id = pearl_get_option('stm_donations_modal_page', false);
$modal_page_html = false;
if ($modal_page_id) {
	$page = get_post($modal_page_id);

	?>

	<div class="modal fade stm_donation_form_modal" id="stm_single_donation_form_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?php echo do_shortcode($page->post_content); ?>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<?php if ($modal_page_html) : ?>

		<script>
			if (jQuery('#stm_single_donation_form_modal').length === 0) {
				$('body').append('<?php echo json_encode($modal_page_html) ?>');
			}
		</script>
		<?php
	endif;
}
