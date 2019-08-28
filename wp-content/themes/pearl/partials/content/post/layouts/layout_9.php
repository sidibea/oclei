<?php
/*BA*/
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/'; ?>

<?php if (pearl_check_string(pearl_get_option('post_title'))): ?>
	<h1 class="h2 stm_lh_40 text-center"><?php the_title(); ?></h1>

	<div class="stm_post__separator mbdc_a mbdc_b">
		<i class="stmicon-bon_appetit_diamond mtc"></i>
	</div>
<?php endif; ?>


<?php
if (pearl_check_string(pearl_get_option('post_info'))) {
	get_template_part("{$parts}/postinfo", 9);
}

if (pearl_check_string(pearl_get_option('post_image'))) {
	get_template_part("{$parts}/image");
} ?>

	<div class="stm_mgb_20">
		<?php the_content(); ?>
	</div>


<?php
get_template_part("{$path}/_actions");
get_template_part("{$parts}/related_posts");


if (pearl_check_string(pearl_get_option('post_author'))) {
	get_template_part("{$path}/_author");
}

if (pearl_check_string(pearl_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}