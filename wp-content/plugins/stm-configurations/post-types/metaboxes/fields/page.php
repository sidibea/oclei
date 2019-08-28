<?php
add_action('butterbean_register', 'stm_page_register_manager', 10, 2);

function stm_page_register_manager($butterbean, $post_type)
{
    $default = array(
        'page',
        'post',
        'stm_testimonials',
        'stm_vacancies',
        'stm_projects',
        'stm_services',
        'stm_events',
        'stm_stories',
		'stm_albums',
		'stm_video',
		'stm_donations',
		'stm_media_events',
		'stm_staff',
		'stm_products',
		'product'
    );

    if(!in_array($post_type, $default)) return;

    $butterbean->register_manager(
        'stm_default_fields',
        array(
            'label' => esc_html__('STM View settings', 'stm_domain'),
            'post_type' => $default,
            'context' => 'normal',
            'priority' => 'high'
        )
    );

    $manager = $butterbean->get_manager('stm_default_fields');

    /*Register tabs for different post types*/
    /*Some of tabs are global for all post types like title box*/

    if($post_type == 'stm_projects') {
        pearl_register_projects_box($manager);
    }

    if($post_type == 'stm_vacancies') {
        pearl_register_vacancies_metabox($manager);
    }

    if($post_type == 'stm_testimonials') {
        pearl_register_testimonials_metabox($manager);
    }

    if($post_type == 'stm_services') {
        pearl_register_services_metabox($manager);
    }

    if($post_type == 'stm_stories') {
        pearl_register_stories_metabox($manager);
    }

	if($post_type == 'stm_albums') {
		pearl_register_music_metabox($manager);
	}

	if($post_type == 'stm_video') {
		pearl_register_video_metabox($manager);
	}

    if($post_type == 'stm_events') {
        pearl_register_events_metabox($manager);
    }

    if($post_type == 'stm_donations') {
    	pearl_register_donations_metabox($manager);
	}

	if($post_type == 'stm_media_events') {
		pearl_register_media_event_metabox($manager);
	}

	if($post_type == 'stm_staff') {
		pearl_register_staff_metabox($manager);
	}

	if($post_type == 'stm_products') {
        pearl_register_products_info_metabox($manager);
        pearl_register_products_metabox($manager);
	}

    if($post_type == 'product') {
        pearl_register_product_metabox($manager);
    }

    pearl_register_title_box_metabox($manager, $post_type);
	pearl_register_page_options_metabox($manager);

	if($post_type == 'post') {
		pearl_register_post_box($manager);
		pearl_register_stats_metabox($manager);
	}

	if($post_type == 'page') {
        pearl_register_page_sidebar_metabox($manager);
    }
}