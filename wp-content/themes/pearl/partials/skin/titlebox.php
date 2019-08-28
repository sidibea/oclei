<?php
add_action('wp_enqueue_scripts', 'pearl_titlebox_styles', 100);
function pearl_titlebox_styles()
{
	$post = get_queried_object();
	$id = (!empty($post->ID)) ? $post->ID : '';
	/*If is shop*/
	$id = (pearl_is_shop() or pearl_is_account_page()) ? pearl_shop_page_id() : $id;

	$settings = pearl_title_box_settings($id);
	$title_box_css = '';

	if(!empty($settings["page_title_box_bg_image"])):
		$title_box_css .= '.stm_titlebox {
				background-image: url(' . esc_url(pearl_get_image_url($settings["page_title_box_bg_image"])) . ');
		}';
	endif;

	if(!empty($settings["page_title_box_bg_color"])) :
        $title_box_css .= '.stm_titlebox:after {
            background-color: ' . pearl_color_treads(esc_attr($settings["page_title_box_bg_color"])) . ';
        }';
	endif;

	if(!empty($settings["page_title_box_text_color"])):
		$title_box_css .=
		'.stm_titlebox .stm_titlebox__title,
        .stm_titlebox .stm_titlebox__author,
        .stm_titlebox .stm_titlebox__categories
        {
            color:  ' . pearl_color_treads($settings["page_title_box_text_color"]) . ' !important;
        }';
	endif;

	if(!empty($settings["page_title_box_subtitle_color"])):
		$title_box_css .= '.stm_titlebox .stm_titlebox__subtitle {
            color: ' . pearl_color_treads($settings["page_title_box_subtitle_color"]) . ';
        }';
	endif;

	if(!empty($settings["page_title_box_line_color"])):
		$title_box_css .= '.stm_titlebox .stm_titlebox__inner .stm_separator {
            background-color: ' . pearl_color_treads($settings['page_title_box_line_color']) . ' !important;
        }';
	endif;

	if (!empty($settings['page_title_box_bg_pos'])) {
		$title_box_css .= '.stm_titlebox {
	        background-position: ' . $settings['page_title_box_bg_pos'] . ';
	    }';
	}

	if(!empty($title_box_css)) wp_add_inline_style('pearl-theme-styles', $title_box_css);
}