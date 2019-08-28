<?php
//Post views counter
function stm_single_post_counter()
{
	if (is_singular('post')) {
		//Views

		$cookies = '';

		if (empty($_COOKIE['stm_post_watched'])) {
			$cookies = get_the_ID();
			setcookie('stm_post_watched', $cookies, time() + (86400 * 30), '/');
			stm_increase_views(get_the_ID());
		}

		if (!empty($_COOKIE['stm_post_watched'])) {
			$cookies = $_COOKIE['stm_post_watched'];
			$cookies = explode(',', $cookies);

			if (!in_array(get_the_ID(), $cookies)) {
				$cookies[] = get_the_ID();

				$cookies = implode(',', $cookies);

				stm_increase_views(get_the_ID());
				setcookie('stm_post_watched', $cookies, time() + (86400 * 30), '/');
			}
		}

		if (!empty($_COOKIE['stm_post_watched'])) {
			$watched = explode(',', $_COOKIE['stm_post_watched']);
		}
	}
}

function stm_increase_views($post_id)
{

	$keys = array(
		'stm_post_views',
		'stm_day_' . date('j'),
		'stm_month_' . date('m')
	);

	foreach ($keys as $key) {

		$current_views = intval(get_post_meta($post_id, $key, true));

		$new_views = (!empty($current_views)) ? $current_views + 1 : 1;

		update_post_meta($post_id, $key, $new_views);
	}

}

add_action('wp', 'stm_single_post_counter', 100, 1);


/*Stats Filter*/
add_action('pre_get_posts', 'pearl_pre_get_posts_stats');

function pearl_pre_get_posts_stats($query)
{

	if (!is_admin() && !empty($_GET['popular']) && $query->is_main_query() && !$query->is_singular()) {

		$sort_type = sanitize_title($_GET['popular']);

		$time_points = pearl_get_time_points();

		$stats = array(
			'top'   => 'stm_post_views',
			'month' => 'stm_month_' . $time_points['month'],
			'day'   => 'stm_day_' . $time_points['day']
		);

		if (!empty($stats[$sort_type])) {

			$meta_key = $stats[$sort_type];

			$limits = pearl_get_popular_limits();
			$limit = intval($limits[$sort_type]);

			$order = array(
				'meta_value' => 'DESC',
				'date'           => 'ASC',
			);

			$meta_query = array(
				array(
					'key'     => $meta_key,
					'value'   => intval($limit),
					'compare' => '>=',
				),
			);

			$query->set('meta_query', $meta_query);
			$query->set('orderby', $order);

		}
	}

	return $query;
}

function pearl_get_time_points()
{
	$r = array(
		'month' => date("m", strtotime("-1 months")),
		'day'   => date("j", strtotime("-1 days")),
	);

	return $r;
}

function pearl_get_popular_limits()
{
	$r = array(
		'top'    => pearl_get_option('stm_post_popular_top', 50),
		'month'  => pearl_get_option('stm_post_popular_month', 30),
		'day'    => pearl_get_option('stm_post_popular_day', 10),
		'latest' => strtotime("-1 days")
	);

	return apply_filters('pearl_get_popular_limits', $r);
}

function pearl_get_post_popular_badge($post_id)
{

	$badge = '';

	if (!empty($_GET['popular'])) return $badge;

	$time_points = pearl_get_time_points();

	$badges = apply_filters('pearl_badges_priority', array(
		'day'    => array(
			'class' => 'trending',
			'name'  => esc_html__('Trending', 'pearl'),
			'key'   => 'stm_day_' . $time_points['day'],
			'url'   => add_query_arg('popular', 'day', pearl_get_page_for_posts())
		),
		'latest' => array(
			'class' => 'latest',
			'name'  => esc_html__('Latest', 'pearl'),
			'value' => get_the_date('U', $post_id),
			'url'   => pearl_get_page_for_posts()
		),
		'month'  => array(
			'class' => 'hot',
			'name'  => esc_html__('Hot', 'pearl'),
			'key'   => 'stm_month_' . $time_points['month'],
			'url'   => add_query_arg('popular', 'month', pearl_get_page_for_posts())
		),
		'top'    => array(
			'class' => 'popular',
			'name'  => esc_html__('Popular', 'pearl'),
			'key'   => 'stm_post_views',
			'url'   => add_query_arg('popular', 'top', pearl_get_page_for_posts())
		),
	));

	$limits = pearl_get_popular_limits();

	foreach ($badges as $badge_key => $badge_info) {
		$limit = $limits[$badge_key];
		$value = (!empty($badge_info['value'])) ? $badge_info['value'] : get_post_meta($post_id, $badge_info['key'], true);

		if ($value >= $limit) {
			$badge = $badge_info;
			break;
		}
	}

	return apply_filters('pearl_get_post_popular_badge', $badge, $post_id);
}

function pearl_get_page_for_posts()
{
	$r = get_option('page_for_posts', '/');
	if ($r !== '/') $r = get_permalink($r);

	return $r;
}


/**
 * @param string $sort_type
 * @param array $mixed_args
 * @return array
 *
 * empty = Popular
 * 'month' = Hot
 * 'day' = Trending
 */
function pearl_popular_posts_query($sort_type = 'top', $mixed_args = array())
{
	$time_points = pearl_get_time_points();

	$args = array(
		'post_type'   => 'post',
		'post_status' => 'publish',
	);

	$stats = array(
		'top'   => 'stm_post_views',
		'month' => 'stm_month_' . $time_points['month'],
		'day'   => 'stm_day_' . $time_points['day']
	);

	if (!empty($stats[$sort_type])) {

		$meta_key = $stats[$sort_type];

		$limits = pearl_get_popular_limits();
		$limit = intval($limits[$sort_type]);

		$order = array(
			'meta_value_num' => 'DESC',
			'date'           => 'ASC',
		);

		$meta_query = array(
			array(
				'key'     => $meta_key,
				'value'   => intval($limit),
				'compare' => '>=',
			)
		);

		$args['meta_query'] = $meta_query;
		$args['orderby'] = $order;

		$args = wp_parse_args($mixed_args, $args);

	}

	return $args;

}