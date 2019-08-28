<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/*Load butterbean framework*/
add_action('plugins_loaded', 'stm_listings_load_butterbean');

function stm_listings_load_butterbean()
{
    require_once(STM_CONFIGURATIONS_PATH . '/post-types/metaboxes/butterbean/butterbean.php');
}

function stm_listings_no_validate($value)
{
    return $value;
}

function stm_listings_validate_image($value)
{
    return !empty($value) ? intval($value) : false;
}

function pearl_validate_gallery($value)
{
    $value = explode(',', $value);
    $values = array();

    if (!empty($value)) {
        $i = 0;
        foreach ($value as $img_id) {
            $i++;
            $img_id = intval($img_id);
            if (!empty($img_id)) {
                if ($i != 1) {
                    $values[] = $img_id;
                }
            }
        }
    }

    return !empty($values) ? $values : false;
}

function stm_get_post_type($post_type) {
    $choices = array();
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $q = new WP_Query($args);
    if($q->have_posts()) {
        while($q->have_posts()) {
            $q->the_post();
            $id = get_the_ID();
            $choices[$id] = get_the_title();
        }
    }

    return apply_filters('stm_config_get_post_type', $choices);
}

function stm_listings_date($value) {
    return strtotime($value);
}

function stm_sanitize_music($value) {
	if(!empty($value) and is_array($value)) {
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		foreach ($value as $key => $song) {
			/*If something empty, remove*/
			if (empty($song['label']) or empty($song['name'])) {
				unset($value[$key]);
				continue;
			}

			/*Set audio length*/
			if (empty($value['length_formatted'])) {
				$audio_file_path = get_attached_file($song['name']);
				$meta = wp_read_audio_metadata($audio_file_path);
				if (!empty($meta['length_formatted'])) $value[$key]['length'] = $meta['length_formatted'];
			}
		}
	}

	global $post;
	$post_id = $post->ID;
	delete_transient('pearl_album_' . $post_id);

	return $value;
}

function stm_event_start_timestamp($value) {
	global $post;
	$post_id = $post->ID;
	$data = $_POST;

	if (!empty($data['butterbean_stm_default_fields_setting_date_start']) && !empty($data['butterbean_stm_default_fields_setting_date_start_time'])) {
		$date_start = $data['butterbean_stm_default_fields_setting_date_start'];
		$date_start_time = $data['butterbean_stm_default_fields_setting_date_start_time'];

		$start_date_timestamp = strtotime($date_start . ' ' . $date_start_time);
		update_post_meta($post_id, 'date_start_timestamp', $start_date_timestamp);
	}



	return $value;
}