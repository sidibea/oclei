<?php
function stm_get_layout_options($layout)
{
	$options = call_user_func('stm_theme_options_' . $layout);
	$options = json_decode($options, true);
	$options['show_page_title'] = 'false';
	return $options;
}

function stm_theme_options_business()
{
	$json = '{"post_layout":"1","post_sidebar":"2317","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"2317","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#ea3a60","secondary_color":"#ea3a60","third_color":"#23282d","copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>","copyright_co":"true","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-linkedin","url":"https:\/\/www.linkedin.com\/"},{"social":"fa fa-google-plus","url":"https:\/\/www.google.com\/"},{"social":"fa fa-twitter","url":"twitter.com"},{"social":"fa fa-facebook","url":"fb.com"}],"footer_bg":"#30353a","footer_bg_image":"","footer_color":"#fff","footer_cols":"2","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_3","forms_global_style":"style_3","pagination_style":"style_3","sidebars_global_style":"style_1","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"2658","divider_api_1":"","enable_ajax":"false","ga":"","google_api_key":"","logo":"3651","preloader":"false","preloader_color":"#ea3a60","site_padding":"0","site_width":"1140","page_title_box":"true","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#ff3c65","bottom_bar_link_colorhover":"#ff3c65","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:384","data":{"url":"","uselogo":"true","width":"224"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"3418"}],"right":[{"$$hashKey":"object:1206","data":{"id":"2","line":"line_bottom","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","0"],"type":"menu"},{"$$hashKey":"object:237","disabled":{"default":"","mobile":"","tablet":""},"label":"Cart","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","1"],"type":"cart"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"52","header_color":"rgba(41, 55, 66, 0.8)","header_text_color":"#ffffff","header_text_color_hover":"#ff3c65","header_top":"52","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"header_sticky":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"true","top_bar_bg":"","top_bar_bottom":"25","top_bar_color":"#222222","top_bar_link_color_hover":"#ff3c65","top_bar_text_color":"#ffffff","top_bar_top":"25","page_bc":"true","page_bc_fullwidth":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"20","stm_donations_amount_3":"30","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"2234","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"right","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false","public":"true"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"false"},"stm_services_layout":"grid_1","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_stories_layout":"1","stm_stories_sidebar_single":"2234","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"right","stories":{"enabled":"false"},"testimonials":{"enabled":"false"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"true"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","product_sidebar":"2691","product_sidebar_position":"right","blockquote_style":"style_3","body_font":{"color":"#222222","fw":"400","ln":"24","ls":"","mgb":"","name":"Open Sans","size":"14"},"h1_settings":{"color":"","fw":"600","ln":"42","ls":"1","mgb":"","name":"","size":"36"},"h2_settings":{"color":"","fw":"600","ln":"36","ls":"2","mgb":"","name":"","size":"30"},"h3_settings":{"color":"","fw":"600","ln":"28","ls":"2","mgb":"","name":"","size":"22"},"h4_settings":{"color":"","fw":"600","ln":"26","ls":"1.5","mgb":"","name":"","size":"20"},"h5_settings":{"color":"","fw":"600","ln":"","ls":"1.2","mgb":"","name":"","size":"15"},"h6_settings":{"color":"","fw":"600","ln":"","ls":"1","mgb":"","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#23282d","name":"Montserrat","subset":""},"link_color":"#ff3c65","link_hover_color":"#ff3c65","list_style":"style_1","p_line_height":"25","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_construction()
{
	$json = '{
  "post_layout": "3",
  "post_sidebar": "969",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "true",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "default",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "true",
  "main_color": "#dac725",
  "secondary_color": "rgb(218, 199, 37)",
  "third_color": "#333333",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "false",
  "copyright_year": "false",
  "footer_bottom_bg": "",
  "right_text": "",
  "footer_socials": [
    {
      "social": "fa fa-facebook",
      "url": "fb.com"
    },
    {
      "social": "fa fa-twitter",
      "url": "twitter.com"
    },
    {
      "social": "fa fa-instagram",
      "url": "instagram.com"
    }
  ],
  "footer_bg": "#3d3d3d",
  "footer_bg_image": "187",
  "footer_color": "#fff",
  "footer_cols": "4",
  "accordions_style": "style_1",
  "buttons_global_style": "style_1",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_1",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1150",
  "google_api_key": "",
  "favicon": "",
  "logo": "4",
  "logo_transparent": "",
  "logo_width": "",
  "pagination_style": "style_1",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#dac725",
  "sidebars_global_style": "style_2",
  "tabs_style": "style_1",
  "page_title_box": "true",
  "page_title_box_align": "left",
  "page_title_box_bg_color": "rgba(1, 1, 1, 0)",
  "page_title_box_bg_image": "",
  "page_title_box_line_color": "#ffffff",
  "page_title_box_override": "false",
  "page_title_box_style": "style_1",
  "page_title_box_subtitle": "Subtitle Text",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#333333",
  "page_title_box_title": "",
  "page_title_box_title_size": "h2",
  "page_title_breadcrumbs": "false",
  "page_title_button": "true",
  "page_title_button_text": "Get in touch",
  "page_title_button_url": "\/construction\/contact-us",
  "tour_style": "style_1",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "NaN",
  "bottom_bar_color": "rgba(1, 0, 0, 0)",
  "bottom_bar_link_colorhover": "#dac725",
  "bottom_bar_text_color": "#dac725",
  "bottom_bar_top": "NaN",
  "header_builder": {
    "center": {
      "center": [
        {
          "$$hashKey": "object:866",
          "data": {
            "description": "Free call",
            "icon": "stmicon-bb_phone",
            "id": "2",
            "line": "line_top",
            "style": "fullwidth",
            "title": "212 386 5575"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "margins": {
            "default": {
              "left": "0",
              "right": "0"
            }
          },
          "order": {
            "mobile": "2200",
            "tablet": "2200"
          },
          "position": [
            "center",
            "center",
            "0"
          ],
          "type": "menu"
        }
      ]
    },
    "top": {
      "left": [
        {
          "$$hashKey": "object:637",
          "data": {
            "uselogo": "true",
            "width": "226"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Image",
          "order": {
            "mobile": "1100",
            "tablet": "1100"
          },
          "position": [
            "top",
            "left",
            "0"
          ],
          "type": "image"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:617",
          "data": {
            "description": "New York, NY 10018 US.",
            "icon": "stmicon-bb_pin",
            "title": "1010 Avenue of the Moon"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "order": {
            "mobile": "1310",
            "tablet": "1310"
          },
          "position": [
            "top",
            "right",
            "0"
          ],
          "type": "iconbox"
        },
        {
          "$$hashKey": "object:927",
          "data": {
            "description": "Sunday CLOSED",
            "icon": "stmicon-bb_clock",
            "title": "Mon - Sat 8.00 - 18.00"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "margins": {
            "default": {
              "left": "33"
            }
          },
          "order": {
            "mobile": "1310",
            "tablet": "1310"
          },
          "position": [
            "top",
            "right",
            "1"
          ],
          "type": "iconbox"
        },
        {
          "$$hashKey": "object:1385",
          "data": {
            "size": "icon_24px",
            "style": "icon_only"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Socials",
          "margins": {
            "default": {
              "left": "80"
            }
          },
          "order": {
            "mobile": "1099",
            "tablet": "1300"
          },
          "position": [
            "top",
            "right",
            "2"
          ],
          "type": "socials"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "NaN",
  "header_color": "rgba(255, 0, 0, 0)",
  "header_text_color": "rgb(255, 255, 255)",
  "header_text_color_hover": "#dac725",
  "header_top": "20",
  "header_socials": [
    {
      "social": "fa fa-facebook",
      "url": "fb.com"
    },
    {
      "social": "fa fa-twitter",
      "url": "twitter.com"
    },
    {
      "social": "fa fa-instagram",
      "url": "instagram.com"
    }
  ],
  "main_header_offset": "true",
  "main_header_style": "style_2",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "17",
  "top_bar_color": "#ffffff",
  "top_bar_link_color_hover": "#dac725",
  "top_bar_text_color": "#333333",
  "top_bar_top": "39",
  "page_bc": "false",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "1367",
  "error_page_style": "style_2",
  "albums": {
    "enabled": "false"
  },
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "false"
  },
  "stm_events_layout": "left",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "default",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "left",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "true",
    "has_archive": "false",
    "name": "Project",
    "plural": "Projects",
    "slug": "projects"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "1339",
  "stm_projects_sidebar_single_mobile": "show",
  "stm_projects_sidebar_single_position": "right",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "true",
    "has_archive": "false",
    "slug": "services"
  },
  "stm_services_layout": "left",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "1360",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "right",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "testimonials": {
    "enabled": "true",
    "has_archive": "false",
    "name": "Testimonial",
    "plural": "Testimonials",
    "slug": "testimonial"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "Contact Us",
  "stm_vacancies_button_url": "\/construction\/contact-us",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "1",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "982",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "vacancies": {
    "enabled": "true"
  },
  "stories": {
    "enabled": "false"
  },
  "donations": {
    "enabled": "false"
  },
  "videos": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_items": "3",
  "product_sidebar": "default",
  "product_sidebar_position": "left",
  "blockquote_style": "style_1",
  "body_font": {
    "color": "#777777",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "Roboto",
    "size": ""
  },
  "h1_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "52"
  },
  "h2_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "30"
  },
  "h3_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "22"
  },
  "h4_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "16"
  },
  "h5_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "14"
  },
  "h6_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "13"
  },
  "headings_line": "true",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "#333333",
    "name": "Roboto",
    "subset": ""
  },
  "link_color": "#222222",
  "link_hover_color": "#dac725",
  "list_style": "style_1",
  "p_line_height": "22",
  "p_margin_bottom": "15"
}';
	return $json;
}

function stm_theme_options_healthcoach()
{
	$json = '{
  "post_layout": "5",
  "post_sidebar": "1879",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "false",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "1879",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "true",
  "main_color": "#74c000",
  "secondary_color": "#ff6445",
  "third_color": "#192227",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "true",
  "copyright_socials": "false",
  "copyright_year": "true",
  "footer_bottom_bg": "#252d32",
  "right_text": "Build muscle in StylemixThemes",
  "footer_socials": [
    {
      "social": "fa fa-twitter",
      "url": "twitter.com"
    },
    {
      "social": "fa fa-facebook",
      "url": "fb.com"
    },
    {
      "social": "fa fa-instagram",
      "url": "#"
    }
  ],
  "footer_bg": "#192227",
  "footer_bg_image": "1873",
  "footer_color": "#fff",
  "footer_cols": "4",
  "accordions_style": "style_5",
  "buttons_global_style": "style_5",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_5",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1140",
  "google_api_key": "",
  "favicon": "",
  "logo": "6",
  "logo_transparent": "",
  "logo_width": "192",
  "pagination_style": "style_5",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#74c000",
  "sidebars_global_style": "style_5",
  "tabs_style": "style_4",
  "page_title_box": "true",
  "page_title_box_align": "center",
  "page_title_box_bg_color": "rgba(255, 255, 255, 0)",
  "page_title_box_bg_image": "1716",
  "page_title_box_line_color": "#ffffff",
  "page_title_box_override": "false",
  "page_title_box_style": "style_5",
  "page_title_box_subtitle": "",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h1",
  "page_title_breadcrumbs": "false",
  "page_title_button": "false",
  "page_title_button_text": "Button",
  "page_title_button_url": "#",
  "tour_style": "style_3",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "15",
  "bottom_bar_color": "#297ee8",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#ffffff",
  "bottom_bar_top": "15",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:407",
          "data": {
            "url": "",
            "uselogo": "true",
            "width": "193"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": "disabled"
          },
          "label": "Image",
          "margins": {
            "default": {
              "top": ""
            }
          },
          "order": {
            "mobile": "1200",
            "tablet": "2196"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image",
          "value": "6"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1404",
          "data": {
            "id": "2",
            "line": "",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "order": {
            "mobile": "2310",
            "tablet": "2310"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        },
        {
          "$$hashKey": "object:1221",
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Search",
          "margins": {
            "default": {
              "left": "47"
            },
            "mobile": {
              "left": "0"
            },
            "tablet": {
              "left": "0"
            }
          },
          "order": {
            "mobile": "2310",
            "tablet": "2310"
          },
          "position": [
            "center",
            "right",
            "1"
          ],
          "type": "search",
          "value": "style_1"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "1898",
  "header_bg_fill": "full",
  "header_bottom": "32",
  "header_color": "rgba(254, 255, 255, 0.95)",
  "header_text_color": "#192227",
  "header_text_color_hover": "#74c000",
  "header_top": "32",
  "header_socials": [
    {
      "social": "fa fa-twitter",
      "url": "Twitter.com"
    },
    {
      "social": "fa fa-facebook",
      "url": "facebook.me"
    },
    {
      "social": "fa fa-vk",
      "url": "vk.com"
    },
    {
      "social": "fa fa-instagram",
      "url": "insta.gg"
    }
  ],
  "main_header_offset": "false",
  "main_header_style": "style_5",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "NaN",
  "top_bar_color": "#222222",
  "top_bar_link_color_hover": "#f00",
  "top_bar_text_color": "#ffffff",
  "top_bar_top": "NaN",
  "page_bc": "true",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "2064",
  "error_page_style": "style_3",
  "albums": {
    "enabled": "false"
  },
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "donations": {
    "enabled": "false"
  },
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "true",
    "has_archive": "false"
  },
  "stm_events_layout": "2",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "false",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "right",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "true",
    "has_archive": "false",
    "name": "Case",
    "plural": "Cases",
    "slug": "cases"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "2393",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "right",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "true",
    "has_archive": "false"
  },
  "stm_services_layout": "4",
  "stm_services_sidebar": "false",
  "stm_services_sidebar_position": "right",
  "stm_services_sidebar_single": "false",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "left",
  "stm_stories_layout": "1",
  "stm_stories_sidebar_single": "1879",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "right",
  "stories": {
    "enabled": "true",
    "has_archive": "false",
    "slug": "stories-2"
  },
  "testimonials": {
    "enabled": "true"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "Contact Us",
  "stm_vacancies_button_url": "\/contact",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "3",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "default",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "vacancies": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "videos": {
    "enabled": "false"
  },
  "shop_items": "3",
  "product_sidebar": "default",
  "product_sidebar_position": "left",
  "blockquote_style": "style_5",
  "body_font": {
    "color": "#888888",
    "fw": "400",
    "ln": "30",
    "ls": "",
    "mgb": "",
    "name": "Source Sans Pro",
    "size": "16"
  },
  "h1_settings": {
    "color": "",
    "fw": "700",
    "ln": "",
    "ls": "1",
    "mgb": "",
    "name": "",
    "size": "60"
  },
  "h2_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "0.2",
    "mgb": "",
    "name": "Lobster Two",
    "size": "42"
  },
  "h3_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "0.3",
    "mgb": "",
    "name": "",
    "size": "36"
  },
  "h4_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "30"
  },
  "h5_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "24"
  },
  "h6_settings": {
    "color": "",
    "fw": "900",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "18"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "#192227",
    "name": "Lobster Two",
    "subset": ""
  },
  "link_color": "#74c000",
  "link_hover_color": "#ff6445",
  "list_style": "style_5",
  "p_line_height": "30",
  "p_margin_bottom": "25"
}';
	return $json;
}

