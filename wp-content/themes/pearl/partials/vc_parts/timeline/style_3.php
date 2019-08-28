<?php
$posts = array();
$posts_classes = array();
wp_enqueue_script('stm_timeline_carousel');
wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_style('owl-carousel2');
$posts_per_page = empty($posts_per_page) ? '-1' : $posts_per_page;

$q_args = array(
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
	'order'          => 'ASC'
);

if (!empty($categories)) {
	$categories = explode(',', $categories);
	if (is_array($categories)) {
		$q_args['category__in'] = $categories;
	}
}

$classes = array(
	'stm_posts-timeline',
	'stm_posts-timeline_style_3'
);

$unique_class = uniqid('stm_posts-timeline_');
$classes[] = $unique_class;

$q = new WP_Query($q_args);


if ($q->have_posts()) {

	while ($q->have_posts()) {
		$q->the_post();
		$year = get_the_date('Y');
		$title = (pearl_check_string($show_title)) ? get_the_title() : '';
		$id = get_the_ID();
		$url = get_the_permalink($id);
		$excerpt = get_the_excerpt($id);

		$image_id = get_post_thumbnail_id($id);
		$image = pearl_get_VC_img($image_id, $image_size);


		$posts[] = array(
			'id'      => $id,
			'title'   => $title,
			'image'   => $image,
			'year'    => (pearl_check_string($show_year)) ? $year : '',
			'excerpt' => $excerpt,
			'url'     => $url,
			'class'   => get_post_class()
		);
	}
	?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

        <div class="stm_posts-timeline__images">
            <div class="images__carousel owl-carousel"></div>
        </div>
        <div class="stm_posts-timeline__content mbdc">

        </div>
    </div>
    <script>
        (function ($) {
                var el = $('.<?php echo esc_js($unique_class)  ?>');
                var posts = <?php echo json_encode($posts); ?>;

                el.data('posts', posts);
        })(jQuery)
    </script>
	<?php

	wp_reset_postdata();
}


