<?php
if (!class_exists('STM_Post_Types')) {

	add_action('init', 'pearl_init_post_types');
	function pearl_init_post_types()
	{
		new STM_Post_Types;


		if (post_type_exists('stm_donations')) {
			require_once STM_CONFIGURATIONS_PATH . '/paypal/paypal.php';
			require_once STM_CONFIGURATIONS_PATH . '/post-types/donation.class.php';
		}

		if (post_type_exists('stm_events')) {
			require_once STM_CONFIGURATIONS_PATH . '/post-types/event_participant_handler.php';
		}

		require_once STM_CONFIGURATIONS_PATH . '/post-types/shares.php';
	}

	class STM_Post_Types
	{

		function __construct()
		{
			$this->register_post_types();
		}

		function default_post_types()
		{
			$post_types = stm_post_types();

			$options = get_option('stm_theme_options');

			foreach ($post_types as $slug => $data) {
				$user_data = (!empty($options[$data['slug']])) ? $options[$data['slug']] : array();
				$user_data = empty($user_data) ? array() : $user_data;
				$post_types[$slug] = wp_parse_args(array_filter($user_data), $post_types[$slug]);
			}

			return apply_filters('stm_post_types', $post_types);
		}


		function register_post_types()
		{
			$post_types = $this->default_post_types();
			foreach ($post_types as $post_type => $args) {


				$args['enabled'] = (empty($args['enabled'])) ? 'false' : $args['enabled'];
				$public = 'true';


				if (isset($args['public'])) {
					$public = $args['public'];
				}
				$public = $public === 'true';
				$args['public'] = $public;

				if ($args['enabled'] != 'true') continue;

				$has_archive = (!empty($args['has_archive']) and $args['has_archive'] != 'false') ? true : false;

				$args['has_archive'] = $has_archive;


				/*Post Type*/
				$labels = $this->post_type_labels($args['name'], $args['plural']);


				$default_args = array(
					'labels'          => $labels,
					'public'          => true,
					'show_ui'         => true,
					'show_in_menu'    => true,
					'query_var'       => true,
					'rewrite'         => array('slug' => $args['slug']),
					'capability_type' => 'post',
					'has_archive'     => $has_archive,
					'hierarchical'    => false,
				);

				$args = wp_parse_args($args, $default_args);

				$args['slug'] = $post_type;
				register_post_type($post_type, $args);

				/*Register Taxonomy*/
				if (!empty($args['taxonomy'])) {
					$this->register_taxonomy($args['taxonomy'], $post_type);
				}

				/*If post have sub post*/
				if (!empty($args['sub_types'])) {
					foreach ($args['sub_types'] as $args) {
						$sub_type = $args;
						$sub_labels = $this->post_type_labels($sub_type['name'], $sub_type['plural']);

						$sub_args = array(
							'labels'             => $sub_labels,
							'public'             => false,
							'publicly_queryable' => false,
							'show_ui'            => true,
							'show_in_menu'       => 'edit.php?post_type=' . $post_type,
							'query_var'          => false,
							'rewrite'            => array('slug' => $sub_type['slug']),
							'capability_type'    => 'post',
							'has_archive'        => false,
							'hierarchical'       => false,
							'supports'           => $sub_type['supports']
						);

						register_post_type($sub_type['slug'], $sub_args);
					}
				}
			}
		}

		function post_type_labels($name, $plural)
		{
			$name = sanitize_text_field($name);
			$plural = sanitize_text_field($plural);
			$labels = array(
				'name'               => sprintf(__('%s', 'stm_domain'), $plural),
				'singular_name'      => sprintf(__('%s', 'stm_domain'), $name),
				'menu_name'          => sprintf(__('%s', 'stm_domain'), $plural),
				'name_admin_bar'     => sprintf(__('%s', 'stm_domain'), $name),
				'add_new'            => __('Add New', 'stm_domain'),
				'add_new_item'       => sprintf(__('Add new %s', 'stm_domain'), $name),
				'new_item'           => sprintf(__('New %s', 'stm_domain'), $name),
				'edit_item'          => sprintf(__('Edit %s', 'stm_domain'), $name),
				'view_item'          => sprintf(__('View %s', 'stm_domain'), $name),
				'all_items'          => sprintf(__('All %s', 'stm_domain'), $plural),
				'search_items'       => sprintf(__('Search %s', 'stm_domain'), $plural),
				'parent_item_colon'  => sprintf(__('Parent %s', 'stm_domain'), $plural),
				'not_found'          => sprintf(__('No %s found', 'stm_domain'), $plural),
				'not_found_in_trash' => sprintf(__('No %s found in Trash.', 'stm_domain'), $plural)
			);

			return apply_filters('stm_post_type_labels', $labels);
		}

		function register_taxonomy($taxonomy, $post_type)
		{
			$post_types = $this->default_post_types();
			$name = sprintf(esc_html__('%s category', 'stm_domain'), $post_types[$post_type]['name']);
			$plural = sprintf(esc_html__('%s categories', 'stm_domain'), $post_types[$post_type]['name']);
			$slug = $taxonomy['slug'];
			$labels = $this->taxonomy_labels($name, $plural);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
			);

			register_taxonomy($slug, $post_type, $args);
		}

		function taxonomy_labels($name, $plural)
		{
			$labels = array(
				'name'                       => sprintf(__('%s', 'stm_domain'), $plural),
				'singular_name'              => sprintf(__('%s', 'stm_domain'), $name),
				'search_items'               => sprintf(__('Search %s', 'stm_domain'), $plural),
				'popular_items'              => sprintf(__('Popular %s', 'stm_domain'), $plural),
				'all_items'                  => sprintf(__('All %s', 'stm_domain'), $plural),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => sprintf(__('Edit %s', 'stm_domain'), $name),
				'update_item'                => sprintf(__('Update %s', 'stm_domain'), $name),
				'add_new_item'               => sprintf(__('Add New %s', 'stm_domain'), $name),
				'new_item_name'              => sprintf(__('New %s Name', 'stm_domain'), $name),
				'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'stm_domain'), $plural),
				'add_or_remove_items'        => sprintf(__('Add or remove %s', 'stm_domain'), $plural),
				'choose_from_most_used'      => sprintf(__('Choose from the most used %s', 'stm_domain'), $plural),
				'not_found'                  => sprintf(__('No %s found.', 'stm_domain'), $plural),
				'menu_name'                  => sprintf(__('%s', 'stm_domain'), $plural),
			);

			return apply_filters('stm_taxonomy_labels', $labels);
		}

	}
}

