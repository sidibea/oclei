<?php
/*Artist*/
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
	$img = pearl_get_VC_post_img_safe(get_the_ID(), 'full', 'full', true); ?>
	<div class="vc_container-fluid-force" data-margin="15">
		<div class="stm_post_bg" style="background-image:url('<?php echo esc_url($img); ?>');">
			<div class="container">
				<div class="mbc wtc">
					<?php
					if (pearl_check_string(pearl_get_option('post_info'))) {
						get_template_part($parts . 'postinfo', 8);
					} ?>
				</div>
			</div>
		</div>
	</div>
<?php }

if (pearl_check_string(pearl_get_option('post_title'))): ?>
	<h1 class="h3"><?php the_title(); ?></h1>
<?php endif; ?>


<div class="stm_mgb_40">
	<?php the_content(); ?>
</div>

<div class="stm_post_actions">
	<?php get_template_part("{$path}/_actions"); ?>
</div>

<?php if (pearl_check_string(pearl_get_option('post_author'))) {
	get_template_part("{$path}/_author");
} ?>

<div class="vc_container-fluid-force" data-margin="15">
	<div class="tbc wtc">
		<div class="container">
			<?php if (pearl_check_string(pearl_get_option('post_comments'))) {
				get_template_part("{$parts}/comments");
			} ?>
		</div>
	</div>
</div>
