<?php
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

if (pearl_check_string(pearl_get_option('post_title'))): ?>
	<h1 class="mbc_a"><?php the_title(); ?></h1>
<?php endif; ?>

	<div class="stm_single_excerpt heading_font">
		<?php the_excerpt(); ?>
	</div>

<?php if (pearl_check_string(pearl_get_option('post_info'))) { ?>
	<div class="stm_single_date">
		<?php printf(esc_html__('%s by %1s', 'pearl'), get_the_date(), get_the_author()); ?>
	</div>
<?php }

if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
	get_template_part("{$parts}/image");
	$image_info = get_post(get_post_thumbnail_id());
	if(!empty($image_info) and !empty($image_info->post_content)): ?>
	    <div class="stm_image_description">
            <?php echo html_entity_decode($image_info->post_content); ?>
        </div>
    <?php endif;
} else { ?>
	<div class="stm_mgb_40"></div>
<?php } ?>

	<div class="stm_mgb_20 stm_single_post__content text-left clearfix">
		<?php the_content(); ?>
	</div>

<?php get_template_part("{$path}/_panel");

if (pearl_check_string(pearl_get_option('post_author'))) {
	get_template_part("{$path}/_author");
}

if (pearl_check_string(pearl_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}

get_template_part("{$parts}/prev_next_posts");