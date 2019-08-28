<?php
/**
 * Load Projects from *offset*
 */
function pearl_load_post_type_gallery()
{

	$offset = intval($_GET['offset']);
	$number = intval($_GET['number']);
	$category = intval($_GET['category']);
	$tax = sanitize_text_field($_GET['taxonomy']);
	$path = sanitize_text_field($_GET['path']);
	$style = sanitize_text_field($_GET['style']);
	$post_type = sanitize_text_field($_GET['post_type']);

	$r = array(
		'content' => '',
		'offset'  => false
	);

	$atts = array('class' => 'loading');
	$atts['img_size'] = (!empty($_GET['img_size'])) ? sanitize_text_field($_GET['img_size']) : '';

	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $number,
		'offset'         => $offset
	);

	if (!empty($category) and $category !== 'all') {
		$args['tax_query'][] = array(
			'taxonomy' => $tax,
			'field'    => 'term_id',
			'terms'    => intval($category),
		);
	}

	$q = new WP_Query($args);

	$offset = (($offset / $number) * $number) + $number;
	$total = $q->found_posts;

	if ($q->have_posts()) {
		ob_start();
		while ($q->have_posts()) {
			$q->the_post();
			pearl_load_vc_element($path, $atts, $style);
		}

		$r['content'] = ob_get_clean();
	}

	if ($total > $offset) {
		$r['offset'] = $offset;
	}

	wp_reset_postdata();
	wp_send_json($r);
}

add_action('wp_ajax_pearl_load_post_type_gallery', 'pearl_load_post_type_gallery');
add_action('wp_ajax_nopriv_pearl_load_post_type_gallery', 'pearl_load_post_type_gallery');


//Universal function to load more posts
function pearl_load_more_posts()
{
	$page = intval($_GET['page']);
	$per_page = intval($_GET['per_page']);
	$offset = $per_page * $page;

	$r = array(
		'content' => '',
		'page'    => $page + 1
	);

	$upcoming = $past = false;

	if (!empty($_GET['upcoming']) and pearl_check_string($_GET['upcoming'])) {
		$upcoming = true;
	}

	if (!empty($_GET['past']) and pearl_check_string($_GET['past'])) {
		$past = true;
	}

	$style = sanitize_text_field($_GET['style']);
	$post_type = sanitize_text_field($_GET['post_type']);

	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $per_page,
		'offset'         => $offset,
		'orderby'        => 'meta_value_num',
		'meta_key'       => 'date_start',
		'order'          => 'ASC',
		'meta_query'     => array(
			'relation' => 'OR',
		),
	);

	if ($past) {
		$args['meta_query'][] = array(
			'key'     => 'date_start',
			'value'   => time(),
			'compare' => '<=',
		);
	}

	if ($upcoming) {
		$args['meta_query'][] = array(
			'key'     => 'date_start',
			'value'   => time(),
			'compare' => '>=',
		);
	}

	$q = new WP_Query($args);

	$total = $q->found_posts;
	if ($q->have_posts()) {
		$tpl = 'partials/content/' . $post_type . '/' . $style;
		ob_start();
		while ($q->have_posts()) {
			$q->the_post();
			get_template_part($tpl);
		}
		$r['content'] = ob_get_clean();
	}

	if ($total <= ($offset + $per_page)) {
		$r['page'] = null;
	}

	wp_reset_postdata();

	wp_send_json($r);
	exit;
}


add_action('wp_ajax_pearl_load_more_posts', 'pearl_load_more_posts');
add_action('wp_ajax_nopriv_pearl_load_more_posts', 'pearl_load_more_posts');


function pearl_load_album()
{
	$r = array();
	if (!empty(intval($_GET['album']))) {
		$album = intval($_GET['album']);
		$songs = pearl_create_playlist($album);

		$r = array(
			'album'       => $album,
			'songs'       => $songs,
			'album_title' => get_the_title($album)
		);
	}

	wp_send_json($r);
}

add_action('wp_ajax_pearl_load_album', 'pearl_load_album');
add_action('wp_ajax_nopriv_pearl_load_album', 'pearl_load_album');


function pearl_donate()
{

	$json = array();
	$json['errors'] = array();


	if (!empty($_POST['donor']['amount'])) {
		$_POST['donor']['amount'] = intval($_POST['donor']['amount']);
	}

	if (!empty($_POST['donor']['custom_amount'])) {
		$_POST['donor']['amount'] = intval($_POST['donor']['custom_amount']);
	}


	if (!filter_var($_POST['donor']['amount'], FILTER_VALIDATE_INT)) {
		$json['errors']['amount'] = true;
	}

	if (!empty($_POST['donor']['custom_amount'])) {
		if (!filter_var($_POST['donor']['custom_amount'], FILTER_VALIDATE_INT)) {
			$json['errors']['custom_amount'] = true;
		} else {
			$_POST['donor']['amount'] = $_POST['donor']['custom_amount'];
		}
	}

	if (!filter_var($_POST['donor']['first_name'], FILTER_SANITIZE_STRING)) {
		$json['errors']['first_name'] = true;
	}

	if (!filter_var($_POST['donor']['last_name'], FILTER_SANITIZE_STRING)) {
		$json['errors']['last_name'] = true;
	}

	if (!is_email($_POST['donor']['email'])) {
		$json['errors']['email'] = true;
	}

	if (!is_numeric($_POST['donor']['phone'])) {
		$json['errors']['phone'] = true;
	}

	if (empty($json['errors'])) {

		$donation_id = $_POST['donationId'];

		$donation = STM_Donation::instance($donation_id);

		$items = $donation->process_payment($_POST['donor']);

		wp_send_json($items);

		$json['success'] = generatePayment($_POST['donor']);
	}

	wp_send_json($json);

}

add_action('wp_ajax_pearl_donate', 'pearl_donate');
add_action('wp_ajax_nopriv_pearl_donate', 'pearl_donate');

function pearl_load_splash_album()
{
	ob_start();
	get_template_part('partials/modals/_album_modal');
	$r = ob_get_clean();
	wp_send_json($r);
	exit;
}

add_action('wp_ajax_pearl_load_splash_album', 'pearl_load_splash_album');
add_action('wp_ajax_nopriv_pearl_load_splash_album', 'pearl_load_splash_album');


function pearl_load_portfolio()
{
	$r = array();
	$vars = array();
	$vars['offset'] = intval($_GET['offset']);
	$vars['number'] = intval($_GET['number']);
	$vars['total'] = intval($_GET['total']);
	$vars['style'] = sanitize_text_field($_GET['style']);
	$vars['is_ajax'] = true;

	ob_start();
	pearl_load_vc_element('projects_cards', $vars, $vars['style'] . '/cards');
	$r['content'] = ob_get_clean();
	$r['offset'] = $vars['number'] + $vars['offset'];

	wp_send_json($r);
	exit;
}

add_action('wp_ajax_pearl_load_portfolio', 'pearl_load_portfolio');
add_action('wp_ajax_nopriv_pearl_load_portfolio', 'pearl_load_portfolio');

function pearl_load_posts_list()
{
	$r = array();
	$vars = array();
	$get = $_GET;

	foreach ($get as $name => $value) {
		$vars[sanitize_text_field($name)] = sanitize_text_field($value);
	}

	$vars['atts'] = $vars;

	ob_start();
	$path = 'vc_templates/stm_posts_list';
	pearl_load_vc_element('posts_list', $vars, $vars['style'], $path);
	$r['content'] = ob_get_clean();
	$r['offset'] = $vars['offset'];

	wp_send_json($r);

	exit;
}

add_action('wp_ajax_pearl_load_posts_list', 'pearl_load_posts_list');
add_action('wp_ajax_nopriv_pearl_load_posts_list', 'pearl_load_posts_list');

function pearl_woo_quick_view()
{
	$r = array();
	$vars = array();
	$vars['id'] = intval($_GET['id']);

	ob_start();
	$path = 'partials/modals/_product';
	pearl_load_vc_element('posts_list', $vars, $vars['style'], $path);
	$r['content'] = ob_get_clean();

	wp_send_json($r);
	exit;
}

add_action('wp_ajax_pearl_woo_quick_view', 'pearl_woo_quick_view');
add_action('wp_ajax_nopriv_pearl_woo_quick_view', 'pearl_woo_quick_view');

function pearl_load_products()
{
    $page = intval($_GET['page']);
    $per_page = intval($_GET['per_page']);
    $offset = $per_page * $page;

    $r = array(
        'content' => '',
        'page'    => $page + 1
    );

    $style = sanitize_text_field($_GET['style']);
    $post_type = sanitize_text_field($_GET['post_type']);

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'meta_query'     => array(
            'relation' => 'OR',
        ),
    );

    $q = new WP_Query($args);

    $total = $q->found_posts;
    if ($q->have_posts()) {
        $tpl = 'partials/content/' . $post_type . '/' . $style;
        ob_start();
        while ($q->have_posts()) {
            $q->the_post();
            get_template_part($tpl);
        }
        $r['content'] = ob_get_clean();
    }

    if ($total <= ($offset + $per_page)) {
        $r['page'] = null;
    }

    wp_reset_postdata();

    wp_send_json($r);
    exit;
}

add_action('wp_ajax_pearl_load_products', 'pearl_load_products');
add_action('wp_ajax_nopriv_pearl_load_products', 'pearl_load_products');


function pearl_update_custom_styles_admin()
{
	pearl_update_custom_styles();
}

add_action('wp_ajax_pearl_update_custom_styles_admin', 'pearl_update_custom_styles_admin');

add_filter('vc_grid_get_grid_data_access', 'pearl_vc_grid_get_grid_data_access');

function pearl_vc_grid_get_grid_data_access()
{
	return true;
}


add_action('wp_ajax_likedislike', 'pearl_like_dislike');
add_action('wp_ajax_nopriv_likedislike', 'pearl_like_dislike');

function pearl_like_dislike()
{

	$data = $_POST;
	$post_id = $data['post'];
	$like = 'pearl_likes';
	$dislike = 'pearl_dislikes';


	$like_state = $data['like'];
	$dislike_state = $data['dislike'];

	$likes = intval(get_post_meta($post_id, $like, true));
	if (empty($likes)) {
		$likes = 0;
	}
	$dislikes = intval(get_post_meta($post_id, $dislike, true));
	if (empty($dislikes)) {
		$dislikes = 0;
	}

	if ($like_state == '1') {
		$likes += 1;
		update_post_meta($post_id, $like, $likes);
	} elseif ($like_state == '-1') {
		$likes -= 1;
		update_post_meta($post_id, $like, $likes);
	}


	if ($dislike_state === '1') {
		$dislikes += 1;
		update_post_meta($post_id, $dislike, $dislikes);
	} elseif ($dislike_state === '-1') {
		$dislikes -= 1;
		update_post_meta($post_id, $dislike, $dislikes);
	}


	wp_send_json($data);
}