<?php
$id = get_the_ID();
$video_url = get_post_meta($id, 'single_post_video', true);
$video_preview = get_post_meta($id, 'single_post_video_preview', true);

if(!empty($video_url) && !empty($video_preview)):
	$video_url = pearl_generate_youtube($video_url);
	$video_preview = pearl_get_VC_attachment_img_safe($video_preview, '1110x640', 'full', true);
	$video_preview = 'style="background-image:url(\'' . $video_preview . '\')"';
	?>

	<a href="<?php echo esc_url($video_url); ?>"
       class="stm_single_post_video_format stm_lightgallery__iframe"
       data-iframe="true"
        <?php echo sanitize_text_field($video_preview); ?>>
		<div class="play"></div>
	</a>

	<script type="text/javascript">
		(function($){
		    $(document).ready(function(){
		        $('body').addClass('stm_post_has_video');
			})
		})(jQuery)
	</script>

<?php endif;