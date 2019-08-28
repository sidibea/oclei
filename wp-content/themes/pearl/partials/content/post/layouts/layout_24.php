<?php
//psycho
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

if (pearl_check_string(pearl_get_option('post_title'))): ?>
	<h1 class="h2 text-transform"><?php the_title(); ?></h1>
<?php endif;

if (pearl_check_string(pearl_get_option('post_info'))) {
	get_template_part("{$parts}/postinfo", 1);
}

if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
	get_template_part("{$parts}/image");
} else { ?>
	<div class="stm_mgb_40"></div>
<?php } ?>

	<div class="stm_mgb_20 stm_single_post__content">
		<?php the_content(); ?>
	</div>
    <div class="clearfix"></div>
    <?php pearl_wp_link_pages(); ?>

<?php get_template_part("{$path}/_panel_2");

if (pearl_check_string(pearl_get_option('post_author'))) {
	get_template_part("{$path}/_author");
}

if (pearl_check_string(pearl_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}