<?php
get_header();

if (have_posts()) {
	if (pearl_is_pearl_post_type()) {
		pearl_get_titlebox();
		get_template_part('partials/content/single');
	} else {
		while (have_posts()) {
			the_post();
			the_content();
		}
	}
}

get_footer();