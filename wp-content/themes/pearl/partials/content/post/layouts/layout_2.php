<?php
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

if (pearl_check_string(pearl_get_option('post_title'))) {
	get_template_part("{$path}/_title");
}

if (pearl_check_string(pearl_get_option('post_info'))) {
	get_template_part("{$parts}/postinfo", 2);
}

if (pearl_check_string(pearl_get_option('post_image'))) {
	get_template_part("{$parts}/image");
}

get_template_part("{$path}/_content");

get_template_part("{$path}/_actions");

if (pearl_check_string(pearl_get_option('post_author'))) {
	get_template_part("{$path}/_author");
}

if (pearl_check_string(pearl_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}

