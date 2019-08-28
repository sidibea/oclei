<?php
$years = array();
$posts = array();
$posts_per_page = empty($posts_per_page) ? '-1' : $posts_per_page;

$q_args = array(
	'posts_per_page' => $posts_per_page,
	'post_status' => 'publish'
);

if (!empty($categories)) {
	$categories = explode(',', $categories);
	if (is_array($categories)) {
		$q_args['category__in'] = $categories;
	}
}

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

		if (empty($posts[$year])) $posts[$year] = array();

		$posts[$year][] = array(
			'id' => $id,
			'title' => $title,
			'image' => $image,
			'year' => (pearl_check_string($show_year)) ? $year : '',
			'excerpt' => $excerpt,
			'url' => $url
		);
	}
	ksort($posts);
	foreach ($posts as $year => $post) {
		$years[] = $year;
	}

	wp_reset_postdata();
}

$years_sorted = array();

/*Split years*/
if (count($years) > 4) {
	$years_num = count($years);
	$year_coeff = $years_num / 4;
	$year_coeff_int = intval($year_coeff);
	$leftover = $year_coeff - intval($year_coeff);

	for ($i = 0; $i < $years_num; $i += $year_coeff_int) {
		$years_sorted[] = $years[$i];
	}

	switch (count($years_sorted)) {
		case 5:
			unset($years_sorted[1]);
			break;
		case 6:
			unset($years_sorted[1]);
			unset($years_sorted[3]);
			break;
		case 7:
			unset($years_sorted[1]);
			unset($years_sorted[3]);
			unset($years_sorted[5]);
			break;
	}

	/*Reindex array*/
	$years_sorted = array_values($years_sorted);

	foreach ($posts as $year => $post_year) {
		if (!in_array($year, $years_sorted)) {

			$prev_year = null;
			/*Get closest year*/
			foreach ($years_sorted as $year_sorted_key => $year_sorted) {
				if ($prev_year === null and $year < $year_sorted) {
					if (!empty($years_sorted[$year_sorted_key - 1])) {
						$prev_year = $years_sorted[$year_sorted_key - 1];
					}
				}
			}

			/*Year is the bigger one*/
			if($prev_year === null) {
				$prev_year = end($years_sorted);
			}

			if (!empty($prev_year)) {
				$posts[$prev_year] = array_merge($posts[$prev_year], $posts[$year]);
				unset($posts[$year]);
			}
		}
	}
} else {
	$years_sorted = $years;
}

if (!empty($years) and !empty($posts)):

	$cols = (count($years) > 4) ? '4' : count($years);
	$cols_num = 12 / $cols;
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="stm_posttimeline__heading">
			<div class="row">
				<?php foreach ($years_sorted as $year): ?>
					<div class="col-md-<?php echo intval($cols_num); ?> col-sm-6">
						<h4 class="ttc text-center"><?php echo sanitize_text_field($year); ?></h4>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="stm_circle_divider stm_mgb_50">
				<?php for ($i = 0; $i < $cols; $i++): ?>
					<div class="stm_circle_divider__col">
						<span class="stm_circle_divider_big mbc"></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
				<?php endfor; ?>
				<span class="stm_circle_divider_big stm_circle_divider_big_alone mbc"></span>
			</div>
		</div>
		<div class="stm_posttimeline__content">
			<div class="row">
				<?php foreach ($posts as $year => $post_year): ?>
					<div class="col-md-<?php echo intval($cols_num); ?> col-sm-6">
						<?php foreach ($post_year as $post): ?>
							<a href="<?php echo esc_url($post['url']); ?>"
							   class="stm_posttimeline__post stm_mgb_40 no_deco">
								<?php if (!empty($post['image'])): ?>
									<div class="stm_posttimeline__post_image stm_mgb_20 mbc_b">
										<?php echo html_entity_decode($post['image']); ?>
									</div>
								<?php endif; ?>
								<?php if(!empty($post['title'])): ?>
									<h5 class="stm_mgb_10">
										<?php echo pearl_minimize_word(sanitize_text_field($post['title']), $length); ?>
									</h5>
								<?php endif; ?>
								<?php if(!empty($post['year'])): ?>
									<h6 class="stm_mgb_10 mtc"><?php echo esc_attr($post['year']); ?></h6>
								<?php endif; ?>
								<p class="ttc"><?php echo html_entity_decode($post['excerpt']); ?></p>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php endif; ?>