function stm_post_types() {
	$post_types = array(
		'stm_projects'     => array(
			'slug'      => 'projects',
			'name'      => esc_html__('Project', 'stm_domain'),
			'plural'    => esc_html__('Projects', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'revisions'),
			'menu_icon' => 'dashicons-clipboard',
			'taxonomy'  => array(
				'slug' => 'project_category',
			),
			'enabled'   => true
		),
		'stm_events'       => array(
			'slug'      => 'events',
			'name'      => esc_html__('Event', 'stm_domain'),
			'plural'    => esc_html__('Events', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'revisions'),
			'menu_icon' => 'dashicons-groups',
			'enabled'   => true,
			'sub_types' => array(
				array(
					'slug'     => 'stm_participants',
					'name'     => esc_html__('Participant', 'stm_domain'),
					'plural'   => esc_html__('Participants', 'stm_domain'),
					'supports' => array('title'),
				),
				array(
					'slug'     => 'stm_speakers',
					'name'     => esc_html__('Speaker', 'stm_domain'),
					'plural'   => esc_html__('Speakers', 'stm_domain'),
					'supports' => array('title', 'thumbnail'),
				),
			),
			'taxonomy'  => array(
				'slug' => 'event_category',
			),
		),
		'stm_services'     => array(
			'slug'      => 'services',
			'name'      => esc_html__('Service', 'stm_domain'),
			'plural'    => esc_html__('Services', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'revisions'),
			'menu_icon' => 'dashicons-analytics',
			'taxonomy'  => array(
				'slug' => 'service_category',
			),
			'enabled'   => true
		),
		'stm_testimonials' => array(
			'slug'      => 'testimonials',
			'name'      => esc_html__('Testimonial', 'stm_domain'),
			'plural'    => esc_html__('Testimonials', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'revisions'),
			'menu_icon' => 'dashicons-format-chat',
			'enabled'   => true
		),
		'stm_stories'      => array(
			'slug'      => 'stories',
			'name'      => esc_html__('Success Story', 'stm_domain'),
			'plural'    => esc_html__('Success Stories', 'stm_domain'),
			'supports'  => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions'),
			'menu_icon' => 'dashicons-format-status',
			'enabled'   => true
		),
		'stm_sidebars'     => array(
			'slug'      => 'sidebars',
			'name'      => esc_html__('Sidebar', 'stm_domain'),
			'plural'    => esc_html__('Sidebars', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'revisions'),
			'menu_icon' => 'dashicons-layout',
			'enabled'   => true
		),
		'stm_pre_content'  => array(
			'slug'         => 'stm_pre_content',
			'name'         => esc_html__('Pre content', 'stm_domain'),
			'plural'       => esc_html__('Pre content', 'stm_domain'),
			'show_in_menu' => 'edit.php?post_type=stm_sidebars',
			'supports'     => array('title', 'editor', 'revisions'),
			'enabled'      => true
		),
		'stm_pre_footer'   => array(
			'slug'         => 'stm_pre_footer',
			'name'         => esc_html__('Pre footer', 'stm_domain'),
			'plural'       => esc_html__('Pre footer', 'stm_domain'),
			'show_in_menu' => 'edit.php?post_type=stm_sidebars',
			'supports'     => array('title', 'editor', 'revisions'),
			'enabled'      => true
		),
		'stm_vacancies'    => array(
			'slug'      => 'vacancies',
			'name'      => esc_html__('Vacancies', 'stm_domain'),
			'plural'    => esc_html__('Vacancies', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'revisions'),
			'menu_icon' => 'dashicons-id',
			'enabled'   => true
		),
		'stm_albums'       => array(
			'slug'      => 'albums',
			'name'      => esc_html__('Album', 'stm_domain'),
			'plural'    => esc_html__('Albums', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'revisions'),
			'menu_icon' => 'dashicons-format-audio',
			'taxonomy'  => array(
				'slug' => 'album_category',
			),
			'enabled'   => true
		),
		'stm_video'        => array(
			'slug'      => 'videos',
			'name'      => esc_html__('Video', 'stm_domain'),
			'plural'    => esc_html__('Videos', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'revisions'),
			'menu_icon' => 'dashicons-format-video',
			'taxonomy'  => array(
				'slug' => 'video_category',
			),
			'enabled'   => true
		),
		'stm_donations'    => array(
			'slug'      => 'donations',
			'name'      => esc_html__('Donation', 'stm_domain'),
			'plural'    => esc_html__('Donations', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'comments', 'revisions'),
			'menu_icon' => 'dashicons-groups',
			'enabled'   => true,
			'sub_types' => array(
				array(
					'slug'     => 'stm_donors',
					'name'     => esc_html__('Donor', 'stm_domain'),
					'plural'   => esc_html__('Donors', 'stm_domain'),
					'supports' => array('title'),
				),
			),
			'taxonomy'  => array(),
		),
		'stm_media_events' => array(
			'slug'      => 'stm_media_events',
			'name'      => esc_html__('Media Event', 'stm_domain'),
			'plural'    => esc_html__('Media Events', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'comments', 'revisions'),
			'menu_icon' => 'dashicons-groups',
			'enabled'   => true,
			'taxonomy'  => array(),
		),
		'stm_staff'        => array(
			'slug'      => 'stm_staff',
			'name'      => esc_html__('Staff', 'stm_domain'),
			'plural'    => esc_html__('Staff', 'stm_domain'),
			'supports'  => array('title', 'revisions', 'thumbnail', 'editor', 'excerpt'),
			'menu_icon' => 'dashicons-groups',
			'enabled'   => true,
			'public'    => true,
			'taxonomy'  => array(
				'slug' => 'staff_categories'
			),
		),
		'stm_products'     => array(
			'slug'      => 'products',
			'name'      => esc_html__('Product', 'stm_domain'),
			'plural'    => esc_html__('Products', 'stm_domain'),
			'supports'  => array('title', 'thumbnail', 'editor', 'excerpt', 'revisions'),
			'menu_icon' => 'dashicons-clipboard',
			'taxonomy'  => array(
				'slug' => 'products_category',
			),
			'enabled'   => true
		),
	);

	return $post_types;
}