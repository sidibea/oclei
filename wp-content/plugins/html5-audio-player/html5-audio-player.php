<?php 
/*
 * Plugin Name: Html5 Audio Player
 * Plugin URI:  http://abuhayatpolash.com/plugins/html5-audio-player/
 * Description: You can easily integrate html5 audio player in your wordress website using this plugin.
 * Version: 1.1
 * Author: Abu Hayat Polash
 * Author URI: http://abuhayatpolash.com
 * License: GPLv3
 */


 
 //Script and style
function h5ap_style_and_scripts() {
    wp_enqueue_style( 'h5ap-style', plugin_dir_url( __FILE__ ) . 'style/player-style.css' );
    wp_enqueue_script( 'h5ap-script', plugin_dir_url( __FILE__ ) . 'js/plyr.js' , '1.1', true );
}
add_action( 'wp_enqueue_scripts', 'h5ap_style_and_scripts' );

/*Some Set-up*/
define('H5AP_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' ); 

//Remove post update massage and link 
function h5ap_updated_messages( $messages ) {
    $messages['audioplayer'][1] = __('Player updated ');
    return $messages;
}
add_filter('post_updated_messages','h5ap_updated_messages');
 

 

/* Register Custom Post Types */
     
            add_action( 'init', 'h5ap_create_post_type' );
            function h5ap_create_post_type() {
                    register_post_type( 'audioplayer',
                            array(
                                    'labels' => array(
                                            'name' => __( 'Html5 audio player'),
                                            'singular_name' => __( 'Audio player' ),
                                            'add_new' => __( 'Add Audio Player' ),
                                            'add_new_item' => __( 'Add New Player' ),
                                            'edit_item' => __( 'Edit Player' ),
                                            'new_item' => __( 'New Player' ),
                                            'view_item' => __( 'View Player' ),
											'search_items'       => __( 'Search Player'),
                                            'not_found' => __( 'Sorry, we couldn\'t find the Player you are looking for.' )
                                    ),
                            'public' => false,
							'show_ui' => true, 									
                            'publicly_queryable' => true,
                            'exclude_from_search' => true,
                            'menu_position' => 14,
							'menu_icon' =>H5AP_PLUGIN_DIR .'img/icn.png',
                            'has_archive' => false,
                            'hierarchical' => false,
                            'capability_type' => 'page',
                            'rewrite' => array( 'slug' => 'audioplayer' ),
                            'supports' => array( 'title' )
                            )
                    );
            }	
			
/*-------------------------------------------------------------------------------*/
/*   CMB2 + OTHER INC
/*-------------------------------------------------------------------------------*/			
include_once('cmb2/init.php');
include_once('cmb2/example-functions.php');
// include_once('inc/freeplugins.php');

/*-------------------------------------------------------------------------------*/
/*   Hide & Disabled View, Quick Edit and Preview Button
/*-------------------------------------------------------------------------------*/
function h5ap_remove_row_actions( $idtions ) {
	global $post;
    if( $post->post_type == 'audioplayer' ) {
		unset( $idtions['view'] );
		unset( $idtions['inline hide-if-no-js'] );
	}
    return $idtions;
}
if ( is_admin() ) {
	add_filter( 'post_row_actions','h5ap_remove_row_actions', 10, 2 );}

// HIDE everything in PUBLISH metabox except Move to Trash & PUBLISH button
function h5ap_hide_publishing_actions(){
        $my_post_type = 'audioplayer';
        global $post;
        if($post->post_type == $my_post_type){
            echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                </style>
            ';
        }
}
add_action('admin_head-post.php', 'h5ap_hide_publishing_actions');
add_action('admin_head-post-new.php', 'h5ap_hide_publishing_actions');	

// change publish button to save.
add_filter( 'gettext', 'h5ap_change_publish_button', 10, 2 );

