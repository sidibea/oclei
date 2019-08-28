<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once STM_CONFIGURATIONS_PATH . '/post-types/metaboxes/butterbean_helpers.php';

$metaboxes_path = STM_CONFIGURATIONS_PATH . '/post-types/metaboxes/fields/';
$metaboxes_tabs = STM_CONFIGURATIONS_PATH . '/post-types/metaboxes/tabs/';
/*Testimonials options*/
require_once $metaboxes_path . 'page.php';
require_once $metaboxes_path . 'sidebar.php';

/*Parts*/
require_once $metaboxes_tabs . 'post.php';
require_once $metaboxes_tabs . 'testimonials.php';
require_once $metaboxes_tabs . 'page_sidebar.php';
require_once $metaboxes_tabs . 'vacancies.php';
require_once $metaboxes_tabs . 'title_box.php';
require_once $metaboxes_tabs . 'project.php';
require_once $metaboxes_tabs . 'page_options.php';
require_once $metaboxes_tabs . 'events.php';
require_once $metaboxes_tabs . 'stories.php';
require_once $metaboxes_tabs . 'services.php';
require_once $metaboxes_tabs . 'participant.php';
require_once $metaboxes_tabs . 'speaker.php';
require_once $metaboxes_tabs . 'music.php';
require_once $metaboxes_tabs . 'video.php';
require_once $metaboxes_tabs . 'donations.php';
require_once $metaboxes_tabs . 'media_events.php';
require_once $metaboxes_tabs . 'staff.php';
require_once $metaboxes_tabs . 'stats.php';
require_once $metaboxes_tabs . 'products.php';
require_once $metaboxes_tabs . 'products_info.php';

require_once $metaboxes_tabs . 'product.php';