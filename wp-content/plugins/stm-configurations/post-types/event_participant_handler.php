<?php

//CREATE EVENT PARTICIPANT
add_action('wp_ajax_pearl_event_participant', 'pearl_event_participant');
add_action('wp_ajax_nopriv_pearl_event_participant', 'pearl_event_participant');
function pearl_event_participant() {
	$r = array(
		'errors' => array(),
		'message' => '',
		'status' => ''
	);

	$name = $email = $phone = $company = $id = '';

	if(empty(intval($_POST['id']))) {
		die();
	} else {
		$r['id'] = $id = intval($_POST['id']);
	}

	$event_date = get_post_meta($id, 'date_start', true);

	if(isset($_POST['name']) and !empty($_POST['name'])){
		$name = sanitize_text_field($_POST['name']);
		unset($r['errors']['name']);
	} else {
		$r['errors']['name'] = true;
		$r['message'] = esc_html__('Please enter your name', 'stm-configurations');
	}

	if(isset($_POST['email']) and !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
		$email = sanitize_email($_POST['email']);
		unset($r['errors']['email']);
	} else {
		$r['errors']['email'] = true;
		$r['message'] = esc_html__('Please enter your email', 'stm-configurations');
	}

	if(!empty($_POST['phone'])) $phone = sanitize_text_field($_POST['phone']);
	if(!empty($_POST['company'])) $company = sanitize_text_field($_POST['company']);

	if(empty($r['errors'])) {
		if (isset($_POST['agreement'])) {
			unset($r['errors']['agreement']);
		} else {
			$r['errors']['agreement'] = true;
			$r['message'] = esc_html__('Please accept Terms and Conditions', 'stm-configurations');
		}
	}

	$r['errors'] = apply_filters('stm_event_participation_validation', $r['errors']);

	if(empty($r['errors'])) {
		$participant = array(
			'post_type' => 'stm_participants',
			'post_title'    => wp_strip_all_tags( $name ),
			'post_status'   => 'publish',
			'post_author'   => 1,
		);

		$participant_id = wp_insert_post($participant);
		//$participant_id = 2238;
		if(!empty($email)) {
			update_post_meta($participant_id, 'email', $email);
		}

		if(!empty($phone)) {
			update_post_meta($participant_id, 'phone', $phone);
		}

		if(!empty($company)) {
			update_post_meta($participant_id, 'company', $company);
		}

		$count = get_post_meta($id, 'cur_participants', true);
		if(empty($count)) $count = 0;
		$count++;
		update_post_meta($id, 'cur_participants', intval($count));
		$r['count'] = intval($count);

		/*Send notification to admin*/
		/*Create email*/
		$body = esc_html__('%s joined the event - %s', 'stm-configurations');
		$to = pearl_get_admin_email();
		$subject = esc_html__('New participant', 'stm-configurations');
		$body = sprintf($body, $name, get_the_title($id));
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail( $to, $subject, $body, $headers );

		/*Send notification to user*/
		$body = esc_html__('You have joined the event - %s', 'stm-configurations');
		$to = $email;
		$subject = esc_html__('You have joined the event', 'stm-configurations');
		$body = sprintf($body, get_the_title($id));
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail( $to, $subject, $body, $headers );

		$date_start = get_post_meta($id, 'date_start', true);
		if(!empty($date_start)) {
			$args = array($id, $email, get_the_title($id), $date_start);
			wp_schedule_single_event(
				strtotime('-1 day', $date_start),
				'pearl_notify_user',
				$args
			);
		}

		$r['message'] = esc_html__('You have joined the event', 'stm-configurations');
		$r['status'] = 'success';
	}

	wp_send_json($r);
	exit;
}

add_action('pearl_notify_user', 'pearl_notify_user_function', 10, 4);

function pearl_notify_user_function($id, $email, $title) {
	$body = esc_html__('Event %s you joined will start in a day', 'stm-configurations');
	$to = $email;
	$subject = esc_html__('Event will start soon!', 'stm-configurations');
	$body = sprintf($body, $title);
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail( $to, $subject, $body, $headers );
}