function h5ap_change_publish_button( $translation, $text ) {
if ( 'audioplayer' == get_post_type())
if ( $text == 'Publish' )
    return 'Save';

return $translation;
}

//Lets register our shortcode
function h5ap_cpt_content_func($atts){
	extract( shortcode_atts( array(

		'id' => null,

	), $atts ) );

?>
<?php ob_start(); ?>
<div style="<?php if(empty(get_post_meta($id,'_ahp_audio-size', true))){echo "width:100%";}else {echo get_post_meta($id,'_ahp_audio-size', true);};?>">
<audio class="player" crossorigin playsinline controls <?php $status1= get_post_meta($id,'_ahp_audio-repeat', true); if ($status1=="loop"){echo "loop";}else{ echo "";}?> <?php $stutas= get_post_meta($id,'_ahp_audio-autoplay', true); if ($stutas=="on"){echo"autoplay";}?> <?php $stutas= get_post_meta($id,'_ahp_audio-muted', true); if ($stutas=="on"){echo"muted";} ?> >
  
  <source src="<?php echo get_post_meta($id,'_ahp_audio-file', true);?>"  type="audio/mp3"  >
  
Your browser does not support the audio element.
</audio>
</div>

<script type="text/javascript">


const players<?php echo $id;?> = Plyr.setup('.player', {
	controls:['play', 'progress', 'duration', 'mute', 'volume','download']
});
</script>
<?php  $output = ob_get_clean();return $output;//print $output; // debug ?>
<?php
}
add_shortcode('player','h5ap_cpt_content_func');

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {
	add_meta_box(
		'myplugin',
		__( 'Support Html5 Audio Player', 'myplugin_textdomain' ),
		'callback_2',
		'audioplayer',
		'normal',
		'high'
	);	

	add_meta_box(
		'myplugin_sectionid',
		__( 'Please show some love', 'myplugin_textdomain' ),
		'follow_me_callback',
		'audioplayer',
		'side'
	);	
	add_meta_box(
		'myplugin_upwork',
		__( 'Boost Your Business', 'myplugin_textdomain' ),
		'upwork_callback',
		'audioplayer',
		'side'
	);	
	add_meta_box(
		'myplugin1',
		__( 'Get Plugin Customization Service', 'myplugin_textdomain' ),
		'callback',
		'audioplayer',
		'side'
	);	
	
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );
function upwork_callback( ) {echo'<a href="https://goo.gl/v4cte1"><img width="100%" src="'.H5AP_PLUGIN_DIR.'/img/seo.png" ></a>';};