function stm_theme_options_medicall()
{
	$json = '{
  "post_layout": "6",
  "post_sidebar": "1381",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "false",
  "post_comments": "true",
  "post_image": "false",
  "post_info": "false",
  "post_share": "true",
  "post_sidebar_single": "1390",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "false",
  "main_color": "#04a5dd",
  "secondary_color": "#6cdf66",
  "third_color": "#333333",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "false",
  "copyright_year": "false",
  "footer_bottom_bg": "",
  "right_text": "",
  "footer_socials": [
    {
      "social": "fa fa-facebook",
      "url": "#"
    },
    {
      "social": "fa fa-twitter",
      "url": "#"
    },
    {
      "social": "fa fa-instagram",
      "url": "#"
    },
    {
      "social": "fa fa-dribbble",
      "url": "#"
    }
  ],
  "footer_bg": "#3d3d3d",
  "footer_bg_image": "",
  "footer_color": "#fff",
  "footer_cols": "4",
  "accordions_style": "style_2",
  "buttons_global_style": "style_6",
  "currency_symbol": "$",
  "currency_symbol_position": "USD",
  "forms_global_style": "style_3",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1140",
  "google_api_key": "",
  "favicon": "",
  "logo": "20",
  "logo_transparent": "",
  "logo_width": "",
  "pagination_style": "style_6",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#04a5dd",
  "sidebars_global_style": "style_6",
  "tabs_style": "style_4",
  "page_title_box": "true",
  "page_title_box_align": "left",
  "page_title_box_bg_image": "",
  "page_title_box_override": "false",
  "page_title_box_style": "style_6",
  "page_title_box_subtitle": "",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h1",
  "page_title_breadcrumbs": "true",
  "page_title_button": "false",
  "page_title_button_text": "",
  "page_title_button_url": "",
  "tour_style": "style_3",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "0",
  "bottom_bar_color": "rgba(250, 250, 250, 0.75)",
  "bottom_bar_link_colorhover": "#595959",
  "bottom_bar_text_color": "#595959",
  "bottom_bar_top": "0",
  "header_builder": {
    "bottom": {
      "center": [
        {
          "$$hashKey": "object:286",
          "data": {
            "description": "Mon \u2014 Sat: 8 am \u2014 5 pm, Sunday: CLOSED",
            "icon": "stmicon-med_clock",
            "title": "Open Hours"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "order": {
            "mobile": "3100",
            "tablet": "3100"
          },
          "position": [
            "bottom",
            "center",
            "0"
          ],
          "type": "iconbox"
        }
      ],
      "left": [
        {
          "$$hashKey": "object:1839",
          "data": {
            "description": "51 Uxbridge Road, San Francisco W7 3PX",
            "icon": "stmicon-dialpad",
            "style": "style_2",
            "title": "Call Today 020 8567 0707"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "order": {
            "mobile": "3100",
            "tablet": "3100"
          },
          "position": [
            "bottom",
            "left",
            "0"
          ],
          "type": "iconbox",
          "value": "style_2"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:279",
          "data": {
            "description": "It\u2019s so fast",
            "icon": "stmicon-med_calendar",
            "text": "Make an Appointment",
            "url": "\/medicall\/online-appointment"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Button Extended",
          "order": {
            "mobile": "3099",
            "tablet": "3099"
          },
          "position": [
            "bottom",
            "right",
            "0"
          ],
          "type": "buttonext"
        }
      ]
    },
    "center": {
      "left": [
        {
          "$$hashKey": "object:1559",
          "data": {
            "uselogo": "true"
          },
          "disabled": {
            "default": "",
            "mobile": "disabled",
            "tablet": "disabled"
          },
          "label": "Image",
          "order": {
            "mobile": "2100",
            "tablet": "1099"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1237",
          "data": {
            "id": "3",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "order": {
            "mobile": "2300",
            "tablet": "2300"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        }
      ]
    },
    "top": {
      "left": [
        {
          "$$hashKey": "object:1206",
          "data": {
            "fwn": "fwn"
          },
          "disabled": {
            "default": "",
            "mobile": "disabled",
            "tablet": "disabled"
          },
          "label": "Text",
          "order": {
            "mobile": "1100",
            "tablet": "1100"
          },
          "position": [
            "top",
            "left",
            "0"
          ],
          "type": "text",
          "value": "High Quality Healthcare in San Diego"
        },
        {
          "$$hashKey": "object:207",
          "data": {
            "style": "icon_only"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Socials",
          "margins": {
            "default": {
              "left": "50"
            }
          },
          "order": {
            "mobile": "1097",
            "tablet": "1098"
          },
          "position": [
            "top",
            "left",
            "1"
          ],
          "type": "socials"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1208",
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Search",
          "order": {
            "mobile": "1099",
            "tablet": "1097"
          },
          "position": [
            "top",
            "right",
            "0"
          ],
          "type": "search",
          "value": "style_2"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "32",
  "header_color": "rgba(255, 0, 0, 0)",
  "header_text_color": "#333333",
  "header_text_color_hover": "#04a5dd",
  "header_top": "28",
  "header_socials": [
    {
      "social": "fa fa-facebook",
      "url": "#facebook"
    },
    {
      "social": "fa fa-twitter",
      "url": "#twitter"
    },
    {
      "social": "fa fa-instagram",
      "url": "#instagram"
    },
    {
      "social": "fa fa-linkedin",
      "url": "#linkedin"
    }
  ],
  "main_header_offset": "false",
  "main_header_style": "style_6",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "0",
  "top_bar_color": "rgba(255, 255, 255, 0)",
  "top_bar_link_color_hover": "#4c4c4c",
  "top_bar_text_color": "#999999",
  "top_bar_top": "0",
  "page_bc": "false",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "",
  "error_page_style": "style_1",
  "albums": {
    "enabled": "false"
  },
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "donations": {
    "enabled": "false"
  },
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "10",
  "stm_donations_amount_3": "10",
  "stm_donations_layout": "left",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "false"
  },
  "stm_events_layout": "left",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "default",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "left",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "false"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "default",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "left",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "true"
  },
  "stm_services_layout": "4",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "1165",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "right",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "stories": {
    "enabled": "true"
  },
  "testimonials": {
    "enabled": "true"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "Contact us",
  "stm_vacancies_button_url": "\/medicall\/contacts",
  "stm_vacancies_details": "false",
  "stm_vacancies_layout_single": "4",
  "stm_vacancies_share": "false",
  "stm_vacancies_sidebar_single": "1165",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "right",
  "vacancies": {
    "enabled": "true"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "videos": {
    "enabled": "false"
  },
  "shop_items": "3",
  "product_sidebar": "default",
  "product_sidebar_position": "left",
  "blockquote_style": "style_7",
  "body_font": {
    "color": "#595959",
    "fw": "300",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h1_settings": {
    "color": "",
    "fw": "",
    "ln": "54",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "48"
  },
  "h2_settings": {
    "color": "",
    "fw": "",
    "ln": "42",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "36"
  },
  "h3_settings": {
    "color": "",
    "fw": "",
    "ln": "36",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "30"
  },
  "h4_settings": {
    "color": "",
    "fw": "",
    "ln": "30",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "24"
  },
  "h5_settings": {
    "color": "",
    "fw": "",
    "ln": "24",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "18"
  },
  "h6_settings": {
    "color": "",
    "fw": "",
    "ln": "18",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "14"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "",
    "name": "",
    "subset": ""
  },
  "link_color": "#04a5dd",
  "link_hover_color": "#04a5dd",
  "list_style": "style_6",
  "p_line_height": "30",
  "p_margin_bottom": "30"
}';
	return $json;
}

function stm_theme_options_artist()
{
	$json = '{
  "post_layout": "8",
  "post_sidebar": "864",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "true",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "false",
  "post_sidebar_single_position": "left",
  "post_tags": "true",
  "post_title": "true",
  "main_color": "#d61515",
  "secondary_color": "#d61515",
  "third_color": "#0c0c0d",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "true",
  "copyright_year": "false",
  "footer_bottom_bg": "",
  "right_text": "",
  "footer_socials": [
    {
      "social": "fa fa-facebook",
      "url": "#"
    },
    {
      "social": "fa fa-twitter",
      "url": "#"
    },
    {
      "social": "fa fa-google-plus",
      "url": "#"
    },
    {
      "social": "fa fa-linkedin",
      "url": "#"
    }
  ],
  "footer_bg": "#0c0c0d",
  "footer_bg_image": "",
  "footer_color": "#fff",
  "footer_cols": "3",
  "accordions_style": "style_6",
  "buttons_global_style": "style_8",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_7",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "true",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "50",
  "site_width": "1150",
  "google_api_key": "",
  "favicon": "",
  "logo": "1127",
  "logo_transparent": "",
  "logo_width": "",
  "pagination_style": "style_8",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#d61515",
  "sidebars_global_style": "style_8",
  "tabs_style": "style_5",
  "page_title_box": "true",
  "page_title_box_align": "center",
  "page_title_box_bg_color": "#0d0f13",
  "page_title_box_bg_image": "",
  "page_title_box_override": "false",
  "page_title_box_style": "style_8",
  "page_title_box_subtitle": "",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h1",
  "page_title_breadcrumbs": "false",
  "page_title_button": "false",
  "page_title_button_text": "",
  "page_title_button_url": "",
  "tour_style": "style_1",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "0",
  "bottom_bar_color": "#f00",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#f00",
  "bottom_bar_top": "0",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:868",
          "data": {
            "uselogo": "true"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Image",
          "order": {
            "mobile": "1100",
            "tablet": "1100"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:230",
          "data": {
            "font": "hf",
            "id": "2",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "order": {
            "mobile": "2310",
            "tablet": "2310"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        },
        {
          "$$hashKey": "object:255",
          "data": {
            "style": "icon_only"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Socials",
          "margins": {
            "default": {
              "left": "30"
            }
          },
          "order": {
            "mobile": "2300",
            "tablet": "2300"
          },
          "position": [
            "center",
            "right",
            "1"
          ],
          "type": "socials"
        }
      ]
    }
  },
  "center_header_fullwidth": "true",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "37",
  "header_color": "rgba(255, 254, 254, 0)",
  "header_text_color": "#010101",
  "header_text_color_hover": "#d61515",
  "header_top": "37",
  "header_socials": [
    {
      "social": "fa fa-facebook",
      "url": "#"
    },
    {
      "social": "fa fa-twitter",
      "url": "#"
    },
    {
      "social": "fa fa-instagram",
      "url": "#"
    }
  ],
  "main_header_offset": "false",
  "main_header_style": "style_8",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "0",
  "top_bar_color": "#f00",
  "top_bar_link_color_hover": "#f00",
  "top_bar_text_color": "#f00",
  "top_bar_top": "0",
  "page_bc": "true",
  "page_bc_fullwidth": "true",
  "coming_soon_style": "style_1",
  "error_page_bg": "",
  "error_page_style": "style_5",
  "albums": {
    "enabled": "true",
    "has_archive": "true",
    "slug": ""
  },
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "false",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "donations": {
    "enabled": "false"
  },
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "true",
    "name": "Tour",
    "plural": "Tours",
    "slug": "tours"
  },
  "stm_events_layout": "2",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "false",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "left",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "false"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "default",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "left",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "false"
  },
  "stm_services_layout": "left",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "default",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "left",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "stories": {
    "enabled": "false"
  },
  "testimonials": {
    "enabled": "false"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "",
  "stm_vacancies_button_url": "",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "left",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "default",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "vacancies": {
    "enabled": "false"
  },
  "videos": {
    "enabled": "false"
  },
  "stories": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_sidebar_position": "left",
  "product_single_sidebar_position": "left",
  "blockquote_style": "style_8",
  "body_font": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h1_settings": {
    "color": "",
    "fw": "",
    "ln": "83",
    "ls": "-0.8",
    "mgb": "35",
    "name": "",
    "size": "75"
  },
  "h2_settings": {
    "color": "",
    "fw": "",
    "ln": "55",
    "ls": "-0.6",
    "mgb": "35",
    "name": "",
    "size": "50"
  },
  "h3_settings": {
    "color": "",
    "fw": "",
    "ln": "40",
    "ls": "-1.6",
    "mgb": "30",
    "name": "",
    "size": "36"
  },
  "h4_settings": {
    "color": "",
    "fw": "",
    "ln": "29",
    "ls": "",
    "mgb": "30",
    "name": "",
    "size": "26"
  },
  "h5_settings": {
    "color": "",
    "fw": "",
    "ln": "22",
    "ls": "",
    "mgb": "30",
    "name": "",
    "size": "20"
  },
  "h6_settings": {
    "color": "",
    "fw": "",
    "ln": "17",
    "ls": "",
    "mgb": "25",
    "name": "",
    "size": "15"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "",
    "name": "",
    "subset": ""
  },
  "link_color": "#d61515",
  "link_hover_color": "#0c0c0d",
  "list_style": "style_1",
  "p_line_height": "24",
  "p_margin_bottom": "23"
}';
	return $json;
}

function stm_theme_options_logistics()
{
	$json = '{
  "post_layout": "2",
  "post_sidebar": "320",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "true",
  "post_comments": "true",
  "post_image": "false",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "320",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "true",
  "main_color": "#58c747",
  "secondary_color": "#ff694e",
  "third_color": "#122a4c",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "false",
  "copyright_year": "false",
  "footer_bottom_bg": "",
  "right_text": "",
  "footer_socials": "",
  "footer_bg": "#002040",
  "footer_bg_image": "",
  "footer_color": "#8090a0",
  "footer_cols": "4",
  "accordions_style": "style_3",
  "buttons_global_style": "style_2",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_2",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1140",
  "google_api_key": "",
  "favicon": "",
  "logo": "4",
  "logo_transparent": "4",
  "logo_width": "",
  "pagination_style": "style_2",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#58c747",
  "sidebars_global_style": "style_3",
  "tabs_style": "style_1",
  "page_title_box": "true",
  "page_title_box_align": "left",
  "page_title_box_bg_color": "rgba(24, 54, 80, 0.35)",
  "page_title_box_bg_image": "836",
  "page_title_box_line_color": "#f00",
  "page_title_box_override": "false",
  "page_title_box_style": "style_3",
  "page_title_box_subtitle": "",
  "page_title_box_subtitle_color": "#f00",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h2",
  "page_title_breadcrumbs": "false",
  "page_title_button": "false",
  "page_title_button_text": "",
  "page_title_button_url": "",
  "tour_style": "style_1",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "NaN",
  "bottom_bar_color": "#f00",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#f00",
  "bottom_bar_top": "NaN",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:682",
          "data": {
            "uselogo": "false",
            "width": "200"
          },
          "disabled": {
            "default": "",
            "mobile": "disabled",
            "tablet": "disabled"
          },
          "label": "Image",
          "margins": {
            "default": {
              "bottom": "30",
              "top": "30"
            }
          },
          "order": {
            "mobile": "2100",
            "tablet": "2100"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image",
          "value": "4"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1222",
          "data": {
            "divider": "",
            "id": "2",
            "line": "line_bottom",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "margins": {
            "default": {
              "right": "15"
            }
          },
          "order": {
            "mobile": "2310",
            "tablet": "2310"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        },
        {
          "$$hashKey": "object:712",
          "data": {
            "style": "icon_only"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Socials",
          "margins": {
            "default": {
              "bottom": "30",
              "top": "30"
            },
            "mobile": {
              "bottom": "30",
              "top": "30"
            }
          },
          "order": {
            "mobile": "2300",
            "tablet": "2300"
          },
          "position": [
            "center",
            "right",
            "1"
          ],
          "type": "socials"
        }
      ]
    },
    "top": {
      "left": [
        {
          "$$hashKey": "object:754",
          "choices": {
            "custom": "Custom",
            "wpml": "WPML"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "dropdown": [
            {
              "label": "English",
              "url": "#"
            },
            {
              "label": "Russian",
              "url": "#"
            },
            {
              "label": "Arab",
              "url": "#"
            }
          ],
          "label": "Dropdown",
          "order": {
            "mobile": "2311",
            "tablet": "2311"
          },
          "position": [
            "top",
            "left",
            "0"
          ],
          "type": "dropdown",
          "value": "custom"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1903",
          "data": {
            "icon": "stmicon-globe2",
            "iconColor": {
              "name": "Secondary color",
              "value": "stc"
            },
            "offices": [
              {
                "$$hashKey": "object:1014",
                "info": [
                  {
                    "$$hashKey": "object:1028",
                    "icon": "stmicon-iphone",
                    "label": "Call Free: +1 376-226-3126",
                    "url": "tel:+1 376-226-3126"
                  },
                  {
                    "$$hashKey": "object:1029",
                    "icon": "stmicon-envelope",
                    "label": "info@transcargo.com",
                    "url": "mailto:info@transcargo.com"
                  },
                  {
                    "$$hashKey": "object:1030",
                    "icon": "stmicon-clock5",
                    "label": "Mon \u2014 Sat: 9AM \u2014 6PM",
                    "url": ""
                  }
                ],
                "name": "London office"
              },
              {
                "$$hashKey": "object:1015",
                "info": [
                  {
                    "$$hashKey": "object:1223",
                    "icon": "stmicon-clock5",
                    "label": "Mon \u2014 Sat: 9AM \u2014 6PM",
                    "url": "#"
                  },
                  {
                    "$$hashKey": "object:1681",
                    "icon": "stmicon-envelope",
                    "label": "info@transcargo.com",
                    "url": "mailto:  info@transcargo.com"
                  },
                  {
                    "$$hashKey": "object:1892",
                    "icon": "stmicon-iphone",
                    "label": "Call Free: +1 376-226-3126",
                    "url": "tel:+1 376-226-3126"
                  }
                ],
                "name": "Madrid office"
              }
            ],
            "textColor": {
              "name": "Custom",
              "value": "#ffffff"
            }
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Offices",
          "margins": {
            "default": {
              "bottom": "",
              "top": ""
            }
          },
          "order": {
            "mobile": "1300",
            "tablet": "1300"
          },
          "position": [
            "top",
            "right",
            "0"
          ],
          "type": "offices"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "NaN",
  "header_color": "rgba(0, 0, 0, 0)",
  "header_text_color": "#ffffff",
  "header_text_color_hover": "#ffffff",
  "header_top": "NaN",
  "header_socials": [
    {
      "social": "fa fa-facebook",
      "url": "http:\/\/fb.com"
    },
    {
      "social": "fa fa-twitter",
      "url": "twitter.com"
    },
    {
      "social": "fa fa-linkedin",
      "url": "linkedin.com"
    }
  ],
  "main_header_offset": "false",
  "main_header_sticky_mobile": "false",
  "main_header_style": "style_3",
  "main_header_transparent": "true",
  "top_bar_bg": "",
  "top_bar_bottom": "NaN",
  "top_bar_color": "rgba(18, 42, 76, 0.65)",
  "top_bar_link_color_hover": "#f00",
  "top_bar_text_color": "#ffffff",
  "top_bar_top": "NaN",
  "page_bc": "true",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "",
  "error_page_style": "center",
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "false"
  },
  "stm_events_layout": "left",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "default",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "left",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "false",
    "name": "",
    "plural": "",
    "slug": ""
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "default",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "left",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "true",
    "has_archive": "true"
  },
  "stm_services_layout": "left",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "false",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "left",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "stories": {
    "enabled": "false"
  },
  "testimonials": {
    "enabled": "true",
    "name": "Testimonials",
    "plural": "Testimonials",
    "slug": "testimonials"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "Contact us",
  "stm_vacancies_button_url": "#",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "2",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "320",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "right",
  "vacancies": {
    "enabled": "true"
  },
  "albums": {
    "enabled": "false"
  },
  "videos": {
    "enabled": "true"
  },
  "albums": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_items": "3",
  "product_sidebar": "default",
  "product_sidebar_position": "left",
  "blockquote_style": "style_2",
  "body_font": {
    "color": "#999",
    "fw": "400",
    "ln": "30",
    "ls": "",
    "mgb": "",
    "name": "Rubik",
    "size": "16"
  },
  "h1_settings": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h2_settings": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h3_settings": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h4_settings": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h5_settings": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "h6_settings": {
    "color": "",
    "fw": "",
    "ln": "",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": ""
  },
  "headings_line": "true",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "#002040",
    "name": "Oxygen",
    "subset": ""
  },
  "link_color": "#58c747",
  "link_hover_color": "#58c747",
  "list_style": "style_3",
  "p_line_height": "30",
  "p_margin_bottom": "26"
}';
	return $json;
}

function stm_theme_options_beauty()
{
	$json = '{
  "post_layout": "4",
  "post_sidebar": "default",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "grid",
  "post_author": "true",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "default",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "false",
  "main_color": "#c54045",
  "secondary_color": "#63bac1",
  "third_color": "#5c373e",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "false",
  "copyright_year": "false",
  "footer_bottom_bg": "#462a2f",
  "right_text": "",
  "footer_socials": [
    {
      "social": "fa fa-facebook",
      "url": "fb.com"
    },
    {
      "social": "fa fa-twitter",
      "url": "twitter.com"
    },
    {
      "social": "fa fa-instagram",
      "url": "instagram.com"
    }
  ],
  "footer_bg": "#58343b",
  "footer_bg_image": "187",
  "footer_color": "#fff",
  "footer_cols": "4",
  "accordions_style": "style_4",
  "buttons_global_style": "style_4",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_4",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1200",
  "google_api_key": "",
  "favicon": "",
  "logo": "1321",
  "logo_transparent": "",
  "logo_width": "",
  "pagination_style": "style_4",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#c54045",
  "sidebars_global_style": "style_4",
  "tabs_style": "style_3",
  "page_title_box": "true",
  "page_title_box_align": "left",
  "page_title_box_bg_color": "rgb(92, 55, 62)",
  "page_title_box_bg_image": "",
  "page_title_box_line_color": "#ffffff",
  "page_title_box_override": "false",
  "page_title_box_style": "style_4",
  "page_title_box_subtitle": "",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h2",
  "page_title_breadcrumbs": "true",
  "page_title_button": "false",
  "page_title_button_text": "Get in touch",
  "page_title_button_url": "\/construction\/contact-us",
  "tour_style": "style_2",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "NaN",
  "bottom_bar_color": "rgba(1, 0, 0, 0)",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#f00",
  "bottom_bar_top": "NaN",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:1238",
          "data": {
            "description": "",
            "divider": "icon",
            "dividerIcon": "stmicon-menu_sep_beauty",
            "dividerIconFf": "FontAwesome",
            "icon": "",
            "id": "2",
            "line": "line_top",
            "lineCcolor": "#ccdc25",
            "lineColor": "#5c373e",
            "style": "default",
            "title": ""
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "margins": {
            "default": {
              "left": "30",
              "right": "0"
            }
          },
          "order": {
            "mobile": "2200",
            "tablet": "2200"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "menu"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1204",
          "data": {
            "size": "icon_24px",
            "style": "icon_only"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Socials",
          "margins": {
            "default": {
              "left": "",
              "right": "15"
            }
          },
          "order": {
            "mobile": "1099",
            "tablet": "1300"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "socials"
        }
      ]
    },
    "top": {
      "left": [
        {
          "$$hashKey": "object:1329",
          "data": {
            "uselogo": "true",
            "width": "205"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Image",
          "order": {
            "mobile": "1100",
            "tablet": "1100"
          },
          "position": [
            "top",
            "left",
            "0"
          ],
          "type": "image"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1583",
          "data": {
            "description": "Request a call back",
            "icon": "stmicon-phone_beauty",
            "line2AsLink": "true",
            "line2PageId": "1379",
            "modal2Width": "400",
            "title": "555 222 5342"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "order": {
            "mobile": "1320",
            "tablet": "1320"
          },
          "position": [
            "top",
            "right",
            "0"
          ],
          "type": "iconbox"
        },
        {
          "$$hashKey": "object:1505",
          "data": {
            "description": "8008 Z\u00fcrich, Switzerland <br \/> Zollikerstrasse 82",
            "icon": "stmicon-map_beauty",
            "textColor": "",
            "title": ""
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "order": {
            "mobile": "1310",
            "tablet": "1310"
          },
          "position": [
            "top",
            "right",
            "1"
          ],
          "type": "iconbox"
        },
        {
          "$$hashKey": "object:1535",
          "data": {
            "description": "Tuesday \u2013 Sunday 9:00 am \u2013 7:00 pm <br> Saturday & Monday Closed",
            "icon": "stmicon-clock_beauty",
            "title": ""
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Icon Box",
          "margins": {
            "default": {
              "left": "33"
            }
          },
          "order": {
            "mobile": "1310",
            "tablet": "1310"
          },
          "position": [
            "top",
            "right",
            "2"
          ],
          "type": "iconbox"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "container",
  "header_bottom": "NaN",
  "header_color": "rgb(197, 64, 69)",
  "header_text_color": "#ffffff",
  "header_text_color_hover": "#ffffff",
  "header_top": "NaN",
  "header_socials": [
    {
      "social": "fa fa-facebook",
      "url": "fb.com"
    },
    {
      "social": "fa fa-twitter",
      "url": "twitter.com"
    },
    {
      "social": "fa fa-instagram",
      "url": "instagram.com"
    }
  ],
  "main_header_offset": "true",
  "main_header_style": "style_4",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "17",
  "top_bar_color": "#ffffff",
  "top_bar_link_color_hover": "#f00",
  "top_bar_text_color": "#333333",
  "top_bar_top": "39",
  "page_bc": "false",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "",
  "error_page_style": "style_1",
  "albums": {
    "enabled": "false"
  },
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "donations": {
    "enabled": "false"
  },
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "false"
  },
  "stm_events_layout": "left",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "default",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "left",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "true",
    "has_archive": "false",
    "name": "Project",
    "plural": "Projects",
    "slug": "projects"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "1339",
  "stm_projects_sidebar_single_mobile": "show",
  "stm_projects_sidebar_single_position": "right",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "true",
    "has_archive": "true",
    "slug": "services"
  },
  "stm_services_layout": "4",
  "stm_services_sidebar": "false",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "false",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "right",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "stories": {
    "enabled": "false"
  },
  "testimonials": {
    "enabled": "true",
    "has_archive": "false",
    "name": "Testimonial",
    "plural": "Testimonials",
    "slug": "testimonial"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "Contact Us",
  "stm_vacancies_button_url": "\/construction\/contact-us",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "1",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "1064",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "vacancies": {
    "enabled": "true"
  },
  "videos": {
    "enabled": "false"
  },
  "stories": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_sidebar_position": "left",
  "product_single_sidebar_position": "left",
  "blockquote_style": "style_4",
  "body_font": {
    "color": "#808080",
    "fw": "400",
    "ln": "24",
    "ls": "",
    "mgb": "",
    "name": "Montserrat",
    "size": "14"
  },
  "h1_settings": {
    "color": "#5c373e",
    "fw": "700",
    "ln": "48",
    "ls": "0",
    "mgb": "48",
    "name": "Playfair Display",
    "size": "42"
  },
  "h2_settings": {
    "color": "#5c373e",
    "fw": "700",
    "ln": "42",
    "ls": "0",
    "mgb": "48",
    "name": "Playfair Display",
    "size": "36"
  },
  "h3_settings": {
    "color": "#5c373e",
    "fw": "700",
    "ln": "36",
    "ls": "0",
    "mgb": "42",
    "name": "Playfair Display",
    "size": "30"
  },
  "h4_settings": {
    "color": "#5c373e",
    "fw": "700",
    "ln": "30",
    "ls": "0",
    "mgb": "36",
    "name": "Playfair Display",
    "size": "24"
  },
  "h5_settings": {
    "color": "#5c373e",
    "fw": "700",
    "ln": "24",
    "ls": "0",
    "mgb": "32",
    "name": "Playfair Display",
    "size": "18"
  },
  "h6_settings": {
    "color": "#5c373e",
    "fw": "700",
    "ln": "22",
    "ls": "0",
    "mgb": "15",
    "name": "Playfair Display",
    "size": "16"
  },
  "headings_line": "true",
  "headings_line_height": "2",
  "headings_line_position": "bottom",
  "headings_line_width": "24",
  "secondary_font": {
    "color": "#5c373e",
    "name": "Playfair Display",
    "subset": ""
  },
  "link_color": "#c54045",
  "link_hover_color": "#5c373e",
  "list_style": "style_4",
  "p_line_height": "24",
  "p_margin_bottom": "25"
}';
	return $json;
}

function stm_theme_options_charity()
{
	$json =
		'{
  "post_layout": "7",
  "post_sidebar": "827",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "true",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "827",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "false",
  "main_color": "#fdb714",
  "secondary_color": "#00749c",
  "third_color": "#591e00",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "true",
  "copyright_year": "false",
  "footer_bottom_bg": "#ffffff",
  "right_text": "",
  "footer_socials": [
    {
      "social": "fa fa-twitter",
      "url": "#"
    },
    {
      "social": "fa fa-facebook",
      "url": "#"
    },
    {
      "social": "fa fa-google-plus",
      "url": "#"
    },
    {
      "social": "fa fa-instagram",
      "url": "#"
    }
  ],
  "footer_bg": "#591e00",
  "footer_bg_image": "",
  "footer_color": "#ac8f80",
  "footer_cols": "4",
  "accordions_style": "style_4",
  "buttons_global_style": "style_7",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_6",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1200",
  "google_api_key": "",
  "favicon": "",
  "logo": "11",
  "logo_transparent": "",
  "logo_width": "",
  "pagination_style": "style_7",
  "paypal_currency_code": "USD",
  "paypal_email": "boikovalentin@gmail.com",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#fdb714",
  "sidebars_global_style": "style_7",
  "tabs_style": "style_4",
  "page_title_box": "true",
  "page_title_box_align": "center",
  "page_title_box_bg_color": "rgba(89, 30, 0, 0.6)",
  "page_title_box_bg_image": "",
  "page_title_box_override": "false",
  "page_title_box_style": "style_7",
  "page_title_box_subtitle": "",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h1",
  "page_title_breadcrumbs": "true",
  "page_title_button": "false",
  "page_title_button_text": "",
  "page_title_button_url": "",
  "tour_style": "style_3",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "0",
  "bottom_bar_color": "#f00",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#f00",
  "bottom_bar_top": "0",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:1881",
          "data": {
            "uselogo": "true",
            "width": "160"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Image",
          "margins": {
            "default": {
              "bottom": "18",
              "top": "18"
            }
          },
          "order": {
            "mobile": "2100",
            "tablet": "2100"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1242",
          "data": {
            "font": "mf",
            "fsz": "16",
            "fwn": "fwb",
            "id": "2",
            "lh": "70",
            "line": "line_bottom",
            "lineColor": "#fdb714",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "order": {
            "mobile": "2200",
            "tablet": "2200"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        }
      ]
    },
    "top": {
      "left": [
        {
          "$$hashKey": "object:428",
          "data": {
            "fwn": "fwn"
          },
          "disabled": {
            "default": "",
            "mobile": "disabled",
            "tablet": "disabled"
          },
          "label": "Text",
          "margins": {
            "default": {
              "bottom": "10",
              "top": "10"
            }
          },
          "order": {
            "mobile": "1110",
            "tablet": "1110"
          },
          "position": [
            "top",
            "left",
            "0"
          ],
          "type": "text",
          "value": "E-mail: info@stylemixthemes.com &nbsp;&nbsp; | &nbsp;&nbsp;   Phone: +7 998 150 30 20 &nbsp;&nbsp;  | &nbsp;&nbsp;   Mobile: +7 998 150 30 30"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1201",
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Search",
          "order": {
            "mobile": "1300",
            "tablet": "1300"
          },
          "position": [
            "top",
            "right",
            "0"
          ],
          "type": "search",
          "value": "style_3"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "0",
  "header_color": "#ffffff",
  "header_text_color": "#591e00",
  "header_text_color_hover": "#591e00",
  "header_top": "0",
  "header_socials": "",
  "main_header_offset": "false",
  "main_header_style": "style_7",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "0",
  "top_bar_color": "#591e00",
  "top_bar_link_color_hover": "#fdb714",
  "top_bar_text_color": "#ffffff",
  "top_bar_top": "0",
  "page_bc": "false",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "",
  "error_page_style": "style_1",
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "stories": {
    "enabled": "false"
  },
  "videos": {
    "enabled": "false"
  },
  "albums": {
    "enabled": "false"
  },
  "donations": {
    "enabled": "true"
  },
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_modal_page": "58",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "right",
  "stm_donations_sidebar_single": "827",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "right",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "true"
  },
  "stm_events_layout": "3",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "false",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "right",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "false"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "default",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "left",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "services": {
    "enabled": "false"
  },
  "stm_services_layout": "left",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "default",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "left",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "stories": {
    "enabled": "false"
  },
  "testimonials": {
    "enabled": "true"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "false",
  "stm_vacancies_button_text": "",
  "stm_vacancies_button_url": "",
  "stm_vacancies_details": "false",
  "stm_vacancies_layout_single": "left",
  "stm_vacancies_share": "false",
  "stm_vacancies_sidebar_single": "default",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "vacancies": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_sidebar_position": "left",
  "product_single_sidebar_position": "left",
  "blockquote_style": "style_6",
  "body_font": {
    "color": "#808080",
    "fw": "400",
    "ln": "28",
    "ls": "",
    "mgb": "",
    "name": "Fira Sans",
    "size": "16"
  },
  "h1_settings": {
    "color": "#591e00",
    "fw": "700",
    "ln": "60",
    "ls": "-2.16",
    "mgb": "41",
    "name": "PT Serif",
    "size": "54"
  },
  "h2_settings": {
    "color": "#591e00",
    "fw": "700",
    "ln": "48",
    "ls": "-1.44",
    "mgb": "35",
    "name": "PT Serif",
    "size": "36"
  },
  "h3_settings": {
    "color": "#591e00",
    "fw": "700",
    "ln": "42",
    "ls": "-0.6",
    "mgb": "29",
    "name": "PT Serif",
    "size": "30"
  },
  "h4_settings": {
    "color": "#591e00",
    "fw": "700",
    "ln": "30",
    "ls": "-0.48",
    "mgb": "23",
    "name": "PT Serif",
    "size": "24"
  },
  "h5_settings": {
    "color": "#591e00",
    "fw": "",
    "ln": "24",
    "ls": "-0.36",
    "mgb": "17",
    "name": "PT Serif",
    "size": "18"
  },
  "h6_settings": {
    "color": "#591e00",
    "fw": "",
    "ln": "24",
    "ls": "0",
    "mgb": "11",
    "name": "PT Serif",
    "size": "16"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "",
    "name": "PT Serif",
    "subset": ""
  },
  "link_color": "#591e00",
  "link_hover_color": "#591e00",
  "list_style": "style_1",
  "p_line_height": "28",
  "p_margin_bottom": "15"
}';
	return $json;
}

function stm_theme_options_restaurant()
{
	$json = '{
  "post_layout": "9",
  "post_sidebar": "false",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "left",
  "post_view": "list",
  "post_author": "false",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "false",
  "post_sidebar_single": "false",
  "post_sidebar_single_position": "left",
  "post_tags": "true",
  "post_title": "false",
  "main_color": "#ce9933",
  "secondary_color": "#ce9933",
  "third_color": "#274253",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "true",
  "copyright_socials": "true",
  "copyright_year": "true",
  "footer_bottom_bg": "",
  "right_text": "",
  "footer_socials": "",
  "footer_bg": "#ffffff",
  "footer_bg_image": "",
  "footer_color": "#000000",
  "footer_cols": "4",
  "accordions_style": "style_4",
  "buttons_global_style": "style_9",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "forms_global_style": "style_8",
  "boxed": "false",
  "boxed_bg": "",
  "enable_ajax": "false",
  "ga": "",
  "google_maps_api": "",
  "site_padding": "0",
  "site_width": "1340",
  "google_api_key": "",
  "favicon": "",
  "logo": "4287",
  "logo_transparent": "",
  "logo_width": "196",
  "pagination_style": "style_9",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "preloader": "true",
  "preloader_color": "#ce9933",
  "sidebars_global_style": "style_9",
  "tabs_style": "style_4",
  "page_title_box": "true",
  "page_title_box_align": "center",
  "page_title_box_bg_color": "rgba(38, 44, 47, 0.5)",
  "page_title_box_bg_image": "9",
  "page_title_box_override": "false",
  "page_title_box_style": "style_9",
  "page_title_box_subtitle": "\u2666",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h1",
  "page_title_breadcrumbs": "false",
  "page_title_button": "false",
  "page_title_button_text": "",
  "page_title_button_url": "",
  "tour_style": "style_3",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "0",
  "bottom_bar_color": "#f00",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#f00",
  "bottom_bar_top": "0",
  "header_builder": {
    "center": {
      "center": [
        {
          "$$hashKey": "object:440",
          "data": {
            "divider": "icon",
            "dividerIcon": "stmicon-bon_appetit_diamond",
            "dividerSymbol": "&diams;",
            "fixedHeader": {
              "mobile": "true"
            },
            "font": "mf",
            "fsz": "16",
            "id": "30",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "margins": {
            "default": {
              "top": "90"
            }
          },
          "order": {
            "mobile": "1200",
            "tablet": "1200"
          },
          "position": [
            "center",
            "center",
            "0"
          ],
          "type": "menu"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "0",
  "header_color": "rgba(0, 0, 0, 0.8)",
  "header_text_color": "#ffffff",
  "header_text_color_hover": "#ce9933",
  "header_top": "0",
  "header_socials": "",
  "main_header_offset": "false",
  "main_header_sticky_mobile": "true",
  "main_header_style": "style_9",
  "main_header_transparent": "true",
  "top_bar_bg": "",
  "top_bar_bottom": "0",
  "top_bar_color": "#f00",
  "top_bar_link_color_hover": "#f00",
  "top_bar_text_color": "#f00",
  "top_bar_top": "0",
  "page_bc": "false",
  "page_bc_fullwidth": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "4273",
  "error_page_style": "style_6",
  "albums": {
    "enabled": "false"
  },
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "donations": {
    "enabled": "false"
  },
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "false"
  },
  "stm_events_layout": "left",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "default",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "left",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "false"
  },
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "default",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "left",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "stm_services_layout": "left",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "default",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "left",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "stories": {
    "enabled": "false"
  },
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "",
  "stm_vacancies_button_url": "",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "left",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "default",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "vacancies": {
    "enabled": "false"
  },
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "videos": {
    "enabled": "true"
  },
  "shop_items": "3",
  "product_sidebar": "default",
  "product_sidebar_position": "left",
  "blockquote_style": "style_6",
  "body_font": {
    "color": "#000000",
    "fw": "400",
    "ln": "24",
    "ls": "0",
    "mgb": "",
    "name": "Quicksand",
    "size": "16"
  },
  "h1_settings": {
    "color": "#274253",
    "fw": "400",
    "ln": "60",
    "ls": "0",
    "mgb": "50",
    "name": "Kaushan Script",
    "size": "60"
  },
  "h2_settings": {
    "color": "#274253",
    "fw": "400",
    "ln": "50",
    "ls": "0",
    "mgb": "45",
    "name": "Kaushan Script",
    "size": "50"
  },
  "h3_settings": {
    "color": "#274253",
    "fw": "700",
    "ln": "28",
    "ls": "0",
    "mgb": "50",
    "name": "Quicksand",
    "size": "28"
  },
  "h4_settings": {
    "color": "#274253",
    "fw": "400",
    "ln": "24",
    "ls": "0",
    "mgb": "35",
    "name": "Quicksand",
    "size": "24"
  },
  "h5_settings": {
    "color": "#274253",
    "fw": "700",
    "ln": "18",
    "ls": "0",
    "mgb": "30",
    "name": "Quicksand",
    "size": "18"
  },
  "h6_settings": {
    "color": "#274253",
    "fw": "700",
    "ln": "16",
    "ls": "0",
    "mgb": "25",
    "name": "Quicksand",
    "size": "16"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "",
    "name": "Kaushan Script",
    "subset": ""
  },
  "link_color": "#ce9933",
  "link_hover_color": "#274253",
  "list_style": "style_7",
  "p_line_height": "24",
  "p_margin_bottom": "25"
}';
	return $json;
}

function stm_theme_options_rental()
{
	$json = '{
  "post_layout": "10",
  "post_sidebar": "784",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "list",
  "post_author": "true",
  "post_comments": "true",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "784",
  "post_sidebar_single_position": "right",
  "post_tags": "true",
  "post_title": "true",
  "main_color": "#bf9f50",
  "secondary_color": "#bf9f50",
  "third_color": "#1a1a1a",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "true",
  "copyright_socials": "true",
  "copyright_year": "false",
  "footer_bottom_bg": "",
  "right_text": "<a href=\"#top\" class=\"btn btn_outline btn_primary btn_left btn_gradient btn_icon-right\" title=\"Back to Top\" target=\"_self\"><i class=\"btn__icon icon_26px fa fa-angle-up\" aria-hidden=\"true\"><\/i>\n\t<span class=\"btn__label\">Back to Top<\/span>\n<\/a>",
  "stm_footer_layout": "2",
  "footer_socials": [
    {
      "social": "fa fa-twitter",
      "url": "#"
    },
    {
      "social": "fa fa-facebook",
      "url": "#"
    },
    {
      "social": "fa fa-google-plus",
      "url": "#"
    },
    {
      "social": "fa fa-instagram",
      "url": "#"
    }
  ],
  "footer_bg": "#3d3d3d",
  "footer_bg_image": "11",
  "footer_color": "#fff",
  "footer_cols": "4",
  "accordions_style": "style_1",
  "buttons_global_style": "style_10",
  "forms_global_style": "style_9",
  "pagination_style": "style_11",
  "sidebars_global_style": "style_10",
  "tabs_style": "style_1",
  "tour_style": "style_1",
  "boxed": "false",
  "boxed_bg": "",
  "divider_api_1": "",
  "enable_ajax": "false",
  "ga": "",
  "google_api_key": "",
  "logo": "472",
  "preloader": "false",
  "preloader_color": "#f00",
  "site_padding": "0",
  "site_width": "1200",
  "page_title_box": "true",
  "page_title_box_align": "center",
  "page_title_box_bg_image": "1170",
  "page_title_box_override": "false",
  "page_title_box_style": "style_10",
  "page_title_box_subtitle": "",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h2",
  "page_title_breadcrumbs": "false",
  "page_title_button": "false",
  "page_title_button_text": "",
  "page_title_button_url": "",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "0",
  "bottom_bar_color": "#f00",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#f00",
  "bottom_bar_top": "0",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:726",
          "data": {
            "uselogo": "false",
            "width": "200"
          },
          "disabled": {
            "default": "",
            "mobile": "disabled",
            "tablet": "disabled"
          },
          "label": "Image",
          "order": {
            "mobile": "2100",
            "tablet": "2199"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image",
          "value": "472"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:518",
          "data": {
            "font": "mf",
            "fsz": "14",
            "fwn": "fwb",
            "id": "2",
            "lh": "35",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "order": {
            "mobile": "2200",
            "tablet": "2200"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        },
        {
          "$$hashKey": "object:383",
          "choices": {
            "custom": "Custom",
            "wpml": "WPML"
          },
          "data": {
            "style": "style_1"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "dropdown": [
            {
              "label": "Label1",
              "url": "#"
            },
            {
              "label": "Lbel2",
              "url": "#"
            },
            {
              "label": "Label3",
              "url": "#"
            }
          ],
          "label": "Dropdown",
          "order": {
            "mobile": "2300",
            "tablet": "2300"
          },
          "position": [
            "center",
            "right",
            "1"
          ],
          "style": "style_2",
          "type": "dropdown",
          "value": "wpml"
        }
      ]
    },
    "top": {
      "left": [
        {
          "$$hashKey": "object:695",
          "disabled": {
            "default": "",
            "mobile": "disabled",
            "tablet": "disabled"
          },
          "label": "Search",
          "order": {
            "mobile": "1100",
            "tablet": "2198"
          },
          "position": [
            "top",
            "left",
            "0"
          ],
          "type": "search",
          "value": "style_4"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:1667",
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Sign in",
          "order": {
            "mobile": "2301",
            "tablet": "2301"
          },
          "position": [
            "top",
            "right",
            "0"
          ],
          "type": "signin",
          "woocommerce": "true"
        },
        {
          "$$hashKey": "object:427",
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Cart",
          "order": {
            "mobile": "2301",
            "tablet": "2302"
          },
          "position": [
            "top",
            "right",
            "1"
          ],
          "type": "cart",
          "value": "style_2",
          "woocommerce": "true"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "",
  "header_bg_fill": "full",
  "header_bottom": "12",
  "header_color": "#282828",
  "header_text_color": "#9b9b9b",
  "header_text_color_hover": "#bf9f50",
  "header_top": "12",
  "divider_h_socials_1": "",
  "header_socials": "",
  "main_header_offset": "false",
  "main_header_sticky_mobile": "false",
  "main_header_style": "style_10",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "10",
  "top_bar_color": "#1a1a1a",
  "top_bar_link_color_hover": "#585858",
  "top_bar_text_color": "#585858",
  "top_bar_top": "10",
  "page_bc": "false",
  "page_bc_fullwidth": "false",
  "show_page_title": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "1170",
  "error_page_style": "style_7",
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "divider_api_2": "",
  "divider_currency_1": "",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "20",
  "stm_donations_amount_3": "30",
  "stm_donations_layout": "1",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "events": {
    "enabled": "true",
    "has_archive": "false",
    "name": "Deals",
    "plural": "Deals",
    "public": "true",
    "slug": "deals"
  },
  "stm_events_layout": "5",
  "stm_events_sidebar": "728",
  "stm_events_sidebar_position": "right",
  "stm_events_sidebar_single": "728",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "right",
  "stm_events_view": "list",
  "divider_projects_1": "",
  "divider_projects_2": "",
  "stm_projects_layout": "default",
  "stm_projects_sidebar": "default",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "default",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "left",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "projects": {
    "enabled": "false"
  },
  "stories": {
    "enabled": "false"
  },
  "donations": {
    "enabled": "false"
  },
  "videos": {
    "enabled": "false"
  },
  "vacancies": {
    "enabled": "false"
  },
  "albums": {
    "enabled": "false"
  },
  "services": {
    "enabled": "true",
    "has_archive": "false",
    "public": "true"
  },
  "stm_services_layout": "2",
  "stm_services_sidebar": "default",
  "stm_services_sidebar_position": "left",
  "stm_services_sidebar_single": "false",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "right",
  "stm_services_single_form": "1055",
  "stm_services_single_phone": "+1 998 150 30 20",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "",
  "stm_vacancies_button_url": "",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "left",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "default",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_items": "3",
  "product_sidebar": "1010",
  "product_sidebar_position": "right",
  "blockquote_style": "style_9",
  "body_font": {
    "color": "#595959",
    "fw": "400",
    "ln": "30",
    "ls": "",
    "mgb": "",
    "name": "Roboto",
    "size": "16"
  },
  "h1_settings": {
    "color": "#1a1a1a",
    "fw": "700",
    "ln": "66",
    "ls": "",
    "mgb": "",
    "name": "Playfair Display SC",
    "size": "48"
  },
  "h2_settings": {
    "color": "#1a1a1a",
    "fw": "700",
    "ln": "60",
    "ls": "",
    "mgb": "0",
    "name": "Playfair Display SC",
    "size": "42"
  },
  "h3_settings": {
    "color": "#1a1a1a",
    "fw": "700",
    "ln": "54",
    "ls": "",
    "mgb": "0",
    "name": "Playfair Display SC",
    "size": "36"
  },
  "h4_settings": {
    "color": "#1a1a1a",
    "fw": "700",
    "ln": "48",
    "ls": "",
    "mgb": "0",
    "name": "Playfair Display SC",
    "size": "30"
  },
  "h5_settings": {
    "color": "#1a1a1a",
    "fw": "700",
    "ln": "42",
    "ls": "",
    "mgb": "0",
    "name": "Playfair Display SC",
    "size": "24"
  },
  "h6_settings": {
    "color": "#1a1a1a",
    "fw": "700",
    "ln": "36",
    "ls": "",
    "mgb": "0",
    "name": "Playfair Display SC",
    "size": "18"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "#1a1a1a",
    "name": "Playfair Display SC",
    "subset": ""
  },
  "link_color": "#bf9f50",
  "link_hover_color": "#555555",
  "list_style": "style_8",
  "p_line_height": "22",
  "p_margin_bottom": "15"
}';
	return $json;
}

function stm_theme_options_portfolio()
{
	$json = '{
  "post_layout": "11",
  "post_sidebar": "26",
  "post_sidebar_archive_mobile": "hidden",
  "post_sidebar_position": "right",
  "post_view": "grid",
  "post_author": "false",
  "post_comments": "false",
  "post_image": "true",
  "post_info": "true",
  "post_share": "true",
  "post_sidebar_single": "false",
  "post_sidebar_single_position": "right",
  "post_tags": "false",
  "post_title": "true",
  "main_color": "#000000",
  "secondary_color": "#ffffff",
  "third_color": "#000000",
  "copyright":"Pearl Theme by <a href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\" target=\"_blank\">Stylemix Themes.<\/a>",
  "copyright_co": "false",
  "copyright_socials": "true",
  "copyright_year": "false",
  "footer_bottom_bg": "",
  "right_text": "",
  "stm_footer_layout": "1",
  "footer_socials": [
    {
      "social": "fa fa-behance",
      "url": "#"
    },
    {
      "social": "fa fa-dribbble",
      "url": "#"
    },
    {
      "social": "fa fa-instagram",
      "url": "#"
    },
    {
      "social": "fa fa-twitter",
      "url": "#"
    }
  ],
  "footer_bg": "rgba(255, 254, 254, 0)",
  "footer_bg_image": "1873",
  "footer_color": "#000000",
  "footer_cols": "2",
  "accordions_style": "style_2",
  "buttons_global_style": "style_11",
  "forms_global_style": "style_3",
  "pagination_style": "style_10",
  "sidebars_global_style": "style_11",
  "tabs_style": "style_2",
  "tour_style": "style_1",
  "boxed": "false",
  "boxed_bg": "",
  "divider_api_1": "",
  "enable_ajax": "false",
  "ga": "",
  "google_api_key": "",
  "logo": "8",
  "preloader": "true",
  "preloader_color": "#000000",
  "site_padding": "0",
  "site_width": "1140",
  "page_title_box": "false",
  "page_title_box_align": "center",
  "page_title_box_bg_color": "rgba(0, 0, 0, 0.65)",
  "page_title_box_bg_image": "1716",
  "page_title_box_line_color": "#ffffff",
  "page_title_box_override": "false",
  "page_title_box_style": "style_2",
  "page_title_box_subtitle": "",
  "page_title_box_subtitle_color": "#ffffff",
  "page_title_box_text_color": "#ffffff",
  "page_title_box_title": "",
  "page_title_box_title_size": "h1",
  "page_title_breadcrumbs": "false",
  "page_title_button": "false",
  "page_title_button_text": "Button",
  "page_title_button_url": "#",
  "bottom_bar_bg": "",
  "bottom_bar_bottom": "15",
  "bottom_bar_color": "#297ee8",
  "bottom_bar_link_colorhover": "#f00",
  "bottom_bar_text_color": "#ffffff",
  "bottom_bar_top": "15",
  "header_builder": {
    "center": {
      "left": [
        {
          "$$hashKey": "object:399",
          "data": {
            "uselogo": "true",
            "width": "254"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Image",
          "order": {
            "mobile": "2100",
            "tablet": "2100"
          },
          "position": [
            "center",
            "left",
            "0"
          ],
          "type": "image"
        }
      ],
      "right": [
        {
          "$$hashKey": "object:976",
          "data": {
            "font": "mf",
            "fsz": "18",
            "fwn": "fwn",
            "id": "2",
            "line": "line_middle",
            "style": "default"
          },
          "disabled": {
            "default": "",
            "mobile": "",
            "tablet": ""
          },
          "label": "Menu",
          "order": {
            "mobile": "2300",
            "tablet": "2300"
          },
          "position": [
            "center",
            "right",
            "0"
          ],
          "type": "menu"
        }
      ]
    }
  },
  "center_header_fullwidth": "false",
  "header_bg": "1898",
  "header_bg_fill": "full",
  "header_bottom": "5",
  "header_color": "rgba(255, 254, 254, 0)",
  "header_text_color": "#000000",
  "header_text_color_hover": "#000000",
  "header_top": "50",
  "divider_h_socials_1": "",
  "header_socials": "",
  "main_header_offset": "false",
  "main_header_sticky_mobile": "false",
  "main_header_style": "style_11",
  "main_header_transparent": "false",
  "top_bar_bg": "",
  "top_bar_bottom": "25",
  "top_bar_color": "#222222",
  "top_bar_link_color_hover": "#0077ff",
  "top_bar_text_color": "#ffffff",
  "top_bar_top": "25",
  "page_bc": "true",
  "page_bc_fullwidth": "false",
  "show_page_title": "false",
  "coming_soon_style": "style_1",
  "error_page_bg": "2658",
  "error_page_style": "style_4",
  "divider_mus_1": "",
  "stm_albums_sidebar_single": "default",
  "stm_albums_sidebar_single_mobile": "hidden",
  "stm_albums_sidebar_single_position": "left",
  "currency_symbol": "$",
  "currency_symbol_position": "left",
  "divider_api_2": "",
  "divider_currency_1": "",
  "divider_donations_1": "",
  "divider_donations_2": "",
  "divider_donations_3": "",
  "paypal_currency_code": "USD",
  "paypal_email": "timur@stylemix.net",
  "paypal_mode": "sandbox",
  "stm_donations_amount_1": "10",
  "stm_donations_amount_2": "10",
  "stm_donations_amount_3": "10",
  "stm_donations_layout": "left",
  "stm_donations_sidebar": "default",
  "stm_donations_sidebar_position": "left",
  "stm_donations_sidebar_single": "default",
  "stm_donations_sidebar_single_mobile": "hidden",
  "stm_donations_sidebar_single_position": "left",
  "stm_donations_view": "list",
  "divider_events_1": "",
  "divider_events_2": "",
  "stm_events_layout": "1",
  "stm_events_sidebar": "default",
  "stm_events_sidebar_position": "left",
  "stm_events_sidebar_single": "2234",
  "stm_events_sidebar_single_mobile": "hidden",
  "stm_events_sidebar_single_position": "right",
  "stm_events_view": "list",
  "events": {
    "enabled": "false"
  },
  "stories": {
    "enabled": "false"
  },
  "donations": {
    "enabled": "false"
  },
  "videos": {
    "enabled": "false"
  },
  "vacancies": {
    "enabled": "false"
  },
  "albums": {
    "enabled": "false"
  },
  "divider_projects_1": "",
  "divider_projects_2": "",
  "projects": {
    "enabled": "true",
    "name": "Work",
    "plural": "Works",
    "slug": "work"
  },
  "stm_projects_layout": "2",
  "stm_projects_sidebar": "false",
  "stm_projects_sidebar_position": "left",
  "stm_projects_sidebar_single": "false",
  "stm_projects_sidebar_single_mobile": "hidden",
  "stm_projects_sidebar_single_position": "right",
  "stm_projects_view": "grid",
  "divider_services_1": "",
  "divider_services_2": "",
  "stm_services_layout": "left",
  "stm_services_sidebar": "2114",
  "stm_services_sidebar_position": "right",
  "stm_services_sidebar_single": "2291",
  "stm_services_sidebar_single_mobile": "hidden",
  "stm_services_sidebar_single_position": "left",
  "stm_stories_layout": "left",
  "stm_stories_sidebar_single": "default",
  "stm_stories_sidebar_single_mobile": "hidden",
  "stm_stories_sidebar_single_position": "left",
  "divider_vac_1": "",
  "stm_vacancies_button": "true",
  "stm_vacancies_button_text": "Contact Us",
  "stm_vacancies_button_url": "\/contact",
  "stm_vacancies_details": "true",
  "stm_vacancies_layout_single": "3",
  "stm_vacancies_share": "true",
  "stm_vacancies_sidebar_single": "false",
  "stm_vacancies_sidebar_single_mobile": "hidden",
  "stm_vacancies_sidebar_single_position": "left",
  "divider_vid_1": "",
  "stm_videos_sidebar_single": "default",
  "stm_videos_sidebar_single_mobile": "hidden",
  "stm_videos_sidebar_single_position": "left",
  "shop_items": "3",
  "product_sidebar": "false",
  "product_sidebar_position": "right",
  "blockquote_style": "style_10",
  "body_font": {
    "color": "",
    "fw": "400",
    "ln": "30",
    "ls": "",
    "mgb": "",
    "name": "Fira Mono",
    "size": "14"
  },
  "h1_settings": {
    "color": "",
    "fw": "400",
    "ln": "72",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "72"
  },
  "h2_settings": {
    "color": "",
    "fw": "400",
    "ln": "60",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "48"
  },
  "h3_settings": {
    "color": "",
    "fw": "400",
    "ln": "54",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "36"
  },
  "h4_settings": {
    "color": "",
    "fw": "400",
    "ln": "48",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "30"
  },
  "h5_settings": {
    "color": "",
    "fw": "400",
    "ln": "42",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "24"
  },
  "h6_settings": {
    "color": "",
    "fw": "400",
    "ln": "36",
    "ls": "",
    "mgb": "",
    "name": "",
    "size": "18"
  },
  "headings_line": "false",
  "headings_line_height": "5",
  "headings_line_position": "top",
  "headings_line_width": "45",
  "secondary_font": {
    "color": "#000000",
    "name": "Rubik",
    "subset": ""
  },
  "link_color": "#000000",
  "link_hover_color": "#000000",
  "list_style": "style_9",
  "p_line_height": "30",
  "p_margin_bottom": "35"
}';
	return $json;
}

function stm_theme_options_personal_blog()
{
	$json = '{"post_layout":"12","post_sidebar":"63","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"grid","post_author":"true","post_comments":"true","post_image":"false","post_info":"true","post_share":"true","post_sidebar_single":"90","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#cba66f","secondary_color":"#cba66f","third_color":"#000000","copyright":"Pearl Personal Blog Theme by <a href=\"http:\/\/stylemixthemes.com\/\" target=\"_blank\">Stylemix Themes.<\/a><br\/>\nAll rights reserved","copyright_co":"false","copyright_image":"126","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"","stm_footer_layout":"3","footer_socials":[{"social":"fa fa-facebook","url":"#fb"},{"social":"fa fa-twitter","url":"#tw"},{"social":"fa fa-instagram","url":"#instagram"},{"social":"fa fa-youtube","url":"#youtube"}],"footer_bg":"#000000","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"2","scroll_top_button":"true","accordions_style":"style_2","buttons_global_style":"style_13","forms_global_style":"style_3","pagination_style":"style_12","sidebars_global_style":"style_13","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","ga":"","google_api_key":"","logo":"125","preloader":"false","preloader_color":"#cba66f","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"center":[{"$$hashKey":"object:449","data":{"font":"hf","id":"primary","line":"","style":"fullwidth_simple"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","center","0"],"type":"menu"}]},"top":{"center":[{"$$hashKey":"object:574","data":{"url":"","uselogo":"true","width":"314"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["top","center","0"],"type":"image","value":"6"}],"left":[{"$$hashKey":"object:8521","data":{"style":"icon_only"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"socials"}],"right":[{"$$hashKey":"object:641","disabled":{"default":"","mobile":"","tablet":""},"label":"Search","order":{"mobile":"1310","tablet":"1310"},"position":["top","right","0"],"type":"search","value":"style_3"},{"$$hashKey":"object:557","disabled":{"default":"","mobile":"","tablet":""},"label":"Cart","margins":{"default":{"left":"39"}},"order":{"mobile":"2310","tablet":"2310"},"position":["top","right","1"],"type":"cart","value":"style_1"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"0","header_color":"rgba(255, 0, 0, 0)","header_text_color":"#808080","header_text_color_hover":"#000000","header_top":"52","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"header_sticky":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_12","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"9","top_bar_color":"rgba(255, 0, 0, 0)","top_bar_link_color_hover":"#cba66f","top_bar_text_color":"#000000","top_bar_top":"50","page_bc":"false","page_bc_fullwidth":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"90","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"right","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"90","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"1","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"90","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false"},"stm_services_layout":"1","stm_services_sidebar":"63","stm_services_sidebar_position":"right","stm_services_sidebar_single":"63","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_stories_layout":"1","stm_stories_sidebar_single":"90","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"false"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"3631","product_sidebar_position":"right","blockquote_style":"style_11","body_font":{"color":"#595959","fw":"400","ln":"24","ls":"","mgb":"","name":"Source Sans Pro","size":"16"},"h1_settings":{"color":"","fw":"400","ln":"42","ls":"","mgb":"","name":"","size":"42"},"h2_settings":{"color":"","fw":"400","ln":"36","ls":"","mgb":"","name":"","size":"36"},"h3_settings":{"color":"","fw":"400","ln":"30","ls":"","mgb":"","name":"","size":"30"},"h4_settings":{"color":"","fw":"400","ln":"24","ls":"","mgb":"","name":"","size":"24"},"h5_settings":{"color":"","fw":"400","ln":"18","ls":"","mgb":"","name":"","size":"18"},"h6_settings":{"color":"","fw":"400","ln":"","ls":"","mgb":"","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#000000","name":"Crimson Text","subset":""},"link_color":"#cba66f","link_hover_color":"#cba66f","list_style":"style_1","p_line_height":"25","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_church()
{
	$json = '{"post_layout":"1","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"2669","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#d9b684","secondary_color":"#789cb6","third_color":"#1a1a1a","copyright":"Welcome to Pearl","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"Multipurpose theme","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-instagram","url":"#"},{"social":"fa fa-soundcloud","url":"#"}],"footer_bg":"#1a1a1a","footer_bg_image":"1873","footer_color":"rgba(255, 255, 255, 0.7)","footer_cols":"3","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_12","forms_global_style":"style_10","pagination_style":"style_14","sidebars_global_style":"style_12","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","ga":"","google_api_key":"","logo":"8","preloader":"true","preloader_color":"","site_padding":"0","site_width":"1140","page_title_box":"true","page_title_box_align":"left","page_title_box_bg_color":"rgba(0, 0, 0, 0.35)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_11","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h2","page_title_breadcrumbs":"true","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:616","data":{"url":"","uselogo":"true","width":"190"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","margins":{"default":{"bottom":"35","top":"35"}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"6"}],"right":[{"$$hashKey":"object:471","data":{"font":"mf","fsz":"16","fwn":"fwb","id":"18","lh":"115","line":"","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","margins":{"default":{"bottom":"","right":"","top":""}},"order":{"mobile":"1099","tablet":"1199"},"position":["center","right","0"],"type":"menu"}]},"top":{"center":[{"$$hashKey":"object:1366","data":{"font":"mf","fsz":"14","id":"25","lh":"50","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"1200","tablet":"2195"},"position":["top","center","0"],"type":"menu"}],"left":[{"$$hashKey":"object:1651","disabled":{"default":"","mobile":"","tablet":""},"label":"Search","order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"search","value":"style_3"}],"right":[{"$$hashKey":"object:1725","choices":{"custom":"Custom","wpml":"WPML"},"disabled":{"default":"","mobile":"","tablet":""},"dropdown":[{"label":"English","url":"#"},{"label":"French","url":"#"}],"label":"Dropdown","order":{"mobile":"1300","tablet":"1300"},"position":["top","right","0"],"style":"style_1","type":"dropdown","value":"custom"}]}},"center_header_fullwidth":"false","header_bg":"117","header_bg_fill":"full","header_bottom":"0","header_color":"rgba(26, 26, 26, 0.5)","header_text_color":"#ffffff","header_text_color_hover":"#d9b684","header_top":"0","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"header_sticky":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_13","main_header_transparent":"true","top_bar_bg":"","top_bar_bottom":"0","top_bar_color":"#1a1a1a","top_bar_link_color_hover":"#ffffff","top_bar_text_color":"#999999","top_bar_top":"0","page_bc":"false","page_bc_fullwidth":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"true","name":"Giving","plural":"Givings","public":"true","slug":"giving"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"false","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false","public":"true"},"stm_events_layout":"4","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"false","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","media_events":{"enabled":"true","name":"Sermon","plural":"Sermons","slug":"sermons"},"stm_media_events_layout":"1","stm_media_events_sidebar_single":"false","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"","plural":"","public":"true","slug":""},"stm_projects_layout":"1","stm_projects_sidebar":"false","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"false","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"true"},"stm_stories_layout":"1","stm_stories_sidebar_single":"false","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false","public":"true"},"testimonials":{"enabled":"false"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact-us","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false","public":"true"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","blockquote_style":"style_3","body_font":{"color":"#808080","fw":"400","ln":"26","ls":"","mgb":"","name":"Quattrocento Sans","size":"16"},"h1_settings":{"color":"","fw":"700","ln":"72","ls":"1","mgb":"35","name":"","size":"60"},"h2_settings":{"color":"","fw":"700","ln":"60","ls":"-1.92","mgb":"30","name":"Libre Baskerville","size":"48"},"h3_settings":{"color":"","fw":"700","ln":"48","ls":"0.3","mgb":"30","name":"","size":"36"},"h4_settings":{"color":"","fw":"700","ln":"36","ls":"","mgb":"25","name":"","size":"30"},"h5_settings":{"color":"","fw":"700","ln":"30","ls":"-0,48","mgb":"13","name":"","size":"24"},"h6_settings":{"color":"","fw":"700","ln":"24","ls":"-0.36","mgb":"15","name":"","size":"18"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#1a1a1a","name":"Libre Baskerville","subset":""},"link_color":"#1a1a1a","link_hover_color":"#d9b684","list_style":"style_10","p_line_height":"26","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_store()
{
	$json = '{"post_layout":"13","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#000000","secondary_color":"#c64047","third_color":"#f47969","copyright":"\u00a9 2017 Modern Shop Theme by <a href=\"https:\/\/themeforest.net\/user\/stylemixthemes\">StylemixThemes<\/a>. All rights reserved","copyright_co":"false","copyright_image":"","copyright_socials":"false","copyright_year":"false","footer_bottom_bg":"#ffffff","right_text":"","stm_footer_layout":"2","footer_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-instagram","url":"#"},{"social":"fa fa-youtube-play","url":"#"}],"footer_bg":"#000000","footer_bg_image":"1873","footer_color":"#808080","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_4","forms_global_style":"style_4","pagination_style":"style_13","sidebars_global_style":"style_14","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","ga":"","google_api_key":"","logo":"5","preloader":"false","preloader_color":"#3c98ff","site_padding":"80","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"0","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"0","header_builder":{"center":{"center":[{"$$hashKey":"object:1374","data":{"url":"","uselogo":"true","width":"190"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","center","0"],"type":"image","value":"6"}],"left":[{"$$hashKey":"object:651","data":{"font":"hf","id":"30","line":"line_bottom","style":"vertical_left"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","left","0"],"type":"menu"}],"right":[{"$$hashKey":"object:1380","disabled":{"default":"","mobile":"disabled","tablet":""},"label":"Search","order":{"mobile":"1320","tablet":"1320"},"position":["center","right","0"],"type":"search","value":"style_1"},{"$$hashKey":"object:1378","disabled":{"default":"","mobile":"","tablet":""},"label":"Sign in","order":{"mobile":"1310","tablet":"1310"},"position":["center","right","1"],"type":"signin","woocommerce":"true"},{"$$hashKey":"object:432","disabled":{"default":"","mobile":"","tablet":""},"label":"Cart","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","2"],"type":"cart","value":"style_1"}]}},"center_header_fullwidth":"true","header_bg":"1898","header_bg_fill":"full","header_bottom":"29","header_color":"#ffffff","header_text_color":"#000000","header_text_color_hover":"#000000","header_top":"29","divider_h_socials_1":"","header_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-instagram","url":"#"},{"social":"fa fa-youtube-play","url":"#"}],"header_sticky":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"0","top_bar_color":"#ffffff","top_bar_link_color_hover":"#000000","top_bar_text_color":"#000000","top_bar_top":"0","page_bc":"false","page_bc_fullwidth":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"true"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"true","public":"true"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"274","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"Case","plural":"Cases","public":"false","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"false"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"store","product_sidebar":"false","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"true","blockquote_style":"style_12","body_font":{"color":"#000000","fw":"400","ln":"30","ls":"","mgb":"","name":"Encode Sans Expanded","size":"14"},"h1_settings":{"color":"#000000","fw":"700","ln":"60","ls":"-0.20","mgb":"0","name":"Raleway","size":"54"},"h2_settings":{"color":"#000000","fw":"700","ln":"48","ls":"-0.20","mgb":"0","name":"Raleway","size":"42"},"h3_settings":{"color":"#000000","fw":"700","ln":"48","ls":"-0.20","mgb":"0","name":"Raleway","size":"36"},"h4_settings":{"color":"#000000","fw":"600","ln":"42","ls":"-0.20","mgb":"","name":"Raleway","size":"30"},"h5_settings":{"color":"#000000","fw":"600","ln":"36","ls":"-0.20","mgb":"","name":"Raleway","size":"24"},"h6_settings":{"color":"#000000","fw":"700","ln":"30","ls":"-0.20","mgb":"","name":"Raleway","size":"18"},"headings_line":"true","headings_line_height":"2","headings_line_position":"right","headings_line_width":"75","secondary_font":{"color":"#000000","name":"Raleway","subset":""},"link_color":"#000000","link_hover_color":"rgb(0, 0, 0)","list_style":"style_1","p_line_height":"30","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_startup()
{
	$json = '{"post_layout":"1","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#0037c2","secondary_color":"#0037c2","third_color":"#222527","copyright":"<a target=\"_blank\" href=\"https:\/\/themeforest.net\/item\/pearl-true-multiniche-wordpress-theme\/20432158\">Pearl WordPress Theme<\/a><br\/>\nby <a target=\"_blank\" href=\"https:\/\/stylemixthemes.com\/\">StylemixThemes<\/a>","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-linkedin","url":"#"},{"social":"fa fa-dribbble","url":"#"},{"social":"fa fa-youtube-play","url":"#"},{"social":"fa fa-pinterest","url":"#"}],"footer_bg":"#1d222b","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"2","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_6","forms_global_style":"style_5","pagination_style":"style_3","sidebars_global_style":"style_1","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"true","ga":"","google_api_key":"","logo":"19","preloader":"false","preloader_color":"#3c98ff","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:5804","data":{"url":"","uselogo":"true","width":"209"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"6"}],"right":[{"$$hashKey":"object:458","data":{"font":"hf","fwn":"fwsb","id":"15","line":"line_bottom","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","0"],"type":"menu"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"31","header_color":"rgba(41, 55, 66, 0)","header_text_color":"#ffffff","header_text_color_hover":"#222527","header_top":"31","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"header_sticky":"","header_sticky_bg":"#222527","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"25","top_bar_color":"#222222","top_bar_link_color_hover":"#0077ff","top_bar_text_color":"#ffffff","top_bar_top":"25","page_bc":"true","page_bc_fullwidth":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_3","body_font":{"color":"#222222","fw":"400","ln":"24","ls":"","mgb":"","name":"Open Sans","size":"14"},"h1_settings":{"color":"","fw":"700","ln":"90","ls":"1","mgb":"35","name":"","size":"90"},"h2_settings":{"color":"","fw":"600","ln":"80","ls":"1.6","mgb":"35","name":"","size":"80"},"h3_settings":{"color":"","fw":"500","ln":"40","ls":"","mgb":"","name":"","size":"28"},"h4_settings":{"color":"","fw":"500","ln":"22","ls":"","mgb":"25","name":"","size":"18"},"h5_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"20","name":"","size":"15"},"h6_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"15","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#222527","name":"Poppins","subset":""},"link_color":"#222527","link_hover_color":"#222527","list_style":"style_1","p_line_height":"25","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_viral()
{
	$json = '{"post_layout":"17","post_sidebar":"318","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"grid","stm_post_popular_day":"9","stm_post_popular_month":"30","stm_post_popular_top":"50","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"318","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"rgb(0, 0, 0)","secondary_color":"#289dfd","third_color":"#289dfd","copyright":"Pearl Viral WordPress Theme. All Rights Reserved","copyright_co":"true","copyright_image":"","copyright_socials":"false","copyright_year":"true","footer_bottom_bg":"","right_text":"<a href=\"#\">Privacy Policy<\/a> <a href=\"#\">Terms of Use<\/a> <a href=\"#\">Site Map<\/a>","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-instagram","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-youtube-play","url":"#"}],"footer_bg":"#000000","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"3","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_3","forms_global_style":"style_4","pagination_style":"style_3","sidebars_global_style":"style_15","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"34","preloader":"true","preloader_color":"","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_10","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#ffffff","bottom_bar_link_colorhover":"#289dfd","bottom_bar_text_color":"#000000","bottom_bar_top":"15","header_builder":{"center":{"center":[{"$$hashKey":"object:487","data":{"font":"hf","id":"16","line":"","lineColor":"","menuLinkColor":"#000000","menuLinkColorOnHover":"#289dfd","style":"fullwidth_simple","textColor":"#ff0000","textColored":"#9a1616","texthoverColor":"#ffffff"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","center","0"],"type":"menu"}],"left":[{"$$hashKey":"object:1420","disabled":{"default":"","mobile":"","tablet":""},"filter":[{"color":"#ff0000","icon":"stmicon-viral_hot","label":"Hot","url":"#"},{"color":"#ffaa00","icon":"stmicon-viral_popular","label":"Popular","url":"#"},{"color":"#40bf00","icon":"stmicon-viral_clock_small","label":"Latest","url":"#"},{"color":"#289dfd","icon":"stmicon-viral_trending","label":"Trending","url":"#"}],"label":"Post Filter","order":{"mobile":"2110","tablet":"2110"},"position":["center","left","0"],"type":"filter","value":"custom"},{"$$hashKey":"object:10258","data":{"url":"","uselogo":"true","width":"169"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","1"],"type":"image","value":"6"}],"right":[{"$$hashKey":"object:502","data":{"icon":"","text":"Subscribe"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Popup","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","0"],"type":"popup","value":"471"},{"$$hashKey":"object:615","data":{"style":"icon_hidden"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","order":{"mobile":"2320","tablet":"2320"},"position":["center","right","1"],"type":"socials"},{"$$hashKey":"object:818","disabled":{"default":"","mobile":"","tablet":""},"label":"Search","order":{"mobile":"1300","tablet":"1300"},"position":["center","right","2"],"type":"search","value":"style_1"}]}},"center_header_fullwidth":"true","header_bg":"1898","header_bg_fill":"full","header_bottom":"0","header_color":"rgb(255, 255, 255)","header_text_color":"#000000","header_text_color_hover":"#289dfd","header_top":"0","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"header_sticky":"center","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_14","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"34","top_bar_color":"#ffffff","top_bar_link_color_hover":"#289dfd","top_bar_text_color":"#000000","top_bar_top":"29","page_bc":"false","page_bc_fullwidth":"false","page_pre_content":"313","page_pre_content_box":"true","page_pre_footer":"295","page_pre_footer_box":"true","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false","public":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"false"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_3","body_font":{"color":"#404040","fw":"400","ln":"30","ls":"","mgb":"","name":"Roboto","size":"16"},"h1_settings":{"color":"#000000","fw":"700","ln":"48","ls":"-0.40","mgb":"0","name":"Poppins","size":"36"},"h2_settings":{"color":"#000000","fw":"700","ln":"42","ls":"-0.40","mgb":"0","name":"Poppins","size":"30"},"h3_settings":{"color":"#000000","fw":"700","ln":"36","ls":"-0.40","mgb":"0","name":"Poppins","size":"24"},"h4_settings":{"color":"#000000","fw":"700","ln":"34","ls":"-0.40","mgb":"0","name":"Poppins","size":"22"},"h5_settings":{"color":"#000000","fw":"600","ln":"30","ls":"-0.20","mgb":"0","name":"Poppins","size":"18"},"h6_settings":{"color":"#000000","fw":"600","ln":"24","ls":"0","mgb":"0","name":"Poppins","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#000000","name":"Poppins","subset":""},"link_color":"#000000","link_hover_color":"#289dfd","list_style":"style_1","p_line_height":"30","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_magazine()
{
	$json = '{"post_layout":"21","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"false","post_comments":"true","post_image":"false","post_info":"true","post_share":"false","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#0089d8","secondary_color":"#0089d8","third_color":"#222222","copyright":"<a class=\"wtc mtc_h no_deco\" href=\"http:\/\/stylemixthemes.com\">Stylemixthemes<\/a>","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"#222222","right_text":"<a class=\"wtc mtc_h no_deco\" href=\"#\" style=\"margin-right: 30px\"><i style=\"margin-right: 5px\" class=\"fa fa-caret-right\"><\/i>Privacy & cookie policy<\/a>\n<a class=\"wtc mtc_h no_deco\" href=\"#\"><i style=\"margin-right: 5px\" class=\"fa fa-caret-right\"><\/i>Terms and condition<\/a>","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-facebook","url":"#"}],"footer_bg":"#ffffff","footer_bg_image":"1873","footer_color":"#222222","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_14","forms_global_style":"style_11","pagination_style":"style_8","sidebars_global_style":"style_16","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"190","preloader":"false","preloader_color":"#3c98ff","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_12","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:464","data":{"font":"mf","fsz":"13","fwn":"fwl","id":"10","line":"","menuLinkColor":"#000000","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","left","0"],"type":"menu"}],"right":[{"$$hashKey":"object:1395","disabled":{"default":"","mobile":"","tablet":""},"label":"Search","order":{"mobile":"2300","tablet":"2300"},"position":["center","right","0"],"type":"search","value":"style_5"}]},"top":{"center":[{"$$hashKey":"object:451","data":{"url":"","uselogo":"true","width":"207"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["top","center","0"],"type":"image","value":"6"}],"left":[{"$$hashKey":"object:549","disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Socials","order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"socials"},{"$$hashKey":"object:539","data":{"style":"btn_solid","text":"SUBSCRIBE","url":"#"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Button","order":{"mobile":"1110","tablet":"1110"},"position":["top","left","1"],"type":"button"}],"right":[{"$$hashKey":"object:1377","data":{"font":"mf","fsz":"13","fwn":"fwl","id":"11","menuLinkColor":"#222222","style":"default"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Menu","order":{"mobile":"1300","tablet":"1300"},"position":["top","right","0"],"type":"menu"},{"$$hashKey":"object:498","disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Weather widget","margins":{"default":{"left":"40"}},"order":{"mobile":"2310","tablet":"2310"},"position":["top","right","1"],"type":"weather","value":{"city":"Moscow","units":"metric"}},{"$$hashKey":"object:442","disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Font resizer","order":{"mobile":"1320","tablet":"1320"},"position":["top","right","2"],"type":"font-resizer"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"52","header_color":"rgb(255, 255, 255)","header_text_color":"#000000","header_text_color_hover":"#3c98ff","header_top":"52","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-youtube-play","url":"#"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_15","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"25","top_bar_color":"#f1f2f3","top_bar_link_color_hover":"#0077ff","top_bar_text_color":"#222222","top_bar_top":"25","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"false"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_13","body_font":{"color":"#252525","fw":"200","ln":"32","ls":"","mgb":"","name":"Merriweather","size":"18"},"h1_settings":{"color":"","fw":"700","ln":"50","ls":"1","mgb":"30","name":"","size":"45"},"h2_settings":{"color":"","fw":"700","ln":"","ls":"0.5","mgb":"35","name":"","size":"35"},"h3_settings":{"color":"","fw":"700","ln":"33","ls":"0","mgb":"12","name":"","size":"28"},"h4_settings":{"color":"","fw":"700","ln":"","ls":"3.2","mgb":"25","name":"","size":"16"},"h5_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"20","name":"","size":"15"},"h6_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"15","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"bottom","headings_line_width":"45","secondary_font":{"color":"#222222","name":"Playfair Display","subset":""},"link_color":"#222222","link_hover_color":"#0089d8","list_style":"style_10","p_line_height":"32","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_lawyer()
{
	$json = '{"post_layout":"1","post_sidebar":"false","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"false","post_sidebar_single_position":"left","post_tags":"true","post_title":"true","main_color":"#f5a64b","secondary_color":"#854836","third_color":"#000000","copyright":"Personal Lawyer WordPress Theme. All rights reserved","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes\/"},{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-dribbble","url":"https:\/\/dribbble.com\/stylemix"},{"social":"fa fa-pinterest","url":"https:\/\/www.pinterest.com\/stylemixthemes"}],"footer_bg":"#000000","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_15","forms_global_style":"style_5","pagination_style":"style_10","sidebars_global_style":"style_1","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"20","preloader":"false","preloader_color":"#3c98ff","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:563","data":{"url":"","uselogo":"true","width":"229"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"6"}],"right":[{"$$hashKey":"object:7185","data":{"font":"hf","fsz":"14","fwn":"fwsb","id":"primary","line":"line_bottom","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","0"],"type":"menu"}]},"top":{"center":[{"$$hashKey":"object:518","data":{"fsz":"14","icon":"stmicon-lawyer_envelope","ifsz":"16","title":"hello@amandapearl.com"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","margins":{"default":{"left":"30","right":""},"mobile":{"right":""},"tablet":{"right":""}},"order":{"mobile":"1100","tablet":"1100"},"position":["top","center","0"],"type":"icontext"}],"left":[{"$$hashKey":"object:490","data":{"fsz":"14","icon":"stmicon-lawyer_iphone","ifsz":"16","title":"+1 376-226-3126"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","margins":{"default":{"right":""},"mobile":{"right":""},"tablet":{"right":""}},"order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"icontext"}],"right":[{"$$hashKey":"object:546","data":{"fsz":"14","icon":"stmicon-lawyer_pin","ifsz":"16","title":"1024 Infinity Ave, Sacramento, CA 95014, USA"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","margins":{"default":{"right":"100"},"tablet":{"right":"50"}},"order":{"mobile":"1100","tablet":"1100"},"position":["top","right","0"],"type":"icontext"},{"$$hashKey":"object:5820","data":{"style":"icon_only"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Socials","order":{"mobile":"1300","tablet":"1300"},"position":["top","right","1"],"type":"socials"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"0","header_color":"#ffffff","header_text_color":"#000000","header_text_color_hover":"#f5a64b","header_top":"0","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes"},{"social":"fa fa-instagram","url":"https:\/\/www.instagram.com\/stylemixthemes"},{"social":"fa fa-youtube-play","url":"https:\/\/www.youtube.com\/channel\/UCpuJgzrLAbVKCHDo_1lluKA"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_16","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"9","top_bar_color":"#ffffff","top_bar_link_color_hover":"#f00","top_bar_text_color":"#000000","top_bar_top":"9","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"default","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"1","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"false","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"false","public":"true"},"stm_services_layout":"1","stm_services_sidebar":"default","stm_services_sidebar_position":"right","stm_services_sidebar_single":"false","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_stories_layout":"1","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_3","body_font":{"color":"#595959","fw":"400","ln":"36","ls":"","mgb":"","name":"Barlow","size":"18"},"h1_settings":{"color":"","fw":"600","ln":"60","ls":"-0.2","mgb":"35","name":"","size":"54"},"h2_settings":{"color":"","fw":"600","ln":"48","ls":"-0.2","mgb":"35","name":"","size":"48"},"h3_settings":{"color":"","fw":"600","ln":"48","ls":"","mgb":"30","name":"","size":"36"},"h4_settings":{"color":"","fw":"600","ln":"36","ls":"-0.2","mgb":"25","name":"","size":"30"},"h5_settings":{"color":"","fw":"600","ln":"30","ls":"","mgb":"20","name":"","size":"24"},"h6_settings":{"color":"","fw":"600","ln":"24","ls":"","mgb":"15","name":"","size":"20"},"headings_line":"false","headings_line_height":"5","headings_line_position":"right","headings_line_width":"45","secondary_font":{"color":"#000000","name":"Barlow","subset":""},"link_color":"#000000","link_hover_color":"#000000","list_style":"style_7","p_line_height":"36","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_factory()
{
	$json = '{"post_layout":"23","post_sidebar":"533","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"grid","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"false","post_info":"true","post_share":"true","post_sidebar_single":"535","post_sidebar_single_position":"left","post_tags":"true","post_title":"true","main_color":"#297ee8","secondary_color":"#222222","third_color":"#297ee8","copyright":"Pearl by Stylemix Themes. All rights reserved","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"","stm_footer_layout":"3","footer_socials":[{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes\/"},{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-instagram","url":"https:\/\/www.instagram.com\/stylemixthemes\/"}],"footer_bg":"#3d3d3d","footer_bg_image":"","footer_color":"#fff","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_1","buttons_global_style":"style_17","forms_global_style":"style_2","pagination_style":"style_15","sidebars_global_style":"style_17","tabs_style":"style_1","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"4","preloader":"false","preloader_color":"","site_padding":"0","site_width":"1140","page_title_box":"true","page_title_box_align":"center","page_title_box_bg_image":"304","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"","page_title_button_url":"","bottom_bar_bg":"","bottom_bar_bottom":"0","bottom_bar_color":"#f00","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#f00","bottom_bar_top":"0","header_builder":{"center":{"left":[{"$$hashKey":"object:1865","data":{"font":"hf","id":"2","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2100","tablet":"2100"},"position":["center","left","0"],"type":"menu"}],"right":[{"$$hashKey":"object:2401","disabled":{"default":"","mobile":"","tablet":""},"label":"Search","order":{"mobile":"2300","tablet":"2300"},"position":["center","right","0"],"type":"search","value":"style_1"},{"$$hashKey":"object:600","choices":{"custom":"Custom","wpml":"WPML"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Dropdown","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","1"],"style":"style_1","type":"dropdown","value":"wpml"}]},"top":{"center":[{"$$hashKey":"object:1808","data":{"size":"","style":"icon_only"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","order":{"mobile":"1200","tablet":"1200"},"position":["top","center","0"],"type":"socials"}],"left":[{"$$hashKey":"object:572","data":{"url":"\/","uselogo":"true"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"image"}],"right":[{"$$hashKey":"object:884","data":{"address":{"undefined":{"address":"1840 E Garvey Ave South West Covina, CA 91791","addressTitle":"Adress","hours":"Mon - Fri: 09:00AM - 09:00PM\nSaturday: 09:00AM - 07:00PM\nSunday: Closed","hoursTitle":"Sales Hours","lat":"34.070350","long":"-117.905616","phone":"123-456-789","position":"6","title":"Office:"}}},"disabled":{"default":"","mobile":"","tablet":""},"label":"Address","order":{"mobile":"1300","tablet":"1300"},"position":["top","right","0"],"type":"address"},{"$$hashKey":"object:910","data":{"address":{"undefined":{"address":"1840 E Garvey Ave South West Covina, CA 91791","addressTitle":"Adress","hours":"Mon - Fri: 09:00AM - 09:00PM\nSaturday: 09:00AM - 07:00PM\nSunday: Closed","hoursTitle":"Sales Hours","lat":"34.070350","long":"-117.905616","phone":"123-456-789","position":"5","title":"Factory:"}}},"disabled":{"default":"","mobile":"","tablet":""},"label":"Address","order":{"mobile":"1300","tablet":"1300"},"position":["top","right","1"],"type":"address"},{"$$hashKey":"object:466","data":{"style":"btn_solid","text":"Get a quote","url":"\/contacts\/"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Button","order":{"mobile":"1310","tablet":"1310"},"position":["top","right","2"],"type":"button"}]}},"center_header_fullwidth":"false","header_bg":"","header_bg_fill":"full","header_bottom":"10","header_color":"rgba(255, 255, 255, 0)","header_text_color":"#ffffff","header_text_color_hover":"#ffffff","header_top":"10","divider_h_socials_1":"","header_socials":[{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes\/"},{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-youtube-play","url":"https:\/\/www.youtube.com\/channel\/UCpuJgzrLAbVKCHDo_1lluKA"},{"social":"fa fa-instagram","url":"https:\/\/www.instagram.com\/stylemixthemes\/"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_17","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"20","top_bar_color":"#ffffff","top_bar_link_color_hover":"#999999","top_bar_text_color":"#999999","top_bar_top":"20","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"","error_page_style":"style_1","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"20","stm_donations_amount_3":"30","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false","public":"false"},"stm_events_layout":"left","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"default","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"left","stm_events_view":"list","divider_media_events_1":"","stm_media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","products":{"enabled":"true","has_archive":"false","public":"true"},"stm_products_layout":"1","stm_products_sidebar":"false","stm_products_sidebar_position":"left","stm_products_sidebar_single":"false","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"default","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"left","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false"},"stm_services_layout":"left","stm_services_sidebar":"default","stm_services_sidebar_position":"left","stm_services_sidebar_single":"default","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"","stm_vacancies_button_url":"","stm_vacancies_details":"true","stm_vacancies_layout_single":"left","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"default","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"default","product_sidebar_position":"left","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_1","body_font":{"color":"#565656","fw":"300","ln":"34","ls":"","mgb":"","name":"Roboto","size":"18"},"h1_settings":{"color":"#111111","fw":"300","ln":"70","ls":"","mgb":"20","name":"Roboto","size":"70"},"h2_settings":{"color":"#111111","fw":"300","ln":"65","ls":"-0.5","mgb":"20","name":"Roboto","size":"60"},"h3_settings":{"color":"#111111","fw":"300","ln":"65","ls":"-0.5","mgb":"20","name":"Roboto","size":"50"},"h4_settings":{"color":"#111111","fw":"300","ln":"55","ls":"-0.5","mgb":"20","name":"Roboto","size":"45"},"h5_settings":{"color":"#111111","fw":"300","ln":"38","ls":"","mgb":"20","name":"Roboto","size":"35"},"h6_settings":{"color":"#111111","fw":"300","ln":"30","ls":"","mgb":"20","name":"Roboto","size":"30"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#111111","name":"Roboto","subset":""},"link_color":"#3c98ff","link_hover_color":"#3c98ff","list_style":"style_1","p_line_height":"22","p_margin_bottom":"15"}';
	return $json;
}

function stm_theme_options_psychologist()
{
	$json = '{"post_layout":"24","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"false","post_comments":"true","post_image":"false","post_info":"false","post_share":"true","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"false","main_color":"#3f51b5","secondary_color":"#3f51b5","third_color":"#212121","copyright":"StylemixThemes. All rights reserved.","copyright_co":"true","copyright_image":"","copyright_socials":"false","copyright_year":"true","footer_bottom_bg":"#151515","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-instagram","url":"#"},{"social":"fa fa-linkedin","url":"#"},{"social":"fa fa-google-plus","url":"#"}],"footer_bg":"#262626","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"3","scroll_top_button":"false","accordions_style":"style_7","buttons_global_style":"style_16","forms_global_style":"style_12","pagination_style":"style_15","sidebars_global_style":"style_18","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"9","preloader":"true","preloader_color":"#3c98ff","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_13","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"center":[{"$$hashKey":"object:500","data":{"font":"mf","fsz":"18","fwn":"fwn","id":"2","lh":"60","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","margins":{"default":{"bottom":"30","top":"30"},"mobile":{"bottom":"15","top":"15"},"tablet":{"bottom":"15","top":"15"}},"order":{"mobile":"2200","tablet":"2200"},"position":["center","center","0"],"type":"menu"}],"left":[{"$$hashKey":"object:841","data":{"url":"\/psychologist","uselogo":"true","width":"230"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","order":{"mobile":"1100","tablet":"1100"},"position":["center","left","0"],"type":"image"}],"right":[{"$$hashKey":"object:460","data":{"icon":"stmicon-psychologist_calendar","icon_size":"36","icon_size0":"36","style":"btn_solid","text":"Make an<br>  Appointment","url":"\/contacts\/"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Button","margins":{"default":{"left":"","right":""}},"order":{"mobile":"2300","tablet":"2300"},"position":["center","right","0"],"type":"button"}]},"top":{"left":[{"$$hashKey":"object:985","data":{"fwn":"fwn"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Text","order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"text","value":"Have any questions?"},{"$$hashKey":"object:1347","data":{"fsz":"13","icon":"stmicon-phone","title":"020 8567 8516"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Text with icon","order":{"mobile":"1110","tablet":"1110"},"position":["top","left","1"],"type":"icontext"},{"$$hashKey":"object:943","data":{"fsz":"13","icon":"stmicon-envelope2","title":"020 8567 8516"},"disabled":{"default":"","mobile":"disabled","tablet":"disabled"},"label":"Text with icon","order":{"mobile":"1110","tablet":"1110"},"position":["top","left","2"],"type":"icontext"}],"right":[{"$$hashKey":"object:1817","data":{"size":"icon_11px","style":"icon_only"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","margins":{"default":{"right":"0"},"mobile":{"right":"0"},"tablet":{"right":"0"}},"order":{"mobile":"1300","tablet":"1300"},"position":["top","right","0"],"type":"socials"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"0","header_color":"rgba(255, 255, 255, 0)","header_text_color":"#23282d","header_text_color_hover":"#3f51b5","header_top":"0","divider_h_socials_1":"","header_socials":[{"social":"fa fa-facebook","url":"fb.me"},{"social":"fa fa-twitter","url":"twitter.com"},{"social":"fa fa-instagram","url":"insta.gg"},{"social":"fa fa-linkedin","url":"linkedin.com"},{"social":"fa fa-google-plus","url":"plus.google.com"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_18","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"8","top_bar_color":"#eaeff2","top_bar_link_color_hover":"#0077ff","top_bar_text_color":"#656768","top_bar_top":"8","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"false","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","stm_media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","stm_products_layout":"default","stm_products_sidebar":"default","stm_products_sidebar_position":"left","stm_products_sidebar_single":"default","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"false","public":"true"},"stm_services_layout":"1","stm_services_sidebar":"false","stm_services_sidebar_position":"right","stm_services_sidebar_single":"false","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"false","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_14","body_font":{"color":"#222222","fw":"400","ln":"24","ls":"","mgb":"","name":"Open Sans","size":"15"},"h1_settings":{"color":"","fw":"700","ln":"80","ls":"1","mgb":"35","name":"","size":"72"},"h2_settings":{"color":"","fw":"500","ln":"44","ls":"0","mgb":"35","name":"Raleway","size":"38"},"h3_settings":{"color":"","fw":"700","ln":"30","ls":"","mgb":"30","name":"","size":"24"},"h4_settings":{"color":"","fw":"900","ln":"24","ls":"1.8","mgb":"25","name":"","size":"18"},"h5_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"20","name":"","size":"15"},"h6_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"15","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#181f45","name":"Raleway","subset":""},"link_color":"#333333","link_hover_color":"#3f51b5","list_style":"style_1","p_line_height":"30","p_margin_bottom":"28"}';

	return $json;
}

function stm_theme_options_company()
{
    $json = '{"post_layout":"2","post_sidebar":"2317","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"2317","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#ec1111","secondary_color":"#ec1111","third_color":"#222222","copyright":"Pearl  a <a href=\"http:\/\/pearl.stylemixthemes.com\/landing\/\" target=\"_blank\">Multipurpose WordPress Theme<\/a> by <a href=\"https:\/\/stylemixthemes.com\/\" target=\"-blank\">StylemixThemes<\/a>.","copyright_co":"true","copyright_image":"","copyright_socials":"false","copyright_year":"true","footer_bottom_bg":"","right_text":"","stm_footer_layout":"2","footer_socials":[{"social":"fa fa-linkedin","url":"https:\/\/www.linkedin.com\/"},{"social":"fa fa-google-plus","url":"https:\/\/www.google.com\/"},{"social":"fa fa-twitter","url":"twitter.com"},{"social":"fa fa-facebook","url":"fb.com"}],"footer_bg":"#30353a","footer_bg_image":"","footer_color":"#fff","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_9","forms_global_style":"style_2","pagination_style":"style_17","sidebars_global_style":"style_19","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"2658","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"3651","preloader":"false","preloader_color":"#ea3a60","site_padding":"0","site_width":"1140","page_title_box":"true","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#ff3c65","bottom_bar_link_colorhover":"#ff3c65","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:384","data":{"url":"","uselogo":"true","width":"224"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"3418"}],"right":[{"$$hashKey":"object:1206","data":{"id":"2","line":"line_bottom","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","0"],"type":"menu"}]},"top":{"right":[{"$$hashKey":"object:880","data":{"icon":"stmicon-bon-envelope","ifsz":"14","title":"Info@stylemixthemes.com"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","order":{"mobile":"1300","tablet":"1300"},"position":["top","right","0"],"type":"icontext"},{"$$hashKey":"object:1265","data":{"icon":"stmicon-company-phone","ifsz":"15","title":"+1 00 974 4012 0320"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","order":{"mobile":"1310","tablet":"1310"},"position":["top","right","1"],"type":"icontext"},{"$$hashKey":"object:1314","data":{"style":"square"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","order":{"mobile":"1320","tablet":"1320"},"position":["top","right","2"],"type":"socials"}]}},"center_header_fullwidth":"false","header_bg":"3838","header_bg_fill":"full","header_bottom":"24","header_color":"rgba(41, 55, 66, 0.8)","header_text_color":"#ffffff","header_text_color_hover":"#ec1111","header_top":"24","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_19","main_header_transparent":"true","top_bar_bg":"","top_bar_bottom":"5","top_bar_color":"#222222","top_bar_link_color_hover":"#ff3c65","top_bar_text_color":"#ffffff","top_bar_top":"3","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"20","stm_donations_amount_3":"30","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"2234","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"right","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false","public":"true"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","stm_media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","products":{"enabled":"false"},"stm_products_layout":"left","stm_products_sidebar":"default","stm_products_sidebar_position":"left","stm_products_sidebar_single":"default","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"false"},"stm_services_layout":"grid_1","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"1","stm_stories_sidebar_single":"2234","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"right","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_3","body_font":{"color":"#222222","fw":"400","ln":"24","ls":"","mgb":"","name":"Open Sans","size":"14"},"h1_settings":{"color":"","fw":"600","ln":"50","ls":"-1.5","mgb":"","name":"","size":"50"},"h2_settings":{"color":"","fw":"600","ln":"36","ls":"-1.7","mgb":"","name":"","size":"35"},"h3_settings":{"color":"","fw":"600","ln":"42","ls":"-1.7","mgb":"24","name":"","size":"35"},"h4_settings":{"color":"","fw":"600","ln":"32","ls":"-0.4","mgb":"","name":"","size":"26"},"h5_settings":{"color":"","fw":"600","ln":"22","ls":"-1.7","mgb":"","name":"","size":"18"},"h6_settings":{"color":"","fw":"600","ln":"18","ls":"3.8","mgb":"","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#23282d","name":"Montserrat","subset":""},"link_color":"#ff3c65","link_hover_color":"#ff3c65","list_style":"style_3","p_line_height":"25","p_margin_bottom":"25"}';
    return $json;
}

function stm_theme_options_corporate() {
	$json = '{"post_layout":"1","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#1c41df","secondary_color":"#1c41df","third_color":"#333333","copyright":"Pearl Corporate Theme by <a class=\"mtc\" href=\"http:\/\/stylemixthemes.com\" title=\"Stylemix\">Stylemix Themes<\/a>. All rights reserved","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"#262626","right_text":"","stm_footer_layout":"3","footer_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-instagram","url":"#"}],"footer_bg":"#000000","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"2","scroll_top_button":"false","accordions_style":"style_2","buttons_global_style":"style_18","forms_global_style":"style_3","pagination_style":"style_18","sidebars_global_style":"style_1","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"AIzaSyC9Jykpqu1A4BOgt9VaHBFwx0huaNrhscc","logo":"3799","preloader":"true","preloader_color":"#3c98ff","site_padding":"0","site_width":"1140","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:1029","data":{"url":"","uselogo":"true","width":"250"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"6"}],"right":[{"$$hashKey":"object:632","disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","order":{"mobile":"2300","tablet":"2300"},"position":["center","right","0"],"type":"socials"},{"$$hashKey":"object:534","data":{"font":"hf","fsz":"14","fwn":"fwb","hamburgerIconColor":"#ffffff","id":"26","style":"hamburger"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2200","tablet":"2200"},"position":["center","right","1"],"type":"menu"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"52","header_color":"rgba(41, 55, 66, 0.8)","header_text_color":"#ffffff","header_text_color_hover":"#3c98ff","header_top":"52","divider_h_socials_1":"","header_socials":[{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-instagram","url":"#"}],"header_sticky":"","header_sticky_bg":"#292929","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"true","top_bar_bg":"","top_bar_bottom":"25","top_bar_color":"#222222","top_bar_link_color_hover":"#0077ff","top_bar_text_color":"#ffffff","top_bar_top":"25","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"true"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"true"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false","public":"true"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","stm_products_layout":"left","stm_products_sidebar":"default","stm_products_sidebar_position":"left","stm_products_sidebar_single":"default","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","has_archive":"false","name":"Work","plural":"Works","slug":"works"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"true"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"true"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"true"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_3","body_font":{"color":"#2d2d2c","fw":"400","ln":"30","ls":"0.4","mgb":"","name":"Open Sans","size":"16"},"h1_settings":{"color":"","fw":"700","ln":"70","ls":"1.5","mgb":"35","name":"","size":"60"},"h2_settings":{"color":"","fw":"700","ln":"60","ls":"0.5","mgb":"35","name":"","size":"48"},"h3_settings":{"color":"","fw":"700","ln":"36","ls":"0.3","mgb":"30","name":"","size":"24"},"h4_settings":{"color":"","fw":"700","ln":"30","ls":"","mgb":"25","name":"","size":"22"},"h5_settings":{"color":"","fw":"400","ln":"24","ls":"","mgb":"20","name":"Open Sans","size":"18"},"h6_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"15","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#333333","name":"Montserrat","subset":""},"link_color":"#3c98ff","link_hover_color":"#3c98ff","list_style":"style_1","p_line_height":"30","p_margin_bottom":"25"}';
	return $json;
}

function stm_theme_options_furniture() {
	$json = '{"post_layout":"23","post_sidebar":"533","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"grid","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"false","post_info":"true","post_share":"true","post_sidebar_single":"535","post_sidebar_single_position":"left","post_tags":"true","post_title":"true","main_color":"#ffbb00","secondary_color":"#ffbb00","third_color":"#333333","copyright":"Pearl Furniture by Stylemix Themes. All rights reserved","copyright_co":"true","copyright_image":"","copyright_socials":"false","copyright_year":"true","footer_bottom_bg":"#fff","footer_bottom_color":"#333333","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes\/"},{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-instagram","url":"https:\/\/www.instagram.com\/stylemixthemes\/"},{"social":"fa fa-youtube-play","url":"#"}],"footer_bg":"#1f1f1f","footer_bg_image":"","footer_color":"#fff","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_1","buttons_global_style":"style_19","forms_global_style":"style_4","pagination_style":"style_15","sidebars_global_style":"style_20","tabs_style":"style_1","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"4001","preloader":"false","preloader_color":"","site_padding":"0","site_width":"1140","page_title_box":"true","page_title_box_align":"center","page_title_box_bg_image":"3724","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"","page_title_button_url":"","bottom_bar_bg":"","bottom_bar_bottom":"0","bottom_bar_color":"#f00","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#f00","bottom_bar_top":"0","header_builder":{"center":{"left":[{"$$hashKey":"object:2442","data":{"url":"\/","uselogo":"true","width":"215"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","margins":{"default":{"bottom":"","top":""},"mobile":{"bottom":"","top":""},"tablet":{"bottom":"","top":""}},"order":{"mobile":"1100","tablet":"1100"},"position":["center","left","0"],"type":"image"}],"right":[{"$$hashKey":"object:2537","data":{"font":"mf","fsz":"16","fwn":"fwn","id":"2","lh":"105","menuLinkColorOnHover":"#ff000","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","margins":{"default":{"bottom":"","top":""},"mobile":{"bottom":"","top":""},"tablet":{"bottom":"","top":""}},"order":{"mobile":"2100","tablet":"2100"},"position":["center","right","0"],"type":"menu"},{"$$hashKey":"object:2401","disabled":{"default":"","mobile":"","tablet":""},"label":"Search","order":{"mobile":"2300","tablet":"2300"},"position":["center","right","1"],"type":"search","value":"style_1"}]},"top":{"left":[{"$$hashKey":"object:6974","disabled":{"default":"","mobile":"","tablet":""},"label":"Text","order":{"mobile":"1100","tablet":"1100"},"position":["top","left","0"],"type":"text","value":"Have any questions?"},{"$$hashKey":"object:7184","data":{"fsz":"13","icon":"stmicon-phone","ifsz":"14","title":"+1 376-226-3126"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","order":{"mobile":"1110","tablet":"1110"},"position":["top","left","1"],"type":"icontext"},{"$$hashKey":"object:7814","data":{"fsz":"13","icon":"stmicon-email","ifsz":"13","title":"info@stylemixthemes.com"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Text with icon","order":{"mobile":"1110","tablet":"1110"},"position":["top","left","2"],"type":"icontext"}],"right":[{"$$hashKey":"object:6838","choices":{"custom":"Custom","wpml":"WPML"},"disabled":{"default":"","mobile":"","tablet":""},"dropdown":[{"label":"English","url":"#"},{"label":"French","url":"#"}],"label":"Dropdown","order":{"mobile":"1310","tablet":"1310"},"position":["top","right","0"],"style":"style_1","type":"dropdown","value":"custom"},{"$$hashKey":"object:537","data":{"size":"","style":"icon_only"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Socials","order":{"mobile":"1200","tablet":"1200"},"position":["top","right","1"],"type":"socials"}]}},"center_header_fullwidth":"false","header_bg":"","header_bg_fill":"full","header_bottom":"0","header_color":"rgb(55, 55, 55)","header_text_color":"#ffffff","header_text_color_hover":"#ffffff","header_top":"0","divider_h_socials_1":"","header_socials":[{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes\/"},{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-youtube-play","url":"https:\/\/www.youtube.com\/channel\/UCpuJgzrLAbVKCHDo_1lluKA"},{"social":"fa fa-instagram","url":"https:\/\/www.instagram.com\/stylemixthemes\/"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_20","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"7","top_bar_color":"rgb(31, 31, 31)","top_bar_link_color_hover":"#999999","top_bar_text_color":"rgba(255, 255, 255, 0.5)","top_bar_top":"7","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"","error_page_style":"style_1","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"20","stm_donations_amount_3":"30","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false","has_archive":"false","public":"false"},"stm_events_layout":"left","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"default","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"left","stm_events_view":"list","divider_media_events_1":"","stm_media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","products":{"enabled":"true","has_archive":"false","public":"true"},"stm_products_layout":"3","stm_products_sidebar":"false","stm_products_sidebar_position":"left","stm_products_sidebar_single":"false","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"false"},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"default","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"left","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"false"},"stm_services_layout":"left","stm_services_sidebar":"default","stm_services_sidebar_position":"left","stm_services_sidebar_single":"default","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"","stm_vacancies_button_url":"","stm_vacancies_details":"true","stm_vacancies_layout_single":"left","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"default","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"default","product_sidebar_position":"left","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_1","body_font":{"color":"#333333","fw":"400","ln":"30","ls":"","mgb":"","name":"Open Sans","size":"16"},"h1_settings":{"color":"#333333","fw":"700","ln":"80","ls":"","mgb":"20","name":"Roboto Slab","size":"72"},"h2_settings":{"color":"#333333","fw":"700","ln":"65","ls":"-0.5","mgb":"25","name":"","size":"48"},"h3_settings":{"color":"#333333","fw":"700","ln":"48","ls":"","mgb":"20","name":"","size":"30"},"h4_settings":{"color":"#333333","fw":"700","ln":"36","ls":"-0.5","mgb":"20","name":"","size":"24"},"h5_settings":{"color":"#333333","fw":"700","ln":"30","ls":"","mgb":"5","name":"Open Sans","size":"16"},"h6_settings":{"color":"#333333","fw":"300","ln":"30","ls":"","mgb":"5","name":"Roboto","size":"30"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#333333","name":"Roboto Slab","subset":""},"link_color":"#000000","link_hover_color":"#ffdd00","list_style":"style_1","p_line_height":"30","p_margin_bottom":"15"}';
	return $json;
}

function stm_theme_options_renovation() {
	$json = '{"post_layout":"7","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"left","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"default","post_sidebar_single_position":"left","post_tags":"true","post_title":"true","main_color":"#dd3939","secondary_color":"#dd3939","third_color":"#34495e","copyright":"","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","footer_bottom_color":"","right_text":"","stm_footer_layout":"1","footer_socials":"","footer_bg":"#34495e","footer_bg_image":"","footer_color":"#fff","footer_cols":"4","scroll_top_button":"false","accordions_style":"style_1","buttons_global_style":"style_20","forms_global_style":"style_13","pagination_style":"style_1","sidebars_global_style":"style_17","tabs_style":"style_1","tour_style":"style_1","boxed":"false","boxed_bg":"","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"3487","preloader":"false","preloader_color":"","site_padding":"0","site_width":"1170","page_title_box":"true","page_title_box_align":"left","page_title_box_bg_color":"rgba(0, 0, 0, 0.4)","page_title_box_bg_image":"3542","page_title_box_override":"false","page_title_box_style":"style_14","page_title_box_subtitle":"","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"","page_title_button_url":"","bottom_bar_bg":"","bottom_bar_bottom":"0","bottom_bar_color":"#f00","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#f00","bottom_bar_top":"0","header_builder":{"center":{"left":[{"$$hashKey":"object:1413","data":{"url":"\/renovation","uselogo":"true","width":"245"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","order":{"mobile":"2100","tablet":"2100"},"position":["center","left","0"],"type":"image"}],"right":[{"$$hashKey":"object:512","data":{"font":"hf","fsz":"13","fwn":"fwb","id":"2","lh":"20","line":"line_top","lineColor":"#ffffff","menuLinkColor":"#ffffff","menuLinkColorOnHover":"#ffffff","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","margins":{"default":{"bottom":"40","top":"40"},"mobile":{"bottom":"30","top":"30"},"tablet":{"bottom":"40","top":"40"}},"order":{"mobile":"2300","tablet":"2300"},"position":["center","right","0"],"type":"menu"}]}},"center_header_fullwidth":"false","header_bg":"","header_bg_fill":"full","header_bottom":"0","header_color":"#f00","header_text_color":"#f00","header_text_color_hover":"#f00","header_top":"0","divider_h_socials_1":"","header_socials":"","header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"","main_header_transparent":"true","top_bar_bg":"","top_bar_bottom":"0","top_bar_color":"#f00","top_bar_link_color_hover":"#f00","top_bar_text_color":"#f00","top_bar_top":"0","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"","error_page_style":"style_1","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"false"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"20","stm_donations_amount_3":"30","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"false"},"stm_events_layout":"left","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"default","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"left","stm_events_view":"list","divider_media_events_1":"","stm_media_events":{"enabled":"false"},"stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","products":{"enabled":"false"},"stm_products_layout":"left","stm_products_sidebar":"default","stm_products_sidebar_position":"left","stm_products_sidebar_single":"default","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","public":"true"},"stm_projects_layout":"2","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"1339","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"left","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","public":"true"},"stm_services_layout":"2","stm_services_sidebar":"default","stm_services_sidebar_position":"left","stm_services_sidebar_single":"default","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_staff":{"enabled":"false"},"stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"false"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"","stm_vacancies_button_url":"","stm_vacancies_details":"true","stm_vacancies_layout_single":"left","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"default","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"false"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"3","stm_shop_layout":"business","product_sidebar":"default","product_sidebar_position":"left","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_1","body_font":{"color":"#777777","fw":"400","ln":"30","ls":"0","mgb":"","name":"Open Sans","size":"16"},"h1_settings":{"color":"#34495e","fw":"700","ln":"56","ls":"0","mgb":"30","name":"","size":"48"},"h2_settings":{"color":"","fw":"700","ln":"48","ls":"","mgb":"","name":"","size":"36"},"h3_settings":{"color":"","fw":"700","ln":"36","ls":"","mgb":"","name":"","size":"24"},"h4_settings":{"color":"","fw":"700","ln":"28","ls":"","mgb":"","name":"","size":"20"},"h5_settings":{"color":"","fw":"700","ln":"24","ls":"","mgb":"","name":"","size":"18"},"h6_settings":{"color":"","fw":"700","ln":"22","ls":"","mgb":"","name":"","size":"16"},"headings_line":"true","headings_line_height":"5","headings_line_position":"bottom","headings_line_width":"45","secondary_font":{"color":"#34495e","name":"Raleway","subset":""},"link_color":"#34495e","link_hover_color":"#dd3939","list_style":"style_1","p_line_height":"30","p_margin_bottom":"15"}';

	return $json;
}

function stm_theme_options_digital() {
    $json = '{"post_layout":"1","post_sidebar":"2317","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","stm_post_popular_day":"","stm_post_popular_month":"","stm_post_popular_top":"","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"2317","post_sidebar_single_position":"right","post_tags":"true","post_title":"false","main_color":"#a0ce4e","secondary_color":"#f3e500","third_color":"#333333","copyright":"<a href=\"https:\/\/stylemixthemes.com\/\" target=\"_blank\">StylemixThemes<\/a>. All rights reserved.","copyright_co":"true","copyright_image":"","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","footer_bottom_color":"","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-twitter","url":"https:\/\/twitter.com\/stylemix_themes"},{"social":"fa fa-facebook","url":"https:\/\/www.facebook.com\/stylemixthemes\/"},{"social":"fa fa-instagram","url":"https:\/\/www.instagram.com\/stylemixthemes\/"}],"footer_bg":"#ffffff","footer_bg_image":"","footer_color":"#7e7e7e","footer_cols":"4","scroll_top_button":"true","accordions_style":"style_2","buttons_global_style":"style_18","forms_global_style":"style_3","pagination_style":"style_3","sidebars_global_style":"style_1","tabs_style":"style_2","tour_style":"style_1","boxed":"false","boxed_bg":"2658","divider_api_1":"","enable_ajax":"false","enable_bubbles":"false","ga":"","google_api_key":"","logo":"3963","preloader":"false","preloader_color":"#64fe3a","site_padding":"0","site_width":"1180","page_title_box":"true","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_8","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#ff3c65","bottom_bar_link_colorhover":"#ff3c65","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:454","data":{"url":"","uselogo":"false","width":"190"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"2194","tablet":"2310"},"position":["center","left","0"],"type":"image","value":"3963"}],"right":[{"$$hashKey":"object:1851","data":{"font":"hf","id":"26","line":"","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2196","tablet":"2309"},"position":["center","right","0"],"type":"menu"},{"$$hashKey":"object:561","data":{"icon_position":"btn_icon-right","style":"btn_solid","text":"LET\u2019S TALK","url":"#"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Button","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","1"],"type":"button"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"42","header_color":"rgba(41, 55, 66, 0.8)","header_text_color":"#ffffff","header_text_color_hover":"#ff3c65","header_top":"42","divider_h_socials_1":"","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"},{"social":"fa fa-skype","url":"skype:+1234567890?call"}],"header_sticky":"","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"true","top_bar_bg":"","top_bar_bottom":"25","top_bar_color":"#222222","top_bar_link_color_hover":"#ff3c65","top_bar_text_color":"#ffffff","top_bar_top":"25","page_bc":"true","page_bc_fullwidth":"false","page_pre_content":"default","page_pre_content_box":"false","page_pre_footer":"default","page_pre_footer_box":"false","show_page_title":"false","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"false"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","currency_symbol":"$","currency_symbol_position":"left","divider_api_2":"","divider_currency_1":"","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"true"},"paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","stm_donations_amount_1":"10","stm_donations_amount_2":"20","stm_donations_amount_3":"30","stm_donations_layout":"1","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"2234","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"right","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false","public":"true"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_media_events_1":"","stm_media_events_layout":"left","stm_media_events_sidebar_single":"default","stm_media_events_sidebar_single_mobile":"hidden","stm_media_events_sidebar_single_position":"left","divider_products_1":"","divider_products_2":"","stm_products_layout":"left","stm_products_sidebar":"default","stm_products_sidebar_position":"left","stm_products_sidebar_single":"default","stm_products_sidebar_single_mobile":"hidden","stm_products_sidebar_single_position":"left","stm_products_view":"grid","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","has_archive":"false","name":"","plural":"","slug":""},"stm_projects_layout":"default","stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"true","public":"true","slug":"servicewfwehbfwejhvfewjgvfwej"},"stm_services_layout":"grid_1","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_services_single_form":"default","stm_services_single_phone":"","stm_stories_layout":"1","stm_stories_sidebar_single":"2234","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"right","stories":{"enabled":"true"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"true"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"false"},"shop_items":"2","stm_shop_layout":"business","product_sidebar":"2691","product_sidebar_position":"right","thumbnails_quantity":"5","thumbnails_view_vertical":"false","blockquote_style":"style_3","body_font":{"color":"#777777","fw":"400","ln":"24","ls":"","mgb":"","name":"Open Sans","size":"14"},"h1_settings":{"color":"","fw":"700","ln":"72","ls":"0","mgb":"","name":"","size":"60"},"h2_settings":{"color":"","fw":"700","ln":"52","ls":"0","mgb":"","name":"","size":"48"},"h3_settings":{"color":"","fw":"700","ln":"36","ls":"0","mgb":"","name":"","size":"36"},"h4_settings":{"color":"","fw":"700","ln":"26","ls":"0","mgb":"","name":"","size":"24"},"h5_settings":{"color":"","fw":"700","ln":"18","ls":"0","mgb":"","name":"","size":"18"},"h6_settings":{"color":"","fw":"700","ln":"16","ls":"0","mgb":"","name":"","size":"16"},"headings_line":"false","headings_line_height":"4","headings_line_position":"bottom","headings_line_width":"80","secondary_font":{"color":"#333333","name":"Poppins","subset":""},"link_color":"#000000","link_hover_color":"#000000","list_style":"style_1","p_line_height":"25","p_margin_bottom":"25"}';

    return $json;
}