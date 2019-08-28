<?php

if (!empty($_GET['export'])) {

	$post_data = array();

	$current = $_GET['export'];

	if($current === 'sidebar') {
		$args = array(
			'post_type' => 'stm_sidebars',
			'posts_per_page' => -1,
		);
		$cf7s = new WP_Query($args);

		echo '$pearl_sidebars = array();';
		echo '<br/>';

		while($cf7s->have_posts()) {
			$cf7s->the_post();
			$id = get_the_ID();

			echo '$pearl_sidebars[' . $id . '] = ';
			var_export(htmlentities(get_the_content()));
			echo ';';
			echo '<br/>';

		}

		die;
	}

	if($current === 'contact') {
		$args = array(
			'post_type' => 'wpcf7_contact_form',
			'posts_per_page' => -1,
		);
		$cf7s = new WP_Query($args);

		echo '<?php $pearl_cf7 = array();';

		while($cf7s->have_posts()) {
			$cf7s->the_post();
			$id = get_the_ID();
			$form = get_post_meta($id, '_form', true);
			echo '$pearl_cf7[' . $id . '] = \''.$form.'\';';
		}

		die;
	}

	$layouts = array(
		'business'  => array(1713, 1974, 2322, 2340, 1895, 2109, 2041, 2132, 1985, 2221, 2220, 2270, 2296, 2184, 2366, 2383),
		'construction'  => array(15, 997, 2, 1023, 1038, 1051, 1067, 1087, 1108, 1149, 1301, 245, 229, 350, 1351, 1350, 1348, 1175),
		'logistics' => array(9, 316, 884, 960, 933, 931, 469, 592, 715, 418, 772, 491, 500, 529, 979),
		'beauty' => array(5, 1036, 1109, 1068, 1080, 1089, 1102, 1158, 1168, 591, 566, 1219, 1233, 1235, 1017, 1386, 1293),
		'healthcoach' => array(2, 1886, 1923, 1922, 743, 1948, 1947, 1960, 1860, 1971),
		'medicall' => array(22, 1162, 1345, 1327, 1352, 1367, 1161, 1417, 1422, 1436, 1452, 1455, 1478, 1518),
		'charity' => array(5, 756, 918, 807, 819, 274, 841, 388, 869, 1006),
		'music' => array(2, 115, 832, 22, 1026, 882, 1051, 900, 1017, 976),
		'restaurant' => array(4, 3976, 4078, 4024, 4092, 4124, 4220, 4259),
		'rental' => array(2, 681, 1079, 697, 848, 765, 474, 586 ),
		'portfolio' => array(11, 107, 113, 130, 119, 117, 118, 145, 171, 190, 255 ),
		'church' => array(6, 2505, 2619, 2653, 2637, 2667, 2200, 2708, 2760, 2710, 2761, 2758, 2708, 2754, 2802, 2821, 2721, 2676),
		'store' => array(8, 18, 730, 643),
		'personal_blog' => array(5, 102, 117, 3412, 3518, 3491, 3505, 3536, 145, ),
	);

	foreach ($layouts as $layout => $post_ids) {

		if ($layout !== $current) continue;

		echo '$pearl_page_' . $layout . ' = array();';

		foreach ($post_ids as $post_id) {

			$post = get_post($post_id);
			$post_meta = get_post_meta($post_id);

			if(empty($post->post_content)) continue;

			$post_data['content'] = htmlentities($post->post_content);
			//$post_data['content'] = 'content';
			$post_data['meta'] = $post_meta;
			//$post_data['meta'] = 'meta';

			$post_title = sanitize_title(get_the_title($post_id));
			echo '<br/>';
			echo '$pearl_page_' . $layout . '["' . $post_title . '"] = ';
			var_export($post_data);
			echo ';';
		}
	}

	die;

}