function follow_me_callback( ) {echo'

<p>If you like <strong>Html5 Audio Player</strong> Plugin, please leave us a <a href="https://wordpress.org/support/plugin/html5-audio-player/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733; rating</a> . Your Review is very important to us as it helps us to grow more.</p>

<p>Not happy, Sorry for that. You can request for improvement. </p>

<table>
	<tr>
		<td><a class="button button-primary button-large" href="https://wordpress.org/support/plugin/html5-audio-player/reviews/?filter=5#new-post" target="_blank">Write Review</a></td>
		<td><a class="button button-primary button-large" href="mailto:abuhayat.du@gmail.com" target="_blank">Request Improvement</a></td>
	</tr>
</table>

'; };

function callback( ) {include_once('inc/custom-offer.php');};
function callback_2( ) {echo'<p>It is hard to continue development and support for this plugin without contributions from users like you. If you enjoy using the plugin and find it useful, please consider support by  <b>DONATION</b> or <b>BUY THE PRO VERSION (No ads)</b> of the Plugin. Your support will help encourage and support the plugins continued development and better user support.</p>
<center>
<a target="_blank" href="https://gum.co/wpdonate"><div><img width="200" src="'.H5AP_PLUGIN_DIR.'img/donation.png'.'" alt="Donate Now" /></div></a>
</center>	

<br />

<script src="https://gumroad.com/js/gumroad-embed.js"></script>
<div class="gumroad-product-embed" data-gumroad-product-id="dkbMR" data-outbound-embed="true"><a target="_blank" href="https://gumroad.com/l/dkbMR">Loading...</a></div>
	
'
	;};

// ONLY MOVIE CUSTOM TYPE POSTS
add_filter('manage_audioplayer_posts_columns', 'ST4_columns_head_only_audioplayer', 10);
add_action('manage_audioplayer_posts_custom_column', 'ST4_columns_content_only_audioplayer', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function ST4_columns_head_only_audioplayer($defaults) {
    $defaults['directors_name'] = 'ShortCode';
    return $defaults;
}
function ST4_columns_content_only_audioplayer($column_name, $post_ID) {
    if ($column_name == 'directors_name') {
        // show content of 'directors_name' column
		echo '<input onClick="this.select();" value="[player id='. $post_ID . ']" >';
    }
}



//----------------------Dashboard widget--------------------------------

function h5ap_add_dashboard_widgets() {
 	wp_add_dashboard_widget( 'example_dashboard_widget', 'Support html5 Audio Player', 'h5ap_dashboard_widget_function' );
 
 	global $wp_meta_boxes;
 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
 	$example_widget_backup = array( 'example_dashboard_widget' => $normal_dashboard['example_dashboard_widget'] );
 	unset( $normal_dashboard['example_dashboard_widget'] );
	$sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
} 

function h5ap_dashboard_widget_function() {

	// Display whatever it is you want to show.
	echo '<div class="uds-box" data-id="1"></div>';
	echo '<p>It is hard to continue development and support for this plugin without contributions from users like you. If you enjoy using the plugin and find it useful, please consider support by <b>DONATION</b> Or <b>BUY THE PRO VERSION (NO ADS)</b> of the Plugin. Your support will help encourage and support the plugin’s continued development and better user support.</p>
	
<center>
<a target="_blank" href="https://gum.co/wpdonate"><div><img width="200" src="'.H5AP_PLUGIN_DIR.'img/donation.png'.'" alt="Donate Now" /></div></a>
</center>	
	
<br />
<script src="https://gumroad.com/js/gumroad-embed.js"></script>
<div class="gumroad-product-embed" data-gumroad-product-id="dkbMR" data-outbound-embed="true"><a target="_blank" href="https://gumroad.com/l/dkbMR">Loading...</a></div>

';}
add_action( 'wp_dashboard_setup', 'h5ap_add_dashboard_widgets' );


//sub menu
add_action('admin_menu', 'h5ap_custom_submenu_page');

function h5ap_custom_submenu_page() {
	add_submenu_page( 'edit.php?post_type=audioplayer', 'Developer', 'Developer', 'manage_options', 'h5ap-developer', 'h5ap_submenu_page_callback' );
}

function h5ap_submenu_page_callback() {
	
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>Developer</h2>
		<h2>Md Abu hayat polash</h2>
		<h3>Professional Web Developer</h3>
		<h5>Hire Me : <a href="http://fiverr.com/abuhayat">www.fiverr.com/abuhayat</h5></a>
		Email: <a href="mailto:abuhayat.du@gmail.com">abuhayat.du@gmail.com </a>
		<h5>Skype: ah_polash</h5>
		<h5>Web : <a target="_blank" href="http://abuhayatpolash.com">www.abuhayatpolash.com</a></h5>
		<br />
		
		';
	echo '</div>';

}
// Footer Review Request 

	add_filter( 'admin_footer_text','h5ap_admin_footer');	 
	function h5ap_admin_footer( $text ) {
		if ( 'audioplayer' == get_post_type() ) {
			$url = 'https://wordpress.org/support/plugin/html5-audio-player/reviews/?filter=5#new-post';
			$text = sprintf( __( 'If you like <strong>Html5 Audio Player</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'h5ap-domain' ), $url );
		}

		return $text;
	}