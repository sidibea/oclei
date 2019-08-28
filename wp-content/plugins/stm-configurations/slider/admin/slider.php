<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}


require_once 'inc/screen.php';


if (!class_exists('STM_Slider_Admin')) {

	class STM_Slider_Admin
	{


		private $post_type_name = STM_SLIDER_POST_TYPE;

		private $stm_slider_meta_name = STM_SLIDER_META_NAME;

		private $stm_slider_slide_meta_name = STM_SLIDER_SLIDE_META_NAME;

		function __construct()
		{
			add_action('init', array(&$this, 'init'));
			add_action('admin_menu', array(&$this, 'add_options_page'));
			add_action('admin_enqueue_scripts', array(&$this, 'enqueue'), 100);
			add_action('wp_ajax_stm_slider_ajax', array(&$this, 'ajax_init'));
			add_action('admin_print_scripts', array(&$this, 'print_scripts'));
		}

		function init()
		{
			$this->register_post_type();
			if (isset($_GET['action']) && isset($_GET['slider_id'])) {

				$action = $_GET['action'];
				$slider_id = $_GET['slider_id'];

				switch ($action) {
					case 'duplicate':
						$slider_id = $_GET['slider_id'];
						$new_post = stm_slider_duplicate_post($slider_id);

						$slides = $this->get_slider_slides($slider_id);
						foreach ($slides as $slide) {
							stm_slider_duplicate_post($slide->ID, array('post_parent' => $new_post));
						}
						wp_redirect(STM_SLIDER_PAGE_URL);
						exit;
						break;
					case 'delete':
						$this->delete_slider($slider_id);
						wp_redirect(STM_SLIDER_PAGE_URL);
						exit;
						break;
					case 'export':
						$this->export_slider($slider_id);
						break;
				}
			}
		}

		function ajax_init()
		{
		    unset($_GET['action']);

		    if (empty($_GET)) {
				$r = json_decode(file_get_contents('php://input'), true);
			} else {
		        $r = $_GET;
            }


			if (isset($r['create']) && $r['create'] === 'slider') {
				$this->create_slider();
			} elseif (isset($r['delete'])) {
				$this->delete_slider($r['delete']);
			} elseif (isset($r['get'])) {
				switch ($r['get']) {
					case 'url' :
						$this->get_site_url();
						break;
					case 'slider' :
						$this->get_slider($r['sliderId']);
						break;
				}
			} elseif (isset($r['slider'])) {
				switch ($r['slider']) {
					case 'get' :
						$this->get_slider($r['sliderId']);
						break;
					case 'save':
						$this->save_slider($r['sliderObj']);
						break;
					case 'save_meta':
						$this->save_slider_meta($r['sliderId'], $r['sliderMeta']);
						break;
					case 'get_meta':
						$this->get_slider_meta($r['sliderId']);
						break;
					case 'add_slide':
						$this->add_slide($r['sliderId'], $r['slide']);
						break;
					case 'save_slides':
						$this->save_slider_slides($r['sliderId'], $r['slides']);
						break;
					case 'get_slides':
						$this->get_slider_slides_meta($r['sliderId']);
						break;
					case 'delete_slide':
						$this->delete_slider_slide($r['slideId']);
						break;
					case 'delete_slides':
						$this->delete_slides($r['slides']);
						break;
					case 'get_slide_posts':
						$this->get_slider_post_slides($r['keyword']);
						break;
					case 'slide_preview':
						$this->get_slide_preview($r['imageId'], $r['postId']);
						break;
				}
			}
			exit();
		}


		function print_scripts()
		{
			?>
            <script>
                var stm_slider_page_url = '<?php echo STM_SLIDER_PAGE_URL ?>';
            </script>
			<?php
		}

		function register_post_type()
		{
			register_post_type($this->post_type_name,
				array(
					'public'            => false,
					'show_in_nav_menus' => true,
					'show_in_menu'      => true,
					'labels'            => array(
						'name' => 'STM Slider'
					),
					'hierarchical'      => true,
					'menu_position'     => 25,
					'supports'          => array('title', 'thumbnail', 'editor', 'page-attributes')
				)
			);
		}


		function enqueue($hook)
		{
			if (strpos($hook, 'stm-slider-options') !== false) {
				wp_dequeue_script('wpml-tm-scripts'); //jquery versions conflict
				wp_enqueue_style('stm_slider', STM_SLIDER_URL . '/admin/assets/styles/main.css', null, STM_SLIDER_VERSION);
				wp_enqueue_style('stm_slider_vendor_css', STM_SLIDER_URL . '/admin/assets/vendor/vendor.css', null, STM_SLIDER_VERSION);
				wp_enqueue_style('stm_slider_animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', null, STM_SLIDER_VERSION);

				wp_enqueue_script('stm_slider', STM_SLIDER_URL . '/admin/assets/scripts/main.js', null, STM_SLIDER_VERSION, true);

				wp_enqueue_script('jquery-ui', STM_SLIDER_URL . '/admin/assets/vendor/jquery-ui.js', null, STM_SLIDER_VERSION, true);

				wp_enqueue_script('stm_slider_vendor_js', STM_SLIDER_URL . '/admin/assets/vendor/vendor.js', null, STM_SLIDER_VERSION, true);



				if (isset($_GET['action']) && $_GET['action'] === 'edit') {
					wp_enqueue_script('stm_slider_app', STM_SLIDER_URL . '/admin/app/app.js', null, STM_SLIDER_VERSION, true);
				}

				wp_localize_script('stm_slider_app', 'stm_slider_vars', array(
					'appPath' => STM_SLIDER_URL . '/admin/app'
				));

				if (function_exists('pearl_get_assets_path')) {
					$theme_info = pearl_get_assets_path();
					wp_enqueue_style('fontawesome', $theme_info['vendors'] . 'font-awesome.min.css', null, $theme_info['v']);

				}
			}
		}

		function add_options_page()
		{
			/*Fix for ThemeCheck*/
			add_menu_page('Slider', 'STM slider', 'administrator', 'stm-slider-options', array(&$this, 'get_view'), 'dashicons-images-alt2', '100.111111');

			/* remove duplicate menu hack */
			add_submenu_page(
				'stm-slider-options', 'All sliders', 'All sliders', 'administrator', 'stm-slider-options', '');

		}

		function get_view()
		{
			global $current_screen;


			if ($current_screen->base === 'stm-slider_page_stm-slider-sliders') {
				include(STM_SLIDER_ROOT_PATH . '/views/sliders.php');
			} elseif (isset($_GET['action']) && $_GET['action'] === 'edit') {
				include(STM_SLIDER_ROOT_PATH . '/admin/views/slider-edit.php');
			} else {
				include(STM_SLIDER_ROOT_PATH . '/admin/views/sliders.php');
			}
		}

		function create_slider()
		{
			$result = array();

			$post_array = array(
				'post_type'   => $this->post_type_name,
				'post_status' => 'publish',
				'post_title'  => 'New slider'
			);

			$post_id = wp_insert_post($post_array);

			$result['status'] = 200;
			$result['data'] = $post_id;

			if ($post_id) {
				$this->ajax_response($result);
			}
		}

		function get_slider_meta($id)
		{
			$result = get_post_meta($id, $this->stm_slider_meta_name, true);

//            $result = json_encode($result);

			wp_send_json($result);
		}

		function get_slider($id)
		{
			$post = get_post($id);

			if (!$post) {
				return;
			}

			wp_send_json($post);
		}

		function delete_slider($id)
		{

			$result = array();
			$result['status'] = 500;

			$slides = $this->get_slider_slides($id);


			$slides_delete_errors = 0;
			foreach ($slides as $slide) {

				$res = wp_delete_post($slide->ID, true);
				if (!$res) {
					$slides_delete_errors++;
				}
			}


			if (wp_delete_post($id, true) !== false && $slides_delete_errors === 0) {
				$result['status'] = 200;
			};

//			$this->ajax_response($result);
		}

		function save_slider($slider)
		{
			$title = $slider['post_title'];


			$post = array(
				'ID'         => $slider['ID'],
				'post_title' => $title
			);

			$result = wp_update_post($post, true);

			wp_send_json($result);

		}

		function save_slider_meta($id, $data)
		{
			update_post_meta($id, $this->stm_slider_meta_name, $data);
			wp_send_json($data);
		}

		function save_slider_slides($slider_id, $slides)
		{
			if (count($slides) === 1) {
				$slides[0]['order'] = 1;
			}
			foreach ($slides as $slide) {
				$this->save_slider_slide($slide, $slider_id);
			}
		}

		function add_slide($parent_id, $slide)
		{
			$order = $slide['order'];

			$slide_post = array(
				'post_parent' => $parent_id,
				'post_type'   => $this->post_type_name,
				'post_status' => 'publish',
				'menu_order'  => $order,
				'post_title'  => 'Slide ' . $order
			);

			$slide_id = wp_insert_post($slide_post);
			update_post_meta($slide_id, $this->stm_slider_slide_meta_name, $slide);


			wp_send_json($slide_id);
		}

		function save_slider_slide($slide_array = array(), $parent_id)
		{
			$order = intval($slide_array['order']);
			$slide_id = $slide_array['id'];
			$slide_post['ID'] = $slide_id;

			$slide_post = array(
				'ID'          => $slide_id,
				'post_parent' => $parent_id,
				'post_type'   => $this->post_type_name,
				'post_status' => 'publish',
				'menu_order'  => $order,
				'post_title'  => 'Slide ' . $order
			);


			wp_update_post($slide_post);

			if (!empty($slide_array)) {
				if (!empty($slide_array['data'])) {
					unset($slide_array['data']);
				}
				if (!empty($slide_array['imageId'])) {
					set_post_thumbnail($slide_id, $slide_array['imageId']);
				}

				update_post_meta($slide_id, $this->stm_slider_slide_meta_name, $slide_array);
			}
		}

		function delete_slider_slide($slide_id)
		{
			wp_send_json(wp_delete_post($slide_id));

		}

		function delete_slides($slides)
		{
			$slides = json_decode($slides);

			foreach ($slides as $slide) {
				wp_delete_post($slide);
			}
			wp_send_json('ok');
		}

		function get_slide_preview($image_id, $post_id, $size = 'full')
		{
			$url = get_the_post_thumbnail_url($post_id, $image_id, $size);
//			$url = wp_get_attachment_image_src($image_id, $size);
//			$url = (!empty($url[0])) ? $url = $url[0] : '';
			wp_send_json($url);
		}

		function get_slider_slides($id)
		{

			$args = array(
				'post_type'      => $this->post_type_name,
				'post_parent'    => $id,
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC'
			);

			$slides_posts = get_posts($args);


			return $slides_posts;


		}

		function get_slider_slides_meta($id)
		{
			$slides_posts = $this->get_slider_slides($id);

			$slider_data = array();
			foreach ($slides_posts as $i => $slides_post) {
				$meta = get_post_meta($slides_post->ID, 'stm_slider_slide_settings', true);
				if ($meta === null) {
					$meta = array();
				}
				$meta['id'] = $slides_post->ID;
				$slider_data[$i] = $meta;
			}

			wp_send_json(apply_filters('stm_slider_slide_settings', $slider_data));
		}

		function get_slider_post_slides($keyword)
		{
			$slides = array();
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => '10',
				's'              => sanitize_text_field($keyword)
			);

			$q = new WP_Query($args);
			if ($q->have_posts()) {
				while ($q->have_posts()) {
					$q->the_post();

					$slides[] = array(
						'id'   => get_the_ID(),
						'name' => get_the_title()
					);
				}
			}

			wp_send_json(apply_filters('stm_slider_post_slides', $slides));
		}

		function ajax_response($response)
		{
			wp_send_json($response);
//				echo json_encode($response);
		}

		function get_sliders()
		{

			$args = array(
				'post_type'      => $this->post_type_name,
				'posts_per_page' => -1,
				'post_status'    => ['draft', 'publish'],
				'orderBy'        => 'id',
				'order'          => 'ASC',
				'post_parent'    => 0
			);

			$q = get_posts($args);

			return $q;
		}

		function get_site_url()
		{
			echo bloginfo('url');
		}

		function export_slider($slider_id)
		{
			$slides = $this->get_slider_slides($slider_id);
			$images = array();
			$slides_data = array();

			foreach ($slides as $slide) {
				$images[] = get_the_post_thumbnail_url($slide['ID'], 'full');
				$slides_data[] = get_post_meta($slide['ID'], STM_SLIDER_SLIDE_META_NAME, true);
			}
		}

	}

}


if (defined('WPB_VC_VERSION')) {
	global $stm_slider_admin;
	$stm_slider_admin = new STM_Slider_Admin();
}

function stm_slider_duplicate_post($post_id, $args = array(), $redirect = false)
{

	$post = get_post($post_id);
	if (isset($post) && $post != null) {

		global $wpdb;

		/*
		 * new slider data array
		 */
		$default_args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $post->post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'publish',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		$args = wp_parse_args($args, $default_args);


		$new_post_id = wp_insert_post($args);


		/*
		 * get all current slider terms ad set them to the new slider draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for slider type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

		/*
		 * duplicate all slider meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos) != 0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if ($meta_key == '_wp_old_slug') continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}

		return $new_post_id;


		/*
		 * finally, redirect to the edit slider screen for the new draft
		 */
		if ($redirect) {
			wp_redirect(STM_SLIDER_PAGE_URL);
			exit;
		}
	}
}

function stm_slider_get_google_fonts_array()
{
	$gfonts = array(
		'Default'                  => array(
			'label' => 'Default',
		),
		'ABeeZee'                  => array(
			'label'    => 'ABeeZee',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Abel'                     => array(
			'label'    => 'Abel',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Abril Fatface'            => array(
			'label'    => 'Abril Fatface',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Aclonica'                 => array(
			'label'    => 'Aclonica',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Acme'                     => array(
			'label'    => 'Acme',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Actor'                    => array(
			'label'    => 'Actor',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Adamina'                  => array(
			'label'    => 'Adamina',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Advent Pro'               => array(
			'label'    => 'Advent Pro',
			'variants' => array('100', '200', '300', 'regular', '500', '600', '700',),
			'subsets'  => array('latin', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Aguafina Script'          => array(
			'label'    => 'Aguafina Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Akronim'                  => array(
			'label'    => 'Akronim',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Aladin'                   => array(
			'label'    => 'Aladin',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Aldrich'                  => array(
			'label'    => 'Aldrich',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Alef'                     => array(
			'label'    => 'Alef',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Alegreya'                 => array(
			'label'    => 'Alegreya',
			'variants' => array('regular', 'italic', '700', '700italic', '900', '900italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Alegreya SC'              => array(
			'label'    => 'Alegreya SC',
			'variants' => array('regular', 'italic', '700', '700italic', '900', '900italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Alegreya Sans'            => array(
			'label'    => 'Alegreya Sans',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic',
			),
			'subsets'  => array('vietnamese', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Alegreya Sans SC'         => array(
			'label'    => 'Alegreya Sans SC',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic',
			),
			'subsets'  => array('vietnamese', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Alex Brush'               => array(
			'label'    => 'Alex Brush',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Alfa Slab One'            => array(
			'label'    => 'Alfa Slab One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Alice'                    => array(
			'label'    => 'Alice',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Alike'                    => array(
			'label'    => 'Alike',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Alike Angular'            => array(
			'label'    => 'Alike Angular',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Allan'                    => array(
			'label'    => 'Allan',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Allerta'                  => array(
			'label'    => 'Allerta',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Allerta Stencil'          => array(
			'label'    => 'Allerta Stencil',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Allura'                   => array(
			'label'    => 'Allura',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Almendra'                 => array(
			'label'    => 'Almendra',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Almendra Display'         => array(
			'label'    => 'Almendra Display',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Almendra SC'              => array(
			'label'    => 'Almendra SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Amarante'                 => array(
			'label'    => 'Amarante',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Amaranth'                 => array(
			'label'    => 'Amaranth',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Amatic SC'                => array(
			'label'    => 'Amatic SC',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Amethysta'                => array(
			'label'    => 'Amethysta',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Anaheim'                  => array(
			'label'    => 'Anaheim',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Andada'                   => array(
			'label'    => 'Andada',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Andika'                   => array(
			'label'    => 'Andika',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Angkor'                   => array(
			'label'    => 'Angkor',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Annie Use Your Telescope' => array(
			'label'    => 'Annie Use Your Telescope',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Anonymous Pro'            => array(
			'label'    => 'Anonymous Pro',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'greek', 'latin-ext',),
			'category' => 'monospace',
		),
		'Antic'                    => array(
			'label'    => 'Antic',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Antic Didone'             => array(
			'label'    => 'Antic Didone',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Antic Slab'               => array(
			'label'    => 'Antic Slab',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Anton'                    => array(
			'label'    => 'Anton',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Arapey'                   => array(
			'label'    => 'Arapey',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Arbutus'                  => array(
			'label'    => 'Arbutus',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Arbutus Slab'             => array(
			'label'    => 'Arbutus Slab',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Architects Daughter'      => array(
			'label'    => 'Architects Daughter',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Archivo Black'            => array(
			'label'    => 'Archivo Black',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Archivo Narrow'           => array(
			'label'    => 'Archivo Narrow',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Arimo'                    => array(
			'label'    => 'Arimo',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'sans-serif',
		),
		'Arizonia'                 => array(
			'label'    => 'Arizonia',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Armata'                   => array(
			'label'    => 'Armata',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Artifika'                 => array(
			'label'    => 'Artifika',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Arvo'                     => array(
			'label'    => 'Arvo',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Asap'                     => array(
			'label'    => 'Asap',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Asset'                    => array(
			'label'    => 'Asset',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Astloch'                  => array(
			'label'    => 'Astloch',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Asul'                     => array(
			'label'    => 'Asul',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Atomic Age'               => array(
			'label'    => 'Atomic Age',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Aubrey'                   => array(
			'label'    => 'Aubrey',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Audiowide'                => array(
			'label'    => 'Audiowide',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Autour One'               => array(
			'label'    => 'Autour One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Average'                  => array(
			'label'    => 'Average',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Average Sans'             => array(
			'label'    => 'Average Sans',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Averia Gruesa Libre'      => array(
			'label'    => 'Averia Gruesa Libre',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Averia Libre'             => array(
			'label'    => 'Averia Libre',
			'variants' => array('300', '300italic', 'regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Averia Sans Libre'        => array(
			'label'    => 'Averia Sans Libre',
			'variants' => array('300', '300italic', 'regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Averia Serif Libre'       => array(
			'label'    => 'Averia Serif Libre',
			'variants' => array('300', '300italic', 'regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Bad Script'               => array(
			'label'    => 'Bad Script',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin',),
			'category' => 'handwriting',
		),
		'Balthazar'                => array(
			'label'    => 'Balthazar',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Bangers'                  => array(
			'label'    => 'Bangers',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Basic'                    => array(
			'label'    => 'Basic',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Battambang'               => array(
			'label'    => 'Battambang',
			'variants' => array('regular', '700',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Baumans'                  => array(
			'label'    => 'Baumans',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Bayon'                    => array(
			'label'    => 'Bayon',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Belgrano'                 => array(
			'label'    => 'Belgrano',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Belleza'                  => array(
			'label'    => 'Belleza',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'BenchNine'                => array(
			'label'    => 'BenchNine',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Bentham'                  => array(
			'label'    => 'Bentham',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Berkshire Swash'          => array(
			'label'    => 'Berkshire Swash',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Bevan'                    => array(
			'label'    => 'Bevan',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Bigelow Rules'            => array(
			'label'    => 'Bigelow Rules',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Bigshot One'              => array(
			'label'    => 'Bigshot One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Bilbo'                    => array(
			'label'    => 'Bilbo',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Bilbo Swash Caps'         => array(
			'label'    => 'Bilbo Swash Caps',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Bitter'                   => array(
			'label'    => 'Bitter',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Black Ops One'            => array(
			'label'    => 'Black Ops One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Bokor'                    => array(
			'label'    => 'Bokor',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Bonbon'                   => array(
			'label'    => 'Bonbon',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Boogaloo'                 => array(
			'label'    => 'Boogaloo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Bowlby One'               => array(
			'label'    => 'Bowlby One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Bowlby One SC'            => array(
			'label'    => 'Bowlby One SC',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Brawler'                  => array(
			'label'    => 'Brawler',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Bree Serif'               => array(
			'label'    => 'Bree Serif',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Bubblegum Sans'           => array(
			'label'    => 'Bubblegum Sans',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Bubbler One'              => array(
			'label'    => 'Bubbler One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Buda'                     => array(
			'label'    => 'Buda',
			'variants' => array('300',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Buenard'                  => array(
			'label'    => 'Buenard',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Butcherman'               => array(
			'label'    => 'Butcherman',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Butterfly Kids'           => array(
			'label'    => 'Butterfly Kids',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Cabin'                    => array(
			'label'    => 'Cabin',
			'variants' => array('regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Cabin Condensed'          => array(
			'label'    => 'Cabin Condensed',
			'variants' => array('regular', '500', '600', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Cabin Sketch'             => array(
			'label'    => 'Cabin Sketch',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Caesar Dressing'          => array(
			'label'    => 'Caesar Dressing',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Cagliostro'               => array(
			'label'    => 'Cagliostro',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Calligraffitti'           => array(
			'label'    => 'Calligraffitti',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Cambo'                    => array(
			'label'    => 'Cambo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Candal'                   => array(
			'label'    => 'Candal',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Cantarell'                => array(
			'label'    => 'Cantarell',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Cantata One'              => array(
			'label'    => 'Cantata One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Cantora One'              => array(
			'label'    => 'Cantora One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Capriola'                 => array(
			'label'    => 'Capriola',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Cardo'                    => array(
			'label'    => 'Cardo',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('greek-ext', 'latin', 'greek', 'latin-ext',),
			'category' => 'serif',
		),
		'Carme'                    => array(
			'label'    => 'Carme',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Carrois Gothic'           => array(
			'label'    => 'Carrois Gothic',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Carrois Gothic SC'        => array(
			'label'    => 'Carrois Gothic SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Carter One'               => array(
			'label'    => 'Carter One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Caudex'                   => array(
			'label'    => 'Caudex',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('greek-ext', 'latin', 'greek', 'latin-ext',),
			'category' => 'serif',
		),
		'Cedarville Cursive'       => array(
			'label'    => 'Cedarville Cursive',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Ceviche One'              => array(
			'label'    => 'Ceviche One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Changa One'               => array(
			'label'    => 'Changa One',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Chango'                   => array(
			'label'    => 'Chango',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Chau Philomene One'       => array(
			'label'    => 'Chau Philomene One',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Chela One'                => array(
			'label'    => 'Chela One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Chelsea Market'           => array(
			'label'    => 'Chelsea Market',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Chenla'                   => array(
			'label'    => 'Chenla',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Cherry Cream Soda'        => array(
			'label'    => 'Cherry Cream Soda',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Cherry Swash'             => array(
			'label'    => 'Cherry Swash',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Chewy'                    => array(
			'label'    => 'Chewy',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Chicle'                   => array(
			'label'    => 'Chicle',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Chivo'                    => array(
			'label'    => 'Chivo',
			'variants' => array('regular', 'italic', '900', '900italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Cinzel'                   => array(
			'label'    => 'Cinzel',
			'variants' => array('regular', '700', '900',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Cinzel Decorative'        => array(
			'label'    => 'Cinzel Decorative',
			'variants' => array('regular', '700', '900',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Clicker Script'           => array(
			'label'    => 'Clicker Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Coda'                     => array(
			'label'    => 'Coda',
			'variants' => array('regular', '800',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Coda Caption'             => array(
			'label'    => 'Coda Caption',
			'variants' => array('800',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Codystar'                 => array(
			'label'    => 'Codystar',
			'variants' => array('300', 'regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Combo'                    => array(
			'label'    => 'Combo',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Comfortaa'                => array(
			'label'    => 'Comfortaa',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'display',
		),
		'Coming Soon'              => array(
			'label'    => 'Coming Soon',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Concert One'              => array(
			'label'    => 'Concert One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Condiment'                => array(
			'label'    => 'Condiment',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Content'                  => array(
			'label'    => 'Content',
			'variants' => array('regular', '700',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Contrail One'             => array(
			'label'    => 'Contrail One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Convergence'              => array(
			'label'    => 'Convergence',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Cookie'                   => array(
			'label'    => 'Cookie',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Copse'                    => array(
			'label'    => 'Copse',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Corben'                   => array(
			'label'    => 'Corben',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Courgette'                => array(
			'label'    => 'Courgette',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Cousine'                  => array(
			'label'    => 'Cousine',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'monospace',
		),
		'Coustard'                 => array(
			'label'    => 'Coustard',
			'variants' => array('regular', '900',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Covered By Your Grace'    => array(
			'label'    => 'Covered By Your Grace',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Crafty Girls'             => array(
			'label'    => 'Crafty Girls',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Creepster'                => array(
			'label'    => 'Creepster',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Crete Round'              => array(
			'label'    => 'Crete Round',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Crimson Text'             => array(
			'label'    => 'Crimson Text',
			'variants' => array('regular', 'italic', '600', '600italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Croissant One'            => array(
			'label'    => 'Croissant One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Crushed'                  => array(
			'label'    => 'Crushed',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Cuprum'                   => array(
			'label'    => 'Cuprum',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Cutive'                   => array(
			'label'    => 'Cutive',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Cutive Mono'              => array(
			'label'    => 'Cutive Mono',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'monospace',
		),
		'Damion'                   => array(
			'label'    => 'Damion',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Dancing Script'           => array(
			'label'    => 'Dancing Script',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Dangrek'                  => array(
			'label'    => 'Dangrek',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Dawning of a New Day'     => array(
			'label'    => 'Dawning of a New Day',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Days One'                 => array(
			'label'    => 'Days One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Delius'                   => array(
			'label'    => 'Delius',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Delius Swash Caps'        => array(
			'label'    => 'Delius Swash Caps',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Delius Unicase'           => array(
			'label'    => 'Delius Unicase',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Della Respira'            => array(
			'label'    => 'Della Respira',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Denk One'                 => array(
			'label'    => 'Denk One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Devonshire'               => array(
			'label'    => 'Devonshire',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Dhurjati'                 => array(
			'label'    => 'Dhurjati',
			'variants' => array('regular',),
			'subsets'  => array('telugu', 'latin',),
			'category' => 'sans-serif',
		),
		'Didact Gothic'            => array(
			'label'    => 'Didact Gothic',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'greek-ext', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Diplomata'                => array(
			'label'    => 'Diplomata',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Diplomata SC'             => array(
			'label'    => 'Diplomata SC',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Domine'                   => array(
			'label'    => 'Domine',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Donegal One'              => array(
			'label'    => 'Donegal One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Doppio One'               => array(
			'label'    => 'Doppio One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Dorsa'                    => array(
			'label'    => 'Dorsa',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Dosis'                    => array(
			'label'    => 'Dosis',
			'variants' => array('200', '300', 'regular', '500', '600', '700', '800',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Dr Sugiyama'              => array(
			'label'    => 'Dr Sugiyama',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Droid Sans'               => array(
			'label'    => 'Droid Sans',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Droid Sans Mono'          => array(
			'label'    => 'Droid Sans Mono',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'monospace',
		),
		'Droid Serif'              => array(
			'label'    => 'Droid Serif',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Duru Sans'                => array(
			'label'    => 'Duru Sans',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Dynalight'                => array(
			'label'    => 'Dynalight',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'EB Garamond'              => array(
			'label'    => 'EB Garamond',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'vietnamese', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'serif',
		),
		'Eagle Lake'               => array(
			'label'    => 'Eagle Lake',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Eater'                    => array(
			'label'    => 'Eater',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Economica'                => array(
			'label'    => 'Economica',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Ek Mukta'                 => array(
			'label'    => 'Ek Mukta',
			'variants' => array('200', '300', 'regular', '500', '600', '700', '800',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Electrolize'              => array(
			'label'    => 'Electrolize',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Elsie'                    => array(
			'label'    => 'Elsie',
			'variants' => array('regular', '900',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Elsie Swash Caps'         => array(
			'label'    => 'Elsie Swash Caps',
			'variants' => array('regular', '900',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Emblema One'              => array(
			'label'    => 'Emblema One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Emilys Candy'             => array(
			'label'    => 'Emilys Candy',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Engagement'               => array(
			'label'    => 'Engagement',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Englebert'                => array(
			'label'    => 'Englebert',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Enriqueta'                => array(
			'label'    => 'Enriqueta',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Erica One'                => array(
			'label'    => 'Erica One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Esteban'                  => array(
			'label'    => 'Esteban',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Euphoria Script'          => array(
			'label'    => 'Euphoria Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Ewert'                    => array(
			'label'    => 'Ewert',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Exo'                      => array(
			'label'    => 'Exo',
			'variants' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic',
			),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Exo 2'                    => array(
			'label'    => 'Exo 2',
			'variants' => array(
				'100',
				'100italic',
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
				'900',
				'900italic',
			),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Expletus Sans'            => array(
			'label'    => 'Expletus Sans',
			'variants' => array('regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fanwood Text'             => array(
			'label'    => 'Fanwood Text',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Fascinate'                => array(
			'label'    => 'Fascinate',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fascinate Inline'         => array(
			'label'    => 'Fascinate Inline',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Faster One'               => array(
			'label'    => 'Faster One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fasthand'                 => array(
			'label'    => 'Fasthand',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'serif',
		),
		'Fauna One'                => array(
			'label'    => 'Fauna One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Federant'                 => array(
			'label'    => 'Federant',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Federo'                   => array(
			'label'    => 'Federo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Felipa'                   => array(
			'label'    => 'Felipa',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Fenix'                    => array(
			'label'    => 'Fenix',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Finger Paint'             => array(
			'label'    => 'Finger Paint',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fira Mono'                => array(
			'label'    => 'Fira Mono',
			'variants' => array('regular', '700',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'monospace',
		),
		'Fira Sans'                => array(
			'label'    => 'Fira Sans',
			'variants' => array('300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Fjalla One'               => array(
			'label'    => 'Fjalla One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Fjord One'                => array(
			'label'    => 'Fjord One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Flamenco'                 => array(
			'label'    => 'Flamenco',
			'variants' => array('300', 'regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Flavors'                  => array(
			'label'    => 'Flavors',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fondamento'               => array(
			'label'    => 'Fondamento',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Fontdiner Swanky'         => array(
			'label'    => 'Fontdiner Swanky',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Forum'                    => array(
			'label'    => 'Forum',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'display',
		),
		'Francois One'             => array(
			'label'    => 'Francois One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Freckle Face'             => array(
			'label'    => 'Freckle Face',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Fredericka the Great'     => array(
			'label'    => 'Fredericka the Great',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fredoka One'              => array(
			'label'    => 'Fredoka One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Freehand'                 => array(
			'label'    => 'Freehand',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Fresca'                   => array(
			'label'    => 'Fresca',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Frijole'                  => array(
			'label'    => 'Frijole',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Fruktur'                  => array(
			'label'    => 'Fruktur',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Fugaz One'                => array(
			'label'    => 'Fugaz One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'GFS Didot'                => array(
			'label'    => 'GFS Didot',
			'variants' => array('regular',),
			'subsets'  => array('greek',),
			'category' => 'serif',
		),
		'GFS Neohellenic'          => array(
			'label'    => 'GFS Neohellenic',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('greek',),
			'category' => 'sans-serif',
		),
		'Gabriela'                 => array(
			'label'    => 'Gabriela',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Gafata'                   => array(
			'label'    => 'Gafata',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Galdeano'                 => array(
			'label'    => 'Galdeano',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Galindo'                  => array(
			'label'    => 'Galindo',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Gentium Basic'            => array(
			'label'    => 'Gentium Basic',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Gentium Book Basic'       => array(
			'label'    => 'Gentium Book Basic',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Geo'                      => array(
			'label'    => 'Geo',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Geostar'                  => array(
			'label'    => 'Geostar',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Geostar Fill'             => array(
			'label'    => 'Geostar Fill',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Germania One'             => array(
			'label'    => 'Germania One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Gidugu'                   => array(
			'label'    => 'Gidugu',
			'variants' => array('regular',),
			'subsets'  => array('telugu', 'latin',),
			'category' => 'sans-serif',
		),
		'Gilda Display'            => array(
			'label'    => 'Gilda Display',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Give You Glory'           => array(
			'label'    => 'Give You Glory',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Glass Antiqua'            => array(
			'label'    => 'Glass Antiqua',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Glegoo'                   => array(
			'label'    => 'Glegoo',
			'variants' => array('regular', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Gloria Hallelujah'        => array(
			'label'    => 'Gloria Hallelujah',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Goblin One'               => array(
			'label'    => 'Goblin One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Gochi Hand'               => array(
			'label'    => 'Gochi Hand',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Gorditas'                 => array(
			'label'    => 'Gorditas',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Goudy Bookletter 1911'    => array(
			'label'    => 'Goudy Bookletter 1911',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Graduate'                 => array(
			'label'    => 'Graduate',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Grand Hotel'              => array(
			'label'    => 'Grand Hotel',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Gravitas One'             => array(
			'label'    => 'Gravitas One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Great Vibes'              => array(
			'label'    => 'Great Vibes',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Griffy'                   => array(
			'label'    => 'Griffy',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Gruppo'                   => array(
			'label'    => 'Gruppo',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Gudea'                    => array(
			'label'    => 'Gudea',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Habibi'                   => array(
			'label'    => 'Habibi',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Halant'                   => array(
			'label'    => 'Halant',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Hammersmith One'          => array(
			'label'    => 'Hammersmith One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Hanalei'                  => array(
			'label'    => 'Hanalei',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Hanalei Fill'             => array(
			'label'    => 'Hanalei Fill',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Handlee'                  => array(
			'label'    => 'Handlee',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Hanuman'                  => array(
			'label'    => 'Hanuman',
			'variants' => array('regular', '700',),
			'subsets'  => array('khmer',),
			'category' => 'serif',
		),
		'Happy Monkey'             => array(
			'label'    => 'Happy Monkey',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Headland One'             => array(
			'label'    => 'Headland One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Henny Penny'              => array(
			'label'    => 'Henny Penny',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Herr Von Muellerhoff'     => array(
			'label'    => 'Herr Von Muellerhoff',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Hind'                     => array(
			'label'    => 'Hind',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Holtwood One SC'          => array(
			'label'    => 'Holtwood One SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Homemade Apple'           => array(
			'label'    => 'Homemade Apple',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Homenaje'                 => array(
			'label'    => 'Homenaje',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'IM Fell DW Pica'          => array(
			'label'    => 'IM Fell DW Pica',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell DW Pica SC'       => array(
			'label'    => 'IM Fell DW Pica SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell Double Pica'      => array(
			'label'    => 'IM Fell Double Pica',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell Double Pica SC'   => array(
			'label'    => 'IM Fell Double Pica SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell English'          => array(
			'label'    => 'IM Fell English',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell English SC'       => array(
			'label'    => 'IM Fell English SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell French Canon'     => array(
			'label'    => 'IM Fell French Canon',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell French Canon SC'  => array(
			'label'    => 'IM Fell French Canon SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell Great Primer'     => array(
			'label'    => 'IM Fell Great Primer',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'IM Fell Great Primer SC'  => array(
			'label'    => 'IM Fell Great Primer SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Iceberg'                  => array(
			'label'    => 'Iceberg',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Iceland'                  => array(
			'label'    => 'Iceland',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Imprima'                  => array(
			'label'    => 'Imprima',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Inconsolata'              => array(
			'label'    => 'Inconsolata',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'monospace',
		),
		'Inder'                    => array(
			'label'    => 'Inder',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Indie Flower'             => array(
			'label'    => 'Indie Flower',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Inika'                    => array(
			'label'    => 'Inika',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Irish Grover'             => array(
			'label'    => 'Irish Grover',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Istok Web'                => array(
			'label'    => 'Istok Web',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Italiana'                 => array(
			'label'    => 'Italiana',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Italianno'                => array(
			'label'    => 'Italianno',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Jacques Francois'         => array(
			'label'    => 'Jacques Francois',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Jacques Francois Shadow'  => array(
			'label'    => 'Jacques Francois Shadow',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Jim Nightshade'           => array(
			'label'    => 'Jim Nightshade',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Jockey One'               => array(
			'label'    => 'Jockey One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Jolly Lodger'             => array(
			'label'    => 'Jolly Lodger',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Josefin Sans'             => array(
			'label'    => 'Josefin Sans',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
			),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Josefin Slab'             => array(
			'label'    => 'Josefin Slab',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
			),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Joti One'                 => array(
			'label'    => 'Joti One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Judson'                   => array(
			'label'    => 'Judson',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Julee'                    => array(
			'label'    => 'Julee',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Julius Sans One'          => array(
			'label'    => 'Julius Sans One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Junge'                    => array(
			'label'    => 'Junge',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Jura'                     => array(
			'label'    => 'Jura',
			'variants' => array('300', 'regular', '500', '600',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Just Another Hand'        => array(
			'label'    => 'Just Another Hand',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Just Me Again Down Here'  => array(
			'label'    => 'Just Me Again Down Here',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Kalam'                    => array(
			'label'    => 'Kalam',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Kameron'                  => array(
			'label'    => 'Kameron',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Kantumruy'                => array(
			'label'    => 'Kantumruy',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('khmer',),
			'category' => 'sans-serif',
		),
		'Karla'                    => array(
			'label'    => 'Karla',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Karma'                    => array(
			'label'    => 'Karma',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Kaushan Script'           => array(
			'label'    => 'Kaushan Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Kavoon'                   => array(
			'label'    => 'Kavoon',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Kdam Thmor'               => array(
			'label'    => 'Kdam Thmor',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Keania One'               => array(
			'label'    => 'Keania One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Kelly Slab'               => array(
			'label'    => 'Kelly Slab',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Kenia'                    => array(
			'label'    => 'Kenia',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Khand'                    => array(
			'label'    => 'Khand',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Khmer'                    => array(
			'label'    => 'Khmer',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Kite One'                 => array(
			'label'    => 'Kite One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Knewave'                  => array(
			'label'    => 'Knewave',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Kotta One'                => array(
			'label'    => 'Kotta One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Koulen'                   => array(
			'label'    => 'Koulen',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Kranky'                   => array(
			'label'    => 'Kranky',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Kreon'                    => array(
			'label'    => 'Kreon',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Kristi'                   => array(
			'label'    => 'Kristi',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Krona One'                => array(
			'label'    => 'Krona One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'La Belle Aurore'          => array(
			'label'    => 'La Belle Aurore',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Laila'                    => array(
			'label'    => 'Laila',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Lancelot'                 => array(
			'label'    => 'Lancelot',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Lato'                     => array(
			'label'    => 'Lato',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'League Script'            => array(
			'label'    => 'League Script',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Leckerli One'             => array(
			'label'    => 'Leckerli One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Ledger'                   => array(
			'label'    => 'Ledger',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Lekton'                   => array(
			'label'    => 'Lekton',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Lemon'                    => array(
			'label'    => 'Lemon',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Libre Baskerville'        => array(
			'label'    => 'Libre Baskerville',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Life Savers'              => array(
			'label'    => 'Life Savers',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Lilita One'               => array(
			'label'    => 'Lilita One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Lily Script One'          => array(
			'label'    => 'Lily Script One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Limelight'                => array(
			'label'    => 'Limelight',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Linden Hill'              => array(
			'label'    => 'Linden Hill',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Lobster'                  => array(
			'label'    => 'Lobster',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Lobster Two'              => array(
			'label'    => 'Lobster Two',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Londrina Outline'         => array(
			'label'    => 'Londrina Outline',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Londrina Shadow'          => array(
			'label'    => 'Londrina Shadow',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Londrina Sketch'          => array(
			'label'    => 'Londrina Sketch',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Londrina Solid'           => array(
			'label'    => 'Londrina Solid',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Lora'                     => array(
			'label'    => 'Lora',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Love Ya Like A Sister'    => array(
			'label'    => 'Love Ya Like A Sister',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Loved by the King'        => array(
			'label'    => 'Loved by the King',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Lovers Quarrel'           => array(
			'label'    => 'Lovers Quarrel',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Luckiest Guy'             => array(
			'label'    => 'Luckiest Guy',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Lusitana'                 => array(
			'label'    => 'Lusitana',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Lustria'                  => array(
			'label'    => 'Lustria',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Macondo'                  => array(
			'label'    => 'Macondo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Macondo Swash Caps'       => array(
			'label'    => 'Macondo Swash Caps',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Magra'                    => array(
			'label'    => 'Magra',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Maiden Orange'            => array(
			'label'    => 'Maiden Orange',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Mako'                     => array(
			'label'    => 'Mako',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Mallanna'                 => array(
			'label'    => 'Mallanna',
			'variants' => array('regular',),
			'subsets'  => array('telugu', 'latin',),
			'category' => 'sans-serif',
		),
		'Mandali'                  => array(
			'label'    => 'Mandali',
			'variants' => array('regular',),
			'subsets'  => array('telugu', 'latin',),
			'category' => 'sans-serif',
		),
		'Marcellus'                => array(
			'label'    => 'Marcellus',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Marcellus SC'             => array(
			'label'    => 'Marcellus SC',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Marck Script'             => array(
			'label'    => 'Marck Script',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Margarine'                => array(
			'label'    => 'Margarine',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Marko One'                => array(
			'label'    => 'Marko One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Marmelad'                 => array(
			'label'    => 'Marmelad',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Marvel'                   => array(
			'label'    => 'Marvel',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Mate'                     => array(
			'label'    => 'Mate',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Mate SC'                  => array(
			'label'    => 'Mate SC',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Maven Pro'                => array(
			'label'    => 'Maven Pro',
			'variants' => array('regular', '500', '700', '900',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'McLaren'                  => array(
			'label'    => 'McLaren',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Meddon'                   => array(
			'label'    => 'Meddon',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'MedievalSharp'            => array(
			'label'    => 'MedievalSharp',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Medula One'               => array(
			'label'    => 'Medula One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Megrim'                   => array(
			'label'    => 'Megrim',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Meie Script'              => array(
			'label'    => 'Meie Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Merienda'                 => array(
			'label'    => 'Merienda',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Merienda One'             => array(
			'label'    => 'Merienda One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Merriweather'             => array(
			'label'    => 'Merriweather',
			'variants' => array('300', '300italic', 'regular', 'italic', '700', '700italic', '900', '900italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Merriweather Sans'        => array(
			'label'    => 'Merriweather Sans',
			'variants' => array('300', '300italic', 'regular', 'italic', '700', '700italic', '800', '800italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Metal'                    => array(
			'label'    => 'Metal',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Metal Mania'              => array(
			'label'    => 'Metal Mania',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Metamorphous'             => array(
			'label'    => 'Metamorphous',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Metrophobic'              => array(
			'label'    => 'Metrophobic',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Michroma'                 => array(
			'label'    => 'Michroma',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Milonga'                  => array(
			'label'    => 'Milonga',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Miltonian'                => array(
			'label'    => 'Miltonian',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Miltonian Tattoo'         => array(
			'label'    => 'Miltonian Tattoo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Miniver'                  => array(
			'label'    => 'Miniver',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Miss Fajardose'           => array(
			'label'    => 'Miss Fajardose',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Modern Antiqua'           => array(
			'label'    => 'Modern Antiqua',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Molengo'                  => array(
			'label'    => 'Molengo',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Molle'                    => array(
			'label'    => 'Molle',
			'variants' => array('italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Monda'                    => array(
			'label'    => 'Monda',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Monofett'                 => array(
			'label'    => 'Monofett',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Monoton'                  => array(
			'label'    => 'Monoton',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Monsieur La Doulaise'     => array(
			'label'    => 'Monsieur La Doulaise',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Montaga'                  => array(
			'label'    => 'Montaga',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Montez'                   => array(
			'label'    => 'Montez',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Montserrat'               => array(
			'label'    => 'Montserrat',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Montserrat Alternates'    => array(
			'label'    => 'Montserrat Alternates',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Montserrat Subrayada'     => array(
			'label'    => 'Montserrat Subrayada',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Moul'                     => array(
			'label'    => 'Moul',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Moulpali'                 => array(
			'label'    => 'Moulpali',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Mountains of Christmas'   => array(
			'label'    => 'Mountains of Christmas',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Mouse Memoirs'            => array(
			'label'    => 'Mouse Memoirs',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Mr Bedfort'               => array(
			'label'    => 'Mr Bedfort',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Mr Dafoe'                 => array(
			'label'    => 'Mr Dafoe',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Mr De Haviland'           => array(
			'label'    => 'Mr De Haviland',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Mrs Saint Delafield'      => array(
			'label'    => 'Mrs Saint Delafield',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Mrs Sheppards'            => array(
			'label'    => 'Mrs Sheppards',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Muli'                     => array(
			'label'    => 'Muli',
			'variants' => array('300', '300italic', 'regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Mystery Quest'            => array(
			'label'    => 'Mystery Quest',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'NTR'                      => array(
			'label'    => 'NTR',
			'variants' => array('regular',),
			'subsets'  => array('telugu', 'latin',),
			'category' => 'sans-serif',
		),
		'Neucha'                   => array(
			'label'    => 'Neucha',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin',),
			'category' => 'handwriting',
		),
		'Neuton'                   => array(
			'label'    => 'Neuton',
			'variants' => array('200', '300', 'regular', 'italic', '700', '800',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'New Rocker'               => array(
			'label'    => 'New Rocker',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'News Cycle'               => array(
			'label'    => 'News Cycle',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Niconne'                  => array(
			'label'    => 'Niconne',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Nixie One'                => array(
			'label'    => 'Nixie One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nobile'                   => array(
			'label'    => 'Nobile',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Nokora'                   => array(
			'label'    => 'Nokora',
			'variants' => array('regular', '700',),
			'subsets'  => array('khmer',),
			'category' => 'serif',
		),
		'Norican'                  => array(
			'label'    => 'Norican',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Nosifer'                  => array(
			'label'    => 'Nosifer',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Nothing You Could Do'     => array(
			'label'    => 'Nothing You Could Do',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Noticia Text'             => array(
			'label'    => 'Noticia Text',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('vietnamese', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Noto Sans'                => array(
			'label'    => 'Noto Sans',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array(
				'cyrillic',
				'devanagari',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'sans-serif',
		),
		'Noto Serif'               => array(
			'label'    => 'Noto Serif',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'serif',
		),
		'Nova Cut'                 => array(
			'label'    => 'Nova Cut',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nova Flat'                => array(
			'label'    => 'Nova Flat',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nova Mono'                => array(
			'label'    => 'Nova Mono',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'greek',),
			'category' => 'monospace',
		),
		'Nova Oval'                => array(
			'label'    => 'Nova Oval',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nova Round'               => array(
			'label'    => 'Nova Round',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nova Script'              => array(
			'label'    => 'Nova Script',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nova Slim'                => array(
			'label'    => 'Nova Slim',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Nova Square'              => array(
			'label'    => 'Nova Square',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Numans'                   => array(
			'label'    => 'Numans',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Nunito'                   => array(
			'label'    => 'Nunito',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Odor Mean Chey'           => array(
			'label'    => 'Odor Mean Chey',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Offside'                  => array(
			'label'    => 'Offside',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Old Standard TT'          => array(
			'label'    => 'Old Standard TT',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Oldenburg'                => array(
			'label'    => 'Oldenburg',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Oleo Script'              => array(
			'label'    => 'Oleo Script',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Oleo Script Swash Caps'   => array(
			'label'    => 'Oleo Script Swash Caps',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Open Sans'                => array(
			'label'    => 'Open Sans',
			'variants' => array(
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
			),
			'subsets'  => array(
				'cyrillic',
				'devanagari',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'sans-serif',
		),
		'Open Sans Condensed'      => array(
			'label'    => 'Open Sans Condensed',
			'variants' => array('300', '300italic', '700',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'sans-serif',
		),
		'Oranienbaum'              => array(
			'label'    => 'Oranienbaum',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'serif',
		),
		'Orbitron'                 => array(
			'label'    => 'Orbitron',
			'variants' => array('regular', '500', '700', '900',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Oregano'                  => array(
			'label'    => 'Oregano',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Orienta'                  => array(
			'label'    => 'Orienta',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Original Surfer'          => array(
			'label'    => 'Original Surfer',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Oswald'                   => array(
			'label'    => 'Oswald',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Over the Rainbow'         => array(
			'label'    => 'Over the Rainbow',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Overlock'                 => array(
			'label'    => 'Overlock',
			'variants' => array('regular', 'italic', '700', '700italic', '900', '900italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Overlock SC'              => array(
			'label'    => 'Overlock SC',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Ovo'                      => array(
			'label'    => 'Ovo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Oxygen'                   => array(
			'label'    => 'Oxygen',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Oxygen Mono'              => array(
			'label'    => 'Oxygen Mono',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'monospace',
		),
		'PT Mono'                  => array(
			'label'    => 'PT Mono',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'monospace',
		),
		'PT Sans'                  => array(
			'label'    => 'PT Sans',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'PT Sans Caption'          => array(
			'label'    => 'PT Sans Caption',
			'variants' => array('regular', '700',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'PT Sans Narrow'           => array(
			'label'    => 'PT Sans Narrow',
			'variants' => array('regular', '700',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'PT Serif'                 => array(
			'label'    => 'PT Serif',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'serif',
		),
		'PT Serif Caption'         => array(
			'label'    => 'PT Serif Caption',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'latin-ext',),
			'category' => 'serif',
		),
		'Pacifico'                 => array(
			'label'    => 'Pacifico',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Paprika'                  => array(
			'label'    => 'Paprika',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Parisienne'               => array(
			'label'    => 'Parisienne',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Passero One'              => array(
			'label'    => 'Passero One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Passion One'              => array(
			'label'    => 'Passion One',
			'variants' => array('regular', '700', '900',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Pathway Gothic One'       => array(
			'label'    => 'Pathway Gothic One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Patrick Hand'             => array(
			'label'    => 'Patrick Hand',
			'variants' => array('regular',),
			'subsets'  => array('vietnamese', 'latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Patrick Hand SC'          => array(
			'label'    => 'Patrick Hand SC',
			'variants' => array('regular',),
			'subsets'  => array('vietnamese', 'latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Patua One'                => array(
			'label'    => 'Patua One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Paytone One'              => array(
			'label'    => 'Paytone One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Peralta'                  => array(
			'label'    => 'Peralta',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Permanent Marker'         => array(
			'label'    => 'Permanent Marker',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Petit Formal Script'      => array(
			'label'    => 'Petit Formal Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Petrona'                  => array(
			'label'    => 'Petrona',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Philosopher'              => array(
			'label'    => 'Philosopher',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin',),
			'category' => 'sans-serif',
		),
		'Piedra'                   => array(
			'label'    => 'Piedra',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Pinyon Script'            => array(
			'label'    => 'Pinyon Script',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Pirata One'               => array(
			'label'    => 'Pirata One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Plaster'                  => array(
			'label'    => 'Plaster',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Play'                     => array(
			'label'    => 'Play',
			'variants' => array('regular', '700',),
			'subsets'  => array('cyrillic', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Playball'                 => array(
			'label'    => 'Playball',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Playfair Display'         => array(
			'label'    => 'Playfair Display',
			'variants' => array('regular', 'italic', '700', '700italic', '900', '900italic',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Playfair Display SC'      => array(
			'label'    => 'Playfair Display SC',
			'variants' => array('regular', 'italic', '700', '700italic', '900', '900italic',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Podkova'                  => array(
			'label'    => 'Podkova',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Poiret One'               => array(
			'label'    => 'Poiret One',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Poller One'               => array(
			'label'    => 'Poller One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Poly'                     => array(
			'label'    => 'Poly',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Pompiere'                 => array(
			'label'    => 'Pompiere',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Pontano Sans'             => array(
			'label'    => 'Pontano Sans',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Port Lligat Sans'         => array(
			'label'    => 'Port Lligat Sans',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Port Lligat Slab'         => array(
			'label'    => 'Port Lligat Slab',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Prata'                    => array(
			'label'    => 'Prata',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Preahvihear'              => array(
			'label'    => 'Preahvihear',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Press Start 2P'           => array(
			'label'    => 'Press Start 2P',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'greek', 'latin-ext',),
			'category' => 'display',
		),
		'Princess Sofia'           => array(
			'label'    => 'Princess Sofia',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Prociono'                 => array(
			'label'    => 'Prociono',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Prosto One'               => array(
			'label'    => 'Prosto One',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Puritan'                  => array(
			'label'    => 'Puritan',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Purple Purse'             => array(
			'label'    => 'Purple Purse',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Quando'                   => array(
			'label'    => 'Quando',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Quantico'                 => array(
			'label'    => 'Quantico',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Quattrocento'             => array(
			'label'    => 'Quattrocento',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Quattrocento Sans'        => array(
			'label'    => 'Quattrocento Sans',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Questrial'                => array(
			'label'    => 'Questrial',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Quicksand'                => array(
			'label'    => 'Quicksand',
			'variants' => array('300', 'regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Quintessential'           => array(
			'label'    => 'Quintessential',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Qwigley'                  => array(
			'label'    => 'Qwigley',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Racing Sans One'          => array(
			'label'    => 'Racing Sans One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Radley'                   => array(
			'label'    => 'Radley',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Rajdhani'                 => array(
			'label'    => 'Rajdhani',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Raleway'                  => array(
			'label'    => 'Raleway',
			'variants' => array('100', '200', '300', 'regular', '500', '600', '700', '800', '900',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Raleway Dots'             => array(
			'label'    => 'Raleway Dots',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Ramabhadra'               => array(
			'label'    => 'Ramabhadra',
			'variants' => array('regular',),
			'subsets'  => array('telugu', 'latin',),
			'category' => 'sans-serif',
		),
		'Rambla'                   => array(
			'label'    => 'Rambla',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Rammetto One'             => array(
			'label'    => 'Rammetto One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Ranchers'                 => array(
			'label'    => 'Ranchers',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Rancho'                   => array(
			'label'    => 'Rancho',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Rationale'                => array(
			'label'    => 'Rationale',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Redressed'                => array(
			'label'    => 'Redressed',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Reenie Beanie'            => array(
			'label'    => 'Reenie Beanie',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Revalia'                  => array(
			'label'    => 'Revalia',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Ribeye'                   => array(
			'label'    => 'Ribeye',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Ribeye Marrow'            => array(
			'label'    => 'Ribeye Marrow',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Righteous'                => array(
			'label'    => 'Righteous',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Risque'                   => array(
			'label'    => 'Risque',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Roboto'                   => array(
			'label'    => 'Roboto',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'sans-serif',
		),
		'Roboto Condensed'         => array(
			'label'    => 'Roboto Condensed',
			'variants' => array('300', '300italic', 'regular', 'italic', '700', '700italic',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'sans-serif',
		),
		'Roboto Slab'              => array(
			'label'    => 'Roboto Slab',
			'variants' => array('100', '300', 'regular', '700',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'serif',
		),
		'Rochester'                => array(
			'label'    => 'Rochester',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Rock Salt'                => array(
			'label'    => 'Rock Salt',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Rokkitt'                  => array(
			'label'    => 'Rokkitt',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Romanesco'                => array(
			'label'    => 'Romanesco',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Ropa Sans'                => array(
			'label'    => 'Ropa Sans',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Rosario'                  => array(
			'label'    => 'Rosario',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Rosarivo'                 => array(
			'label'    => 'Rosarivo',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Rouge Script'             => array(
			'label'    => 'Rouge Script',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Rozha One'                => array(
			'label'    => 'Rozha One',
			'variants' => array('regular',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Rubik Mono One'           => array(
			'label'    => 'Rubik Mono One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Rubik'                    => array(
			'label'    => 'Rubik One',
			'variants' => array('300, 400, 700, 900',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Ruda'                     => array(
			'label'    => 'Ruda',
			'variants' => array('regular', '700', '900',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Rufina'                   => array(
			'label'    => 'Rufina',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Ruge Boogie'              => array(
			'label'    => 'Ruge Boogie',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Ruluko'                   => array(
			'label'    => 'Ruluko',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Rum Raisin'               => array(
			'label'    => 'Rum Raisin',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Ruslan Display'           => array(
			'label'    => 'Ruslan Display',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Russo One'                => array(
			'label'    => 'Russo One',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Ruthie'                   => array(
			'label'    => 'Ruthie',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Rye'                      => array(
			'label'    => 'Rye',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sacramento'               => array(
			'label'    => 'Sacramento',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Sail'                     => array(
			'label'    => 'Sail',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Salsa'                    => array(
			'label'    => 'Salsa',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Sanchez'                  => array(
			'label'    => 'Sanchez',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Sancreek'                 => array(
			'label'    => 'Sancreek',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sansita One'              => array(
			'label'    => 'Sansita One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Sarina'                   => array(
			'label'    => 'Sarina',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sarpanch'                 => array(
			'label'    => 'Sarpanch',
			'variants' => array('regular', '500', '600', '700', '800', '900',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Satisfy'                  => array(
			'label'    => 'Satisfy',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Scada'                    => array(
			'label'    => 'Scada',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Schoolbell'               => array(
			'label'    => 'Schoolbell',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Seaweed Script'           => array(
			'label'    => 'Seaweed Script',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sevillana'                => array(
			'label'    => 'Sevillana',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Seymour One'              => array(
			'label'    => 'Seymour One',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Shadows Into Light'       => array(
			'label'    => 'Shadows Into Light',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Shadows Into Light Two'   => array(
			'label'    => 'Shadows Into Light Two',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Shanti'                   => array(
			'label'    => 'Shanti',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Share'                    => array(
			'label'    => 'Share',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Share Tech'               => array(
			'label'    => 'Share Tech',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Share Tech Mono'          => array(
			'label'    => 'Share Tech Mono',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'monospace',
		),
		'Shojumaru'                => array(
			'label'    => 'Shojumaru',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Short Stack'              => array(
			'label'    => 'Short Stack',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Siemreap'                 => array(
			'label'    => 'Siemreap',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Sigmar One'               => array(
			'label'    => 'Sigmar One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Signika'                  => array(
			'label'    => 'Signika',
			'variants' => array('300', 'regular', '600', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Signika Negative'         => array(
			'label'    => 'Signika Negative',
			'variants' => array('300', 'regular', '600', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Simonetta'                => array(
			'label'    => 'Simonetta',
			'variants' => array('regular', 'italic', '900', '900italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sintony'                  => array(
			'label'    => 'Sintony',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Sirin Stencil'            => array(
			'label'    => 'Sirin Stencil',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Six Caps'                 => array(
			'label'    => 'Six Caps',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Skranji'                  => array(
			'label'    => 'Skranji',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Slabo 13px'               => array(
			'label'    => 'Slabo 13px',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Slabo 27px'               => array(
			'label'    => 'Slabo 27px',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Slackey'                  => array(
			'label'    => 'Slackey',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Smokum'                   => array(
			'label'    => 'Smokum',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Smythe'                   => array(
			'label'    => 'Smythe',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Sniglet'                  => array(
			'label'    => 'Sniglet',
			'variants' => array('regular', '800',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Snippet'                  => array(
			'label'    => 'Snippet',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Snowburst One'            => array(
			'label'    => 'Snowburst One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sofadi One'               => array(
			'label'    => 'Sofadi One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Sofia'                    => array(
			'label'    => 'Sofia',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Sonsie One'               => array(
			'label'    => 'Sonsie One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Sorts Mill Goudy'         => array(
			'label'    => 'Sorts Mill Goudy',
			'variants' => array('regular', 'italic',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Source Code Pro'          => array(
			'label'    => 'Source Code Pro',
			'variants' => array('200', '300', 'regular', '500', '600', '700', '900',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'monospace',
		),
		'Source Sans Pro'          => array(
			'label'    => 'Source Sans Pro',
			'variants' => array(
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets'  => array('vietnamese', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Source Serif Pro'         => array(
			'label'    => 'Source Serif Pro',
			'variants' => array('regular', '600', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Special Elite'            => array(
			'label'    => 'Special Elite',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Spicy Rice'               => array(
			'label'    => 'Spicy Rice',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Spinnaker'                => array(
			'label'    => 'Spinnaker',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Spirax'                   => array(
			'label'    => 'Spirax',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Squada One'               => array(
			'label'    => 'Squada One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Stalemate'                => array(
			'label'    => 'Stalemate',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'handwriting',
		),
		'Stalinist One'            => array(
			'label'    => 'Stalinist One',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Stardos Stencil'          => array(
			'label'    => 'Stardos Stencil',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Stint Ultra Condensed'    => array(
			'label'    => 'Stint Ultra Condensed',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Stint Ultra Expanded'     => array(
			'label'    => 'Stint Ultra Expanded',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Stoke'                    => array(
			'label'    => 'Stoke',
			'variants' => array('300', 'regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Strait'                   => array(
			'label'    => 'Strait',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Sue Ellen Francisco'      => array(
			'label'    => 'Sue Ellen Francisco',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Sunshiney'                => array(
			'label'    => 'Sunshiney',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Supermercado One'         => array(
			'label'    => 'Supermercado One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Suwannaphum'              => array(
			'label'    => 'Suwannaphum',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Swanky and Moo Moo'       => array(
			'label'    => 'Swanky and Moo Moo',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Syncopate'                => array(
			'label'    => 'Syncopate',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Tangerine'                => array(
			'label'    => 'Tangerine',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Taprom'                   => array(
			'label'    => 'Taprom',
			'variants' => array('regular',),
			'subsets'  => array('khmer',),
			'category' => 'display',
		),
		'Tauri'                    => array(
			'label'    => 'Tauri',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Teko'                     => array(
			'label'    => 'Teko',
			'variants' => array('300', 'regular', '500', '600', '700',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Telex'                    => array(
			'label'    => 'Telex',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Tenor Sans'               => array(
			'label'    => 'Tenor Sans',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Text Me One'              => array(
			'label'    => 'Text Me One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'The Girl Next Door'       => array(
			'label'    => 'The Girl Next Door',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Tienne'                   => array(
			'label'    => 'Tienne',
			'variants' => array('regular', '700', '900',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Tinos'                    => array(
			'label'    => 'Tinos',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array(
				'cyrillic',
				'vietnamese',
				'greek-ext',
				'latin',
				'cyrillic-ext',
				'greek',
				'latin-ext',
			),
			'category' => 'serif',
		),
		'Titan One'                => array(
			'label'    => 'Titan One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Titillium Web'            => array(
			'label'    => 'Titillium Web',
			'variants' => array(
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'900',
			),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Trade Winds'              => array(
			'label'    => 'Trade Winds',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Trocchi'                  => array(
			'label'    => 'Trocchi',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Trochut'                  => array(
			'label'    => 'Trochut',
			'variants' => array('regular', 'italic', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Trykker'                  => array(
			'label'    => 'Trykker',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Tulpen One'               => array(
			'label'    => 'Tulpen One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Ubuntu'                   => array(
			'label'    => 'Ubuntu',
			'variants' => array('300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'greek-ext', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Ubuntu Condensed'         => array(
			'label'    => 'Ubuntu Condensed',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'greek-ext', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Ubuntu Mono'              => array(
			'label'    => 'Ubuntu Mono',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('cyrillic', 'greek-ext', 'latin', 'cyrillic-ext', 'greek', 'latin-ext',),
			'category' => 'monospace',
		),
		'Ultra'                    => array(
			'label'    => 'Ultra',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Uncial Antiqua'           => array(
			'label'    => 'Uncial Antiqua',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Underdog'                 => array(
			'label'    => 'Underdog',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Unica One'                => array(
			'label'    => 'Unica One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'UnifrakturCook'           => array(
			'label'    => 'UnifrakturCook',
			'variants' => array('700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'UnifrakturMaguntia'       => array(
			'label'    => 'UnifrakturMaguntia',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Unkempt'                  => array(
			'label'    => 'Unkempt',
			'variants' => array('regular', '700',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Unlock'                   => array(
			'label'    => 'Unlock',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Unna'                     => array(
			'label'    => 'Unna',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'VT323'                    => array(
			'label'    => 'VT323',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'monospace',
		),
		'Vampiro One'              => array(
			'label'    => 'Vampiro One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Varela'                   => array(
			'label'    => 'Varela',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Varela Round'             => array(
			'label'    => 'Varela Round',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Vast Shadow'              => array(
			'label'    => 'Vast Shadow',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Vesper Libre'             => array(
			'label'    => 'Vesper Libre',
			'variants' => array('regular', '500', '700', '900',),
			'subsets'  => array('devanagari', 'latin', 'latin-ext',),
			'category' => 'serif',
		),
		'Vibur'                    => array(
			'label'    => 'Vibur',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Vidaloka'                 => array(
			'label'    => 'Vidaloka',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Viga'                     => array(
			'label'    => 'Viga',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Voces'                    => array(
			'label'    => 'Voces',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Volkhov'                  => array(
			'label'    => 'Volkhov',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Vollkorn'                 => array(
			'label'    => 'Vollkorn',
			'variants' => array('regular', 'italic', '700', '700italic',),
			'subsets'  => array('latin',),
			'category' => 'serif',
		),
		'Voltaire'                 => array(
			'label'    => 'Voltaire',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Waiting for the Sunrise'  => array(
			'label'    => 'Waiting for the Sunrise',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Wallpoet'                 => array(
			'label'    => 'Wallpoet',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'display',
		),
		'Walter Turncoat'          => array(
			'label'    => 'Walter Turncoat',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Warnes'                   => array(
			'label'    => 'Warnes',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Wellfleet'                => array(
			'label'    => 'Wellfleet',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'display',
		),
		'Wendy One'                => array(
			'label'    => 'Wendy One',
			'variants' => array('regular',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Wire One'                 => array(
			'label'    => 'Wire One',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'sans-serif',
		),
		'Yanone Kaffeesatz'        => array(
			'label'    => 'Yanone Kaffeesatz',
			'variants' => array('200', '300', 'regular', '700',),
			'subsets'  => array('latin', 'latin-ext',),
			'category' => 'sans-serif',
		),
		'Yellowtail'               => array(
			'label'    => 'Yellowtail',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Yeseva One'               => array(
			'label'    => 'Yeseva One',
			'variants' => array('regular',),
			'subsets'  => array('cyrillic', 'latin', 'latin-ext',),
			'category' => 'display',
		),
		'Yesteryear'               => array(
			'label'    => 'Yesteryear',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
		'Zeyada'                   => array(
			'label'    => 'Zeyada',
			'variants' => array('regular',),
			'subsets'  => array('latin',),
			'category' => 'handwriting',
		),
	);

	return apply_filters('stm_slider_google_fonts_array', $gfonts);
}
