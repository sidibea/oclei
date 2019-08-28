<?php

require_once get_template_directory() . '/partials/skin/titlebox.php';


/**
 * @param bool|string $type colors, bg_colors, border_colors
 * @param bool|string $color m_color, secondary_color, third_color, false for full array
 * @return array
 */
function pearl_get_custom_styled_elements_array($type = false, $color = false)
{
	$elements_list = array(
		'colors'        => array(
			'main_color'      => array(
				'.mtc',
				'.mtc_h:hover',
				'.mtc_b:before',
				'.mtc_b_h:hover:before',
				'.mtc_a:after',
				'.mtc_a_h:hover:after',
				'.mtc_a_h.active',
				'.btn:hover',
				'.btn:hover .btn__icon',
				'.vc_gitem-post-data-source-post_date:before',
				'.stm-socials__icon_icon_only:hover',
				'.widget.vc_widgets.stm_widget_categories ul li a:hover',
				'.site-content .stm_widget_categories.style_1 ul li a:hover',
				'.site-content .stm_widget_categories.style_1 ul li.current-cat a',
				'.site-content .widget_contacts .stm-icontext__icon',
				'.stm_partners_style_2 .stm_partners__single:hover .stm_partners__title',
				'.dropcaps_bordered:first-letter',
				'.stm_pricing-table__content ul li:before',
				'.widget.widget_categories ul li.current-cat a',
				'.stm-navigation__default > ul > li > a:hover',
				'html body ul li.stm_megamenu > ul.sub-menu > li > a',
				'html body ul li.stm_megamenu ul.sub-menu li a:hover',
				'.stm_widget_categories.style_1 .widget.widget_categories ul li:hover a',
				'.stm_testimonials_style_3 .stm_testimonial__carousel:before',
				'.stm_widget_posts ul li:hover .stm_widget_posts__title',
				'.stm_widget_posts.style_1 ul li .post-date:before',
				'.stm_pricing-table_style_2 .stm_pricing-table__head h5',
				'.stm_post_type_list_style_1 .stm_post_type_list__single:hover .stm_post_type_list__content h4',
				'.stm_contact_style_2 .stm_contact__row strong',
				'.wpb_text_column ul li:before',
				'.wpb_text_column ol li:before',
				'.stm_events_list:not(.inverted) .stm_event_single_list:hover .hasTitle h3',
				'.stm_schedule_style_1 .event_lesson_tabs.active dfn',
				'.stm_services_style_3 .stm_services__title .h6:hover',
				'.stm_widget_search.style_2 button i:hover',
				'.stm_widget_posts.style_2 .stm_widget_posts__title:hover',
				'.stm_services_text_carousel_style_2 h5 a:hover',
				'.stm_services_style_3 .stm_services__title .h6:hover',
				'.stm_slider .stm_slide__button a:after',
				'.stm_post_style_1 .stm_loop__grid .stm_loop__single:hover h5',
				'.stm_single_post_style_1 .stm_post_details i',
				'.stm_single_post_style_1 .stm_author_box .stm_author_box__name strong',
				'ul.comment-list .comment .comment-meta a:hover',
				'.stm_form_style_2 [type="submit"]:after',
				'.stm_widget_pages_style_2 > ul > li:before',
				'.stm_latest_news.style_3 h5 .vc_gitem-link:hover',
				'.stm_read_more_link:hover a',
				'.stm_read_more_link:before',
				'.stm_read_more_link:after',
				'.stm_services_style_3 .stm_services__title:hover a',
				'.stm_sidebar_style_1 .stm-footer .footer-widgets aside.widget .widgettitle h4',
				'blockquote:before',
				'.stm_staff_grid_style_2 .stm_staff__email a',
				'.vc_custom_heading i.position_bottom',
				'.stm_sidebar_style_5 .stm-footer .footer-widgets .stm-socials a',
				'.site-content .stm_widget_categories.style_3.widget ul li a:hover',
				'.stm_loop__single_style5:hover h3',
				'.stm_pagination_style_5 ul.page-numbers li .page-numbers',
				'.stm_pagination_style_6 ul.page-numbers li .page-numbers',
				'.stm_services_style_4 .stm_services__title a:hover',
				'.stm_pagination_style_4 ul.page-numbers li .page-numbers',
				'.stm_pricing-table_style_3 .stm_pricing-table__prefix',
				'.stm_pricing-table_style_3 .stm_pricing-table__price',
				'.stm_pricing-table_style_3 .stm_pricing-table__postfix',
				'.stm_pricing-table_style_3 .stm_pricing-table__separator',
				'.stm_single_stm_events .vc_container-fluid-force .inner .date:before',
				'.stm_loop__single_grid_style_4 .stm_single__date .day',
				'.stm_loop__single_list_style_4 .stm_single__date .day',
				'.stm_tour_style_3 .vc_tta-tabs-position-left .vc_tta-tab.vc_active a .vc_tta-title-text',
				'.widget_contacts_style_5 .stm-icontext__icon',
				'.widget.stm_widget_pages_style_3 .page_item a:hover',
				'.stm_pagination_style_6 .owl-nav .owl-prev:before, .stm_pagination_style_6 .owl-nav .owl-next:before',
				'.stm_accordions_style_4 .vc_tta-accordion .vc_tta-panel-title:hover .vc_tta-title-text',
				'.stm_header_style_4 .stm_breadcrumbs a:hover',
				'.stm_widget_posts.style_4 > ul li .stm_widget_posts__title',
				'.stm_sidebar_style_6 .stm_markup__sidebar_divider .widgettitle:before',
				'.stm_widget_pages_style_4 ul li.current_page_item',
				'.stm_widget_pages_style_4 ul li.current_page_item:before',
				'.stm_services_style_6 .stm_loop__single_style6:hover h5',
				'.stm_stories .stm_story__text ul li:before',
				'.vc_tta-accordion .vc_tta-panel-heading:hover .vc_tta-panel-title > a',
				'.vc_tta-accordion .vc_tta-panel-heading:hover .vc_tta-title-text',
				'.vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover .vc_tta-controls-icon',
				'.stm_sidebar_style_6 .widget.widget_search .search-form input:focus + button i',
				'.stm-search_style_2 .form-control:focus + button i',
				'.stm_sidebar_style_6 .site-content .widget.stm_widget_categories.style_1 ul li a',
				'.stm_post_grid_style_6:hover .postinfo .postinfo_content h5',
				'.stm_single_post_style_6 .stm_flex .stm_share a:hover',
				'.stm_projects_grid_style_4 .stm_projects_grid__sorting .stm_projects_carousel__tab a:hover, .stm_projects_grid_style_4 .stm_projects_grid__sorting .stm_projects_carousel__tab a.active',
				'.stm_pagination_style_6 ol li:before',
				'.stm_lists_style_6 .stm_widget_pages_style_2 ul li a:hover',
				'.stm_tabs_style_4 .vc_tta-tab:not(.vc_active):hover .vc_tta-title-text',
				'.mejs-currenttime',
				'.stm_projects_grid_style_5 .stm_projects_grid .stm_projects_carousel__item .stm_projects_carousel__overlay i',
				'.stm_projects_grid_style_5 .stm_gallery_masonry__link:hover',
				'.stm_posts_list_style_3 .stm_posts_list_single:hover h5 a',
				'.stm_posts_list_style_3 .stm_posts_list_single__body .date',
				'.stm_post_style_8.stm_post_view_grid .stm_loop__grid .stm_posts_list_single:hover h5 a',
				'.stm_post_style_8.stm_post_view_grid .stm_loop__grid .stm_posts_list_single__body .date',
				'.stm_sidebar_style_7 .widget.widget_archive ul li:before',
				'.stm_titlebox_style_8 .stm_titlebox__title:first-letter',
				'.stm_sidebar_style_8 .widget.widget-default.widget_search .search-form .form-control:focus + button i',
				'.stm_sidebar_style_8 .widget ul li:before, .widget ol li:before',
				'.widget_calendar table tfoot tr td a',
				'.stm_sidebar_style_8 .stm_widget_categories.style_1 ul li a:hover',
				'.stm_accordions_style_6 .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon',
				'.stm_album_info_style_1 .stm_album_info__song_links a:hover',
				'.stm_single_events_style_3 .stm_single_event_detail .title i',
				'.stm_contact_style_4 .stm_contact__row a:hover',
				'.stm_contact_style_4 .stm_contact__row:before',
				'.stm_video_list_style_1 .stm_video_list__filter li a.active',
				'.stm_icon_links_style_2 a:hover',
				'.stm_custom_menu_style_1 .menu li:before',
				'.stm_pagination_style_7 .stm-footer__bottom .stm-socials > a > i',
				'.stm_open_table_style_1 .otw-input-wrap:before',
				'.stm_open_table_style_1 .selectric-scroll li:not(.selected):hover',
				'.services_price_list_style_2 .services_pills_container li a',
				'.services_price_list_style_3 .services_pills_container li a',
				'.working_hours_style_3 .widget_inner:before',
				'.widget_contacts_style_8 .stm-icontext__icon:before',
				'.services_price_list_style_3 .service__badge',
				'.stm_testimonials_style_3 .stm_testimonials__item:before',
				'.stm_gmap_wrapper.style_3 .gmap_addresses .item li i',
				'.stm_open_table_style_1 .stm_select:after',
				'.stm_post_style_9 .stm_post__tags a:hover',
				'.stm_gmap_wrapper.style_3 .gmap_addresses .item li i',
				'.stm_testimonials_style_3 .stm_testimonials__item:before',
				'.stm_sidebar_style_1 .stm_widget_categories.style_1 ul li a:hover',
				'.stm_header_style_1 li ul li.current_page_item > a',
				'.stm_header_style_1 .current-menu-parent > a',
				'.stm_header_style_1 .stm-navigation ul>li.stm_megamenu ul li.current_page_item>a',
				'.stm_header_style_13 li ul li.current_page_item > a',
				'.stm_header_style_13 .current-menu-parent > a',
				'.stm_header_style_13 .stm-navigation ul>li.stm_megamenu ul li.current_page_item>a',
				'.stm_header_style_5 .stm-navigation ul li.current-menu-item > a',
				'.stm_header_style_5 .stm-navigation ul li.current-menu-parent > a',
				'.stm_header_style_6 .stm-navigation ul li.current-menu-item > a',
				'.stm_header_style_6 .stm-navigation ul li.current-menu-parent > a',
				'.stm_header_style_8 .stm-navigation ul li.current-menu-item > a',
				'.stm_header_style_8 .stm-navigation ul li.current-menu-parent > a',
				'.stm_header_style_7 .stm-navigation ul li.current-menu-item > a',
				'.stm_header_style_7 .stm-navigation ul li.current-menu-parent > a',
				'.stm_header_style_9 .stm-navigation ul li.current-menu-item > a',
				'.stm_header_style_9 .stm-navigation ul li.current-menu-parent > a',
				'.stm_posttimeline_style_2 .stm_posttimeline__post:hover .stm_posttimeline__post_title h5',
				'.stm_sidebar_style_10  .footer-widgets a',
				'.widget_contacts_style_9 .stm-icontext__icon',
				'.widget_tp_widget_recent_tweets .tp_recent_tweets ul li:before',
				'.stm_sidebar_style_10 .stm_widget_posts.style_5 > ul li .stm_widget_posts__title',
				'.stm_testimonials_style_10 .stm_testimonials__info h6',
				'.stm_events_list_style_5 .hasButton a:hover',
				'.stm_services_text_carousel_style_2 .owl-nav .owl-prev:hover:before',
				'.stm_services_text_carousel_style_2 .owl-nav .owl-next:hover:before',
				'.stm_iconbox_style_9 .stm_iconbox__text h5',
				'.stm_titlebox_style_10 .stm_titlebox__title:before',
				'.stm_titlebox_style_10 .stm_titlebox__title:after',
				'.stm_staff_container_grid.style_7 .stm_staff__name',
				'.stm_contact_style_5 .stm_contact__info div:before',
				'.stm_icon_links_style_3 a',
				'.stm_post_style_10 .stm_loop__grid .stm_loop__single:hover h6',
				'.stm_post_style_10 .stm_loop__list .stm_loop__single:hover h6',
				'.stm_post_style_10 .stm_loop__grid .stm_loop__single:hover a',
				'.stm_post_style_10 .stm_loop__list .stm_loop__single:hover a',
				'.stm_single_post_style_10 .stm_post_details .stm_post_details_info .stm_post_details_icons',
				'.stm_carousel_style_8 .owl-controls .owl-nav .owl-prev:hover:before',
				'.stm_carousel_style_8 .owl-controls .owl-nav .owl-next:hover:before',
				'.stm_megamenu .stm_megaicon',
				'.stm_megamenu .megamenu-contacts td i',
				'.stm_read_more_link.style_3:hover a',
				'.stm_sidebar_style_10 .stm_widget_categories.widget .cat-item a:hover',
				'.stm_sidebar_style_10 .stm_widget_categories.widget .cat-item a:before',
				'.stm_events_layout_5 .stm_single_stm_events .stm_markup__content .stm_single_event__info i',
				'.error_page_style_7 .stm_errorpage__inner h1',
				'.stm_footer_layout_2 .stm-footer__bottom .stm-socials__icon',
				'.stm_pagination_style_11 .page-numbers.current',
				'.stm_pagination_style_11 .page-numbers:hover',
				'.stm_projects_grid_style_7 .stm_projects_carousel__item .stm_projects__meta .inner .stm_projects__prices',
				'.stm_projects_grid_style_7 .stm_projects_carousel__tab a.active',
				'.stm_projects_grid_style_7 .stm_projects_carousel__tab a:hover',
				'.stm_services_single__prices li',
				'.stm_services_single__features li div:before',
				'.stm_events_list_style_6 .stm_event_single_list a:hover',
				'.stm_pagination_style_11 ul.page-numbers .page-numbers.next:hover .fa',
				'.stm_pagination_style_11 ul.page-numbers .page-numbers.next:hover .fa',
				'.stm_widget_categories.style_2 li.cat-item:hover a',
				'.stm_widget_pages_style_5 li:hover a',
				'body .site-content .stm_widget_pages_style_5 ul > li > a:hover',
				'html body .stm-navigation__fullwidth > ul > li.stm_megamenu > ul.sub-menu > li > a',
				'html body ul li.stm_megamenu > ul.sub-menu > li.current_page_item > a',
				'html body ul li.stm_megamenu > ul.sub-menu > li:hover > a',
				'html body.stm_header_style_10 ul li.stm_megamenu li',
				'html body .stm-navigation__default ul li.stm_megamenu>ul.sub-menu>li ul.sub-menu>li.current-menu-item a',
				'html body .stm-navigation__fullwidth ul li.stm_megamenu>ul.sub-menu>li ul.sub-menu>li.current-menu-item a',
				'.stm_sidebar_style_12 .stm_wp_widget_text .stm-socials a',
				'.stm-counter_style_6 .stm-counter__value',
				'.stm-counter_style_6 .stm-counter__prefix',
				'.stm-counter_style_6 .stm-counter__affix',
				'.stm_posts-timeline_style_3 .owl-prev:before',
				'.stm_posts-timeline_style_3 .owl-next:before',
				'.stm_sidebar_style_12 .stm_wp_widget_text .stm-socials a',
				'.stm_layout_rental .stm-footer__bottom .stm-socials .ttc',
				'.stm_single_post_style_12 .stm_share a',
				'.stm_single_post_style_14 .stm_share a',
				'.stm_single_post_style_15 .stm_share a',
				'.stm_single_post_style_16 .stm_share a',
				'.stm_blockquote_style_11 blockquote:after',
				'.stm_slider_style_8 .owl-nav .owl-prev:hover:before',
				'.stm_slider_style_9 .owl-nav .owl-prev:hover:before',
				'.stm_slider_style_8 .owl-nav .owl-next:hover:before',
				'.stm_slider_style_9 .owl-nav .owl-next:hover:before',
				'.stm_slider_style_8 .stm_slide__category',
				'.stm_slider_style_9 .stm_slide__category',
				'.stm_slider_style_8 .stm_slide__title:after',
				'.stm_carousel .owl-nav > div:before',
				'.stm_sidebar_style_14 .site-content .widget.stm_widget_categories.style_2 ul li a',
				'.stm_pagination_style_12 ul.page-numbers li a.page-numbers:hover',
				'.stm_shop_layout_store.woocommerce .checkout #customer_details h3',
				'.stm_shop_layout_store .woocommerce .checkout #customer_details h3',
				'.stm_shop_layout_store .stm_woo_products .owl-carousel .owl-nav .owl-prev:before',
				'.stm_shop_layout_store .stm_woo_products .owl-carousel .owl-nav .owl-next:before',
				'.stm_shop_layout_store .filter_wrap .filter_box .woo_filter .woo_filter_dropdown .widget ul li a',
				'.stm_posts_carousel_style_4 .stm_posts_carousel__list li.active .title',
				'.stm_categories_tabs_style_1 ul.nav-tabs > li.active > a',
				'.stm_layout_factory.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon i',
				'.stm_header_style_17 .stm_breadcrumbs i',
				'.single-stm_products #products__tab .tab-content .products_details_description ul li:before',
				'.stm_pagination_style_15 ul.page-numbers .stm_prev a:hover',
				'.stm_pagination_style_15 ul.page-numbers .stm_next a:hover',
				'.stm_sidebar_style_19 .stm-footer a',
				'.stm_layout_company .stm_services_text_carousel_style_1 .stm_services_carousel .item .content .stm_read_more_link a',
				'.stm_layout_company .stm_loop__single_list_style_2 .stm_post_details',
				'.stm_projects_grid_style_9 .stm_projects_grid__sorting li:after',
				'.stm_categories_tabs_style_2 ul.nav-tabs li:after',
				'.stm_header_style_20 .stm-navigation__default > ul > li.current-menu-item > a',
				'.stm_testimonials_style_14 .stm_testimonials__review:after',
				'.stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front .inner h2',
			),
			'secondary_color' => array(
				'.stc',
				'.stc_h:hover',
				'.stc_a:after',
				'.stc_a_h:hover:after',
				'.stc_b:before',
				'.stc_b_h:hover:before',
				'.stm_header_style_3 .dropdown .fa',
				'.widget_contacts_style_3 .stm-icontext__icon',
				'.stm_staff_grid_style_2 .stm_staff__contact i',
				'.stm_sidebar_style_4 .stm-footer .stc',
				'.stm_lists_style_5 .wpb_text_column ul li:before',
				'.stm_post_type_list_style_3 .stm_post_type_list__single:hover h4',
				'.stm_history_style_2 .stm_history__year',
				'.stm_titlebox_style_5 .stm_breadcrumbs a:hover',
				'.dropcaps_circle:first-letter',
				'.stm_tour_style_2 .vc_tta.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active > a .vc_tta-title-text',
				'.stm_header_style_4 .stm-iconbox .stm-iconbox__icon',
				'.form_icon:after',
				'.widget_working_hours .table_working_hours tr.active td',
				'.stm_upcoming_event_style_1 .stm_upcoming_event__date-title',
				'.stm_events_list_style_3 .stm_event_single_list h6:hover',
				'.stm_projects_grid_style_7 .stm_projects_carousel__tab a.active',
				'.stm_infobox_style_3 .stm_infobox__content a',
				'.stm_layout_store .stm_icon_links_style_3 a.wtc:hover',
				'.stm_blockquote_style_12 blockquote:before',
				'.stm_sidebar_style_14 .site-content .widget.stm_widget_categories.style_2 ul li a:before',
				'.stm_shop_layout_store.woocommerce .star-rating span::before',
				'.stm_shop_layout_store .stm_woo_products .owl-carousel .owl-nav .owl-prev:hover:before',
				'.stm_shop_layout_store .stm_woo_products .owl-carousel .owl-nav .owl-next:hover:before',
				'.stm_shop_layout_store .filter_wrap .filter_box .woo_filter .woo_filter_title.current',
				'.stm_shop_layout_store .filter_wrap .filter_box .woo_filter .woo_filter_dropdown .widget ul li.chosen a:after',
				'.stm_layout_viral .stm-footer .footer-widgets .widget_contacts .stm-icontext__icon',
				'.stm_layout_viral .stm-footer .footer-widgets .widget_nav_menu ul li a:hover',
				'.stm_single_post_style_17 .stm_prevnext__post_prev:before',
				'.stm_single_post_style_17 .stm_prevnext__post_next:before',
				'.stm_single_post_style_17 .stm_prevnext__post a:hover .heading_font',
				'.stm-socials-btn.active',
				'.stm_woo_products .product .stm_single_product__meta .woocommerce-loop-product__title:hover',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product .stm_single_product__meta .woocommerce-loop-product__title:hover',
				'.woocommerce.stm_special_offer .special_offer_product__meta_box .special_offer_product__meta .woocommerce-loop-product__title a:hover',
				'.stm_products_categories_style_1.stm_loop ul li a .product_cat_info .product_cat_title',
				'.stm_products_categories_style_1.stm_loop ul li a .product_cat_info .product_cat_description',
				'.stm_header_style_14 .stm-navigation ul li.current-menu-item > a',
				'.stm_header_style_14 .stm-navigation ul li.current-menu-parent > a',

				'a .bump',
				'.stm_pagination_style_5 .wpb_text_column ol li:before',
				'.stm_events_list_style_2 .__icon',
				'.stm_projects_grid_style_8 .stm_projects_carousel__tab a',
				'.stm_projects_grid_style_8 .stm_projects_carousel__tab a:hover',
			),
			'third_color'     => array(
				'.ttc',
				'.ttc_h:hover',
				'.ttc_a:after',
				'.ttc_a_h:hover:after',
				'.ttc_b:before',
				'.ttc_b_h:hover:before',
				'.button_3d.white span, .button_3d span:before',
				'.stm_header_style_1 .stm-navigation ul > li > ul > li > a',
				'.site-content .widget ul li a:hover',
				'.stm_markup__sidebar .widget.stm_widget_categories ul li a',
				'.stm_titlebox_style_1 .stm_breadcrumbs a[property="item"]',
				'.stm_pricing-table__pricing',
				'.stm_select:after',
				'.stm_iconbox_style_2 .stm_iconbox__text h5',
				'.stm_vacancies_style_2 .stm_details .stm_details__value',
				'.stm-navigation__fullwidth > ul > li ul.sub-menu > li > a',
				'.stm_titlebox .stm_breadcrumbs',
				'.stm_partners__description',
				'.stm_sidebar_style_1 .stm_markup__sidebar .widget.widget_recent_entries ul li a',
				'.stm_sidebar_style_1 .stm_markup__sidebar .widget .widgettitle',
				'.stm_sidebar_style_1 .stm_markup__sidebar .widget .widgettitle h5',
				'.stm_single_post_style_2 .stm_post__tags a',
				'.stm_pagination_style_2 ul.page-numbers .page-numbers',
				'.atcb-item-link',
				'.stm_widget_posts.style_2 .stm_widget_posts__title',
				'.stm_post_style_1 ul.comment-list .comment .comment-author a',
				'.stm_services_text_carousel_style_2 h5 a',
				'.stm_vacancies > a',
				'.services_price_list_style_1 ul li:not(.active) a:hover',
				'.stm_widget_pages_style_3 .page_item a',
				'.stm_blockquote_style_4 blockquote',
				'.stm_accordions_style_4 .vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text',
				'.stm_header_style_4 .stm-iconbox .stm-iconbox__text',
				'.stm_blockquote_style_6 blockquote p',
				'.stm_sidebar_style_6 .site-content .widget.stm_widget_categories.style_1 ul li a:hover',
				'.ui-datepicker .ui-state-default',
				'.stm_buttons_style_7 .btn.btn_solid:hover',
				'.stm_staff_container_grid.style_6 .owl-controls .owl-nav [class*="owl-"]:before',
				'.stm_testimonials_style_7 .stm_testimonials__review',
				'.stm_pagination_style_8 .owl-controls .owl-nav .owl-prev:before, .stm_pagination_style_8 .owl-controls .owl-nav .owl-next:before',
				'.stm_projects_grid_style_5 .stm_gallery_masonry__link',
				'.stm_posts_list_style_3 .stm_posts_list_single h5 a',
				'.stm_post_style_8.stm_post_view_grid .stm_loop__grid .stm_posts_list_single h5 a',
				'.stm_pagination_style_8 ul.page-numbers li .page-numbers',
				'.stm_accordions_style_6 .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-title > a .vc_tta-title-text',
				'.stm_accordions_style_6 .vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon',
				'.stm_single_post_style_7 .comment-author',
				'.stm_single_donation_style_1 .comment-author',
				'.stm_single_post_style_7 .stm_author_box .stm_author_box__name strong',
				'.stm_single_events_style_3 .stm_event_wide_details .btn.btn_primary.btn_outline:hover:hover',
				'.stm_tabs_style_5 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active a span.vc_tta-title-text',
				'.stm_contact_style_4 .stm_contact__row a',
				'.stm_pagination_style_7 .stm-footer__bottom .stm-socials > a:hover > i',
				'.stm_buttons_style_7 button[type="submit"]:not(.btn):hover',
				'.services_price_list_style_2 .service__cost',
				'.stm_sidebar_style_9 .widgettitle h4',
				'.working_hours_style_3 .day_label',
				'.stm_loop__list.stm_no_thumbnail.stm_loop__single a.inner h3',
				'.stm_posttimeline_style_1 .stm_posttimeline__post:hover h3',
				'.stm_lists_style_1 .wpb_text_column ul li strong',
				'.stm_pagination_style_11 .page-numbers',
				'.stm_services_single__panel .stm_services_single__phone',
				'.stm_widget_categories.style_2 li.cat-item a',
				'.stm_widget_pages_style_5 ul li a',
				'.circle_progress_wr .circle_progress .info',
				'.stm_shop_layout_store.woocommerce ul.stm_products li.product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before',
				'.stm_shop_layout_store.woocommerce ul.stm_products li.product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before',
				'.stm_shop_layout_store.woocommerce ul.stm_products li.product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-add-button.show a:hover:before',
				'.stm_shop_layout_store.woocommerce ul.stm_products li.product .stm_single_product__image .stm_single_product__more:hover i',
				'.stm_shop_layout_store.woocommerce .stm_woo_products .product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before',
				'.stm_shop_layout_store.woocommerce .stm_woo_products .product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before',
				'.stm_shop_layout_store.woocommerce .stm_woo_products .product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-add-button.show a:hover:before',
				'.stm_shop_layout_store.woocommerce .stm_woo_products .product .stm_single_product__image .stm_single_product__more:hover i',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-add-button.show a:hover:before',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product .stm_single_product__image .stm_single_product__more:hover i',
				'.stm_shop_layout_store .woocommerce .stm_woo_products .product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before',
				'.stm_shop_layout_store .woocommerce .stm_woo_products .product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before',
				'.stm_shop_layout_store .woocommerce .stm_woo_products .product .stm_single_product__image .yith-wcwl-add-to-wishlist .yith-wcwl-add-button.show a:hover:before',
				'.stm_shop_layout_store .woocommerce .stm_woo_products .product .stm_single_product__image .stm_single_product__more:hover i',
				'.stm_infobox_style_3 .stm_infobox__content a:hover',
				'.stm_slider_style_7 .stm_slide__title span',
				'.stm_slider_style_8 .stm_slide__title span',
				'.stm_slider_style_9 .stm_slide__title span',
				'.stm_icon_links_style_4 i',
				'.stm_blockquote_style_11 blockquote',
				'.stm_slider_style_8 .owl-nav .owl-prev:before',
				'.stm_slider_style_9 .owl-nav .owl-prev:before',
				'.stm_slider_style_8 .owl-nav .owl-next:before',
				'.stm_slider_style_9 .owl-nav .owl-next:before',
				'.stm_header_style_13 .stm-navigation ul>li>ul>li>a',
				'.stm_shop_layout_store.single-product div.product .summary.entry-summary .yith-wcwl-add-to-wishlist a:hover',
				'.stm_products_categories .product_cat_info',
				'.stm_projects_grid_style_9 .stm_projects_carousel__item .stm_projects_carousel__name',
				'.stm_projects_grid_style_9 .stm_projects_grid__sorting li a.active',
				'.stm_projects_grid_style_9 .stm_projects_grid__sorting li a:hover',
				'.stm_header_style_20 .stm-navigation .sub-menu a',
				'.stm_buttons_style_21 .btn.btn_solid:not(.btn_white)',

				'.btn',
				'.btn.btn_outline',
				'.btn.btn_outline:hover',
				'.btn.btn_outline.btn_primary.btn_load span',
				'.btn.btn_outline.btn_primary.btn_load:before',
				'.btn_primary.btn_outline .btn__icon,.btn_secondary.btn_outline .btn__icon',
				'.btn_third.btn_outline .btn__icon',
				'.btn.btn_outline.btn_white:hover',
				'.btn_third.btn_outline .btn__icon',
				'.btn .btn__icon',
			)
		),
		'bg_colors'     => array(
			'main_color'      => array(
				'.mbc',
				'.mbc_h:hover',
				'.mbc_b:before',
				'.mbc_b_h:hover:before',
				'.mbc_a:after',
				'.mbc_a_h:hover:after',
				'.mbc_h.active',
				'mark',
				'.stm_titlebox',
				'.button_3d.white:hover span:before, .button_3d.white:focus span:before',
				'.tparrows.persephone:hover',
				'.owl-nav .owl-prev:hover',
				'.owl-nav .owl-next:hover',
				'.stm_testimonials .owl-dots .owl-dot.active span',
				'.stm_slider_style_2 .owl-dots .owl-dot.active',
				'.stm_owl_dots .owl-dots .owl-dot.active',
				'.stm_preloader__element:before, .vc_grid-loading:before',
				'div.wpcf7 .ajax-loader:after',
				'.stm_pagination_style_1 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_1 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_19 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_19 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_18 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_18 ul.page-numbers .page-numbers.current',
				'.search-form .form-control:focus + button',
				'.stm-search_style_2 .search-form .form-control:focus + button:after',
				'.widget.widget_recent_entries ul li:hover:before, .widget_tag_cloud .tagcloud a:hover',
				'.stm_post__tags a:hover',
				'.stm_partners.stm_partners_style_2 .stm_partners__single:hover .stm_partners__title:before',
				'.vc_tta-panel.vc_active .vc_tta-panel-title > a',
				'.vc_tta.vc_tta-tabs .vc_active .vc_tta-title-text:before',
				'.stm_projects_grid__loading:before',
				'.stm-navigation__line_top ul > li:before, .stm-navigation__line_bottom ul > li:before',
				'.stm_header_style_3 .stm-navigation .sub-menu li:not(.active):hover',
				'.stm_services_style_2 .stm_loop__single:hover .stm_services__title',
				'.stm_header_style_1 .stm-navigation ul > li > ul > li:hover > a',
				'.stm_header_style_1 .stm-navigation ul > li > ul > li.current-menu-item > a',
				'.stm_header_style_13 .stm-navigation ul > li > ul > li:hover > a',
				'.stm_header_style_13 .stm-navigation ul > li > ul > li.current-menu-item > a',
				'.stm_header_style_3 .stm-offices .stm-switcher__list .stm-switcher__option:hover',
				'.stm_video.stm_video_style_2 .stm_playb:after',
				'.stm_widget_search.style_1 .widget.widget_search .search-form button',
				'.stm_form_style_2 [type="submit"]',
				'.stm_load_posts span.preloader',
				'.stm_pagination_style_2 ul.page-numbers .page-numbers:not(.current):hover',
				'.btn_loading span.preloader',
				'.atcb-item-link:hover',
				'.stm_input_wrapper.active:before',
				'.stm_header_style_3 .dropdown-list li a:hover',
				'.stm_lists_style_1 .wpb_text_column ul li:before',
				'.stm_lists_style_7 .wpb_text_column ul li:before',
				'.stm_post_type_list_style_2 .stm_post_type_list__single:hover',
				'.stm_post_type_list_style_2 .stm_post_type_list__single.active',
				'.stm_pagination_style_3 ul.page-numbers .page-numbers.current:after',
				'.stm_pagination_style_3 ul.page-numbers li .page-numbers:hover:after',
				'.stm_pagination_style_9 ul.page-numbers .page-numbers.current:after',
				'.stm_pagination_style_9 ul.page-numbers li .page-numbers:hover:after',
				'.stm_projects_grid_style_2 .stm_projects_carousel__item:hover .mbc_b_h:before',
				'.stm_tabs_style_2 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active a span.vc_tta-title-text',
				'.stm_post_style_1 .stm_loop__list .stm_loop__single:hover h3:after',
				'.stm_icon.stm_icon_styled_bg:before',
				'.stm_pagination_style_5 .owl-dots .owl-dot.active',
				'.stm_header_style_4 .stm-navigation > ul > li > .sub-menu > li:hover',
				'.stm_widget_categories.style_3 ul li:before',
				'.stm_pagination_style_5 ul.page-numbers li.stm_page_num .page-numbers:hover',
				'.stm_pagination_style_6 ul.page-numbers li.stm_page_num .page-numbers:hover',
				'.stm_pagination_style_5 ul.page-numbers li.stm_page_num .page-numbers.current',
				'.stm_pagination_style_6 ul.page-numbers li.stm_page_num .page-numbers.current',
				'.stm_blockquote_style_5 blockquote',
				'.stm_services_style_4 .stm_services__icon:before',
				'.stm_carousel_style_4 .owl-dots .owl-dot.active span',
				'.stm_iconbox.stm_iconbox_style_6:before',
				'.stm_widget_search.style_3 button[type="submit"]',
				'.tag_cloud_style_2 .tagcloud a:hover',
				'.stm_single_post_style_4 .stm_single_post__tags a:hover',
				'.stm_staff_container_grid.style_5 .stm_staff:before',
				'.stm_tabs_style_4 .vc_tta-tabs .vc_tta-tab.vc_active',
				'.stm_tabs_style_4 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab:before',
				'.stm_tabs_style_5 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active:before',
				'.slick-dots li.slick-active:before',
				'.stm_gmap_wrapper.style_2 .gmap_addresses .addresses_wr',
				'.stm_video_style_4:hover .stm_playb:after',
				'.stm_opening_hours_table_style_1 .day .time_to_closing',
				'.stm_projects_grid_style_4 .stm_projects_grid__sorting .stm_projects_carousel__tab a:after',
				'.ui-timepicker-standard .ui-state-hover',
				'.ui-datepicker .ui-state-default.ui-state-hover',
				'.stm_testimonials_style_6 .stm_testimonials__item:hover:before',
				'.mejs-time-current',
				'.mejs-horizontal-volume-current',
				'.stm_buttons_style_7 .btn.btn_solid:hover',
				'.stm_staff_container_grid.style_6 .stm_staff__socials > li > a:hover',
				'.audio-bodong span',
				'.stm_pagination_style_7 ul.page-numbers .page-numbers:not(.current):hover',
				'.stm_video.stm_video_style_5 .stm_playb:after',
				'.stm_projects_grid_style_5 .stm_gallery_masonry__link:hover:after',
				'.stm_icontext_style_4:hover .stm_icontext__icon',
				'.stm_posts_list_style_3 .stm_posts_list_single:hover .stm_posts_list_single__body:before',
				'.stm_post_style_8.stm_post_view_grid .stm_loop__grid .stm_posts_list_single:hover .stm_posts_list_single__body:before',
				'.stm_pagination_style_8 ul.page-numbers li .page-numbers:hover',
				'.stm_staff_cta_grid_style_6',
				'.stm_single_events_style_3 .stm_event_wide_details .btn',
				'.stm_slider_style_5 .owl-nav .owl-prev',
				'.stm_slider_style_5 .owl-nav .owl-next',
				'.stm_buttons_style_7 button[type="submit"]:not(.btn):hover',
				'.open-table-widget-datepicker .picked',
				'.stm_open_table_style_1 .selectric-scroll li.selected',
				'.stm_pagination_style_9 .owl-dots .owl-dot.active span',
				'.stm_posts_list_style_4 .stm_posts_list_single__body:before',
				'.services_price_list_style_3 .service__cost',
				'.owl-dots .owl-dot.active',
				'.stm_play',
				'.stm_header_style_3 .stm-navigation__default > ul > li .sub-menu > li.current-menu-item',
				'.stm_header_style_4 .stm-navigation__default > ul > li .sub-menu > li.current-menu-item',
				'.stm_staff_grid_style_1 .stm_staff__image .stm_staff__socials li:hover:before',
				'.stm_staff_grid_style_3 .stm_staff__image .stm_staff__socials li:hover:before',
				'.stm_pagination_style_6 .slick-dots li.slick-active:before',
				'.stm_sidebar_style_10 .stm-footer .footer-widgets:before',
				'.stm_events_list_style_5 .hasButton:after',
				'.stm_services_text_carousel_style_2 .stm_services_carousel .item .item_thumbnail .content a:hover',
				'.stm_iconbox_style_9 .stm_iconbox__text h5 span:after',
				'.stm_events_list_style_6 .stm_event_single_list .hasButton:after',
				'.stm-navigation__line_middle>ul>li:before',
				'.stm_post_style_10 .stm_loop__grid .stm_loop__single .postinfo_grid:after',
				'.stm_post_style_10 .stm_loop__list .stm_loop__single .postinfo_grid:after',
				'.stm_post_style_10 .stm_single_post_style_10 .stm_post_panel .stm_single_post__tags a:hover',
				'.stm_post_style_10 .stm_single_stm_events .stm_markup__content .stm_single_event__panel .stm_single_event__categories a:hover',
				'.stm_header_style_10 .stm-navigation.stm-navigation__default ul li > .sub-menu > li a:hover',
				'.stm_projects_grid_style_7 .stm_projects_carousel__item .stm_projects__links a:hover',
				'.pearl_wp_link_pages>.stm_page_num',
				'.stm_iconbox_style_10 .stm_iconbox__icon:after',
				'.stm_video_style_6:hover .stm_playb:after',
				'.stm_headings_line_right h1:after, .stm_headings_line_right .h1:after, .stm_headings_line_right h2:after, .stm_headings_line_right .h2:after, .stm_headings_line_right h3:after, .stm_headings_line_right .h3:after, 
        		.stm_headings_line_right h4:after, .stm_headings_line_right .h4:after, .stm_headings_line_right h5:after, .stm_headings_line_right .h5:after, .stm_headings_line_right h6:after, .stm_headings_line_right .h6:after',
				'.woocommerce .stm_woo_products .owl-prev',
				'.woocommerce .stm_woo_products .owl-next',
				'.woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta .count_meta_info',
				'.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon:hover',
				'.vc_images_carousel .vc_carousel-indicators li.vc_active',
				'.stm_slider_style_8 .stm_slide__button a:hover',
				'.stm_single_post_video_format:hover .play',
				'.stm_single_post_video_format:hover .play:before',
				'.stm_single_post_video_format:hover .play:after',
				'.stm_pagination_style_14 .owl-controls .owl-dot span:after',
				'.stm_pagination_style_12 ul.page-numbers li .page-numbers.current:before',
				'.stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button',
				'.stm_shop_layout_store.woocommerce .button',
				'.stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order',
				'.stm_shop_layout_store .woocommerce .button',
				'.stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order',
				'.stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a',
				'.stm_shop_layout_store.single-product div.product .summary.entry-summary .single_add_to_cart_button',
				'.stm_woo_category_link_box .stm_woo_category_link:before, .stm_woo_category_link_box .stm_woo_category_link:after',
				'.stm_custom_heading__side_line',
				'.stm_header_style_17.single-stm_products .stm-header__row_color_center:before',
				'.single-stm_products .tab-content .products_certificate_top h3:after',
				'.stm_pagination_style_15 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_15 ul.page-numbers .stm_page_num a:hover',

				'.stm_posttimeline_style_2 .stm_posttimeline__year.active span',
				'.stm_staff_list_style_6 .stm_staff__socials li a:hover',
				'body.page-ajax-driven #wrapper:before',
				'.stm_projects_grid_style_8 .stm_projects_carousel__tab a:after',
				'.stm_layout_company .stm_slider_style_10.stm_slider .stm_slide__button .btn:hover',
				'.stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb.active',
				'.stm_sidebar_style_19 .stm-footer .footer-widgets .stm_wp_widget_text .stm-socials a:hover',
				'.stm_header_style_19 .stm-header .stm-navigation__default > ul > li ul li > a:hover',
				'.stm_pagination_style_17 .page-numbers .page-numbers.current',
				'.stm_projects_grid_style_9 .stm_projects_grid__sorting li a:after',
				'.stm_categories_tabs_style_2 ul.nav-tabs li a:after',
				'.stm_iconbox_style_12 .stm_iconbox__icon',
				'.stm_header_style_20 .stm-navigation__default .sub-menu li:hover',
				'.stm_header_style_20 .stm-navigation__default .sub-menu li.current-menu-item',
				'.stm_video_style_10 .stm_playb',
				'.stm_sidebar_style_21 .stm-footer .stm-socials .stm-socials__icon',

				/*Buttons*/
				/*SOLID*/
				/*Primary*/
				'.btn_primary.btn_solid',
				'.btn_primary.btn_divider .btn__icon:after',
				'.btn_third.btn_solid:hover',
				'.btn_primary.btn_solid:hover .btn__icon:after',

				'.btn_primary.btn_outline .btn__icon:after',

				'.btn_primary.btn_outline:hover',

				'.stm_slider_style_2.stm_slider .stm_slide__button a:hover',
				'body .btn_solid.btn_primary_hover:hover',
			),
			'secondary_color' => array(
				'.sbc',
				'.sbc_h:hover',
				'.sbc_a:after',
				'.sbc_a_h:hover:after',
				'.sbc_b:before',
				'.sbc_b_h:hover:before',
				'h1:before, .h1:before, h2:before, .h2:before, h3:before, .h3:before, 
        h4:before, .h4:before, h5:before, .h5:before, h6:before, .h6:before',
				'h1:after, .h1:after, h2:after, .h2:after, h3:after, .h3:after, 
        h4:after, .h4:after, h5:after, .h5:after, h6:after, .h6:after',
				'.services_price_list_style_1.services_price_list_tabs ul li.active a',
				'.stm_history_style_2 .stm_history__title:after',
				'.stm_pagination_style_4 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_4 ul.page-numbers .page-numbers:hover',
				'.services_price_list_style_1 .services__tab_heading:after',
				'.dropcaps_circle:before',
				'.stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab.vc_active',
				'.stm_pricing-table_style_4 .stm_pricing-table__label',
				'.stm_pagination_style_6 .owl-nav .owl-prev:hover, .stm_pagination_style_6 .owl-nav .owl-next:hover',
				'.stm_pagination_style_7 .owl-dots .owl-dot:hover span, .stm_pagination_style_7 .owl-dots .owl-dot.active span',
				'.stm_single_donation_style_1 .stm_single_donation__progress-bar span',
				'.stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label',
				'.stm_form_style_6 .stm_input_wrapper_checkbox.active:before',
				'.stm_pagination_style_4 .tp-bullet.selected span',
				'.stm_gmap_wrapper.style_2 .gmap_addresses .owl-dots-wr .owl-dot.active',
				'.stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover',

				'.stm_layout_store .stm-cart_style_1 .cart__quantity-badge',
				'.woocommerce .stm_woo_products .owl-prev:hover',
				'.woocommerce .stm_woo_products .owl-next:hover',
				'.store_newsletter .mc4wp-form-fields .btn',
				'.woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta:first-child .count_meta_info',
				'.woocommerce .special_offer_product__meta_box .special_offer_countdown_out',
				'.stm_form_style_10 [type="submit"]',
				'.stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover',
				'.stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover',
				'.stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover',
				'.stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button:hover',
				'.stm_shop_layout_store.woocommerce .button:hover',
				'.stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order:hover',
				'.stm_shop_layout_store .woocommerce .button:hover',
				'.stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order:hover',
				'.stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__products:before',
				'.stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover',
				'.stm_shop_layout_store.single-product div.product .woocommerce-tabs ul.tabs li.active a:after',
				'.stm-footer .footer-widgets aside.widget.widget_mc4wp_form_widget .btn:hover',
				'.stm_posts_list_style_10 .stm_posts_list_single__category',
				'.stm_posts_carousel_style_2 .stm_posts_carousel_single__category',
				'.stm_posts_carousel_style_3 .stm_posts_carousel_single__category',
				'.stm_layout_factory .btn_primary.btn_solid:hover',
				'.stm_video_style_10 .stm_playb:hover',

				/*Buttons*/
				'.btn_secondary.btn_solid',
				'.btn_secondary.btn_outline:hover',
				'.btn_secondary.btn_outline .btn__icon:after',
				'.stm_slider_style_3.stm_slider .stm_slide__button a',
				'.stm_slider_style_4 .stm_slide__button a',
			),
			'third_color'     => array(
				'.tbc',
				'.tbc_h:hover',
				'.tbc_h.active',
				'.tbc_a:after',
				'.tbc_a_h:hover:after',
				'.tbc_b:before',
				'.tbc_b_h:hover:before',
				'.button_3d span:before',
				'.stm_header_style_3 .stm-navigation__default > ul > li ul',
				'.stm_pricing-table_style_2 .stm_pricing-table__head',
				'.stm_form_style_2 [type="submit"]:hover',
				'.stm_header_style_3 .dropdown.open',
				'.stm_slider',
				'.stm_single_post_style_1 .stm_post_details',
				'.stm_gmap_wrapper.style_1 .gmap_addresses:before',
				'.stm_tabs_style_2 .vc_tta.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab a span.vc_tta-title-text',
				'.stm_header_style_4 .stm-navigation__line_top > ul > li:before',
				'.stm_projects_grid_style_5 .stm_gallery_masonry__link:after',
				'.stm_icontext_style_4 .stm_icontext__icon',
				'.stm_titlebox_style_8',
				'.stm_titlebox_style_8 .stm_breadcrumbs',
				'.widget_calendar table thead tr th',
				'.stm_loop__single_style8 .inner:hover .post_thumbnail span',
				'.single-post.stm_post_style_8 .stm_post_actions',
				'.stm_events_list_style_4 .stm_events_list_style_4 .stm_events_list.not-inverted .btn.btn_outline.btn_primary:hover',
				'body.stm_header_style_8 .stm_page_bc .stm_breadcrumbs',
				'.stm_tabs_style_5 .vc_tta-tabs .vc_tta-tab',
				'.stm_tabs_style_5 .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tab:before',
				'.stm_gmap_wrapper .stm_infobox',
				'.stm_slider_style_5 .owl-nav .owl-prev:hover',
				'.stm_slider_style_5 .owl-nav .owl-next:hover',
				'.stm_header_style_7 .stm_mobile__switcher > span',
				'.stm_titlebox_style_2',
				'.stm_header_style_9 .stm_mobile__header',
				'.stm_post_style_9 .stm_post__related_post_container',
				'.stm_loop__list.stm_no_thumbnail.stm_loop__single a.inner',
				'.stm_title_box_style_3 .stm_titlebox',
				'.otw-submit-btn:hover',
				'.stm_pagination_style_10 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_10 ul.page-numbers .page-numbers:hover',
				'body.stm_header_style_11 .stm-navigation__default > ul > li ul li.current-menu-item a',
				'body.stm_header_style_11 .stm-navigation__default > ul > li ul li:hover a',
				'.stm_lists_style_9 .wpb_text_column ul li:before',
				'.stm_shop_layout_store.woocommerce ul.stm_products li.product:hover .stm_single_product__image:after',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product:hover .stm_single_product__image:after',
				'.stm_shop_layout_store.woocommerce ul.stm_products li.product .stm_single_product__image .onsale',
				'.stm_shop_layout_store .woocommerce ul.stm_products li.product .stm_single_product__image .onsale',
				'.woocommerce .stm_woo_products .product:hover .stm_single_product__image:after',
				'.woocommerce .stm_woo_products .product .stm_single_product__image .onsale',
				'.store_newsletter .mc4wp-form-fields .btn:hover',
				'.woocommerce.stm_special_offer .special_offer_product__thumbnail .special_offer_product__title',
				'.stm_categories_style_1 .stm_categories_single:hover .mtc',
				'.stm_slider_style_8 .owl-nav .owl-prev:hover',
				'.stm_slider_style_9 .owl-nav .owl-prev:hover',
				'.stm_slider_style_8 .owl-nav .owl-next:hover',
				'.stm_slider_style_9 .owl-nav .owl-next:hover',
				'.vc_images_carousel .vc_carousel-indicators li',
				'.stm_slider_style_8 .stm_slide__button a',
				'.stm_sidebar_style_14 .site-content .widget.widget_tag_cloud .tagcloud a:hover',
				'.stm_shop_layout_store.single-product div.product .summary.entry-summary .onsale',
				'.stm_shop_layout_store.single-product div.product .summary.entry-summary .single_add_to_cart_button:hover',
				'.stm_layout_factory .stm_headings_line.stm_headings_line_bottom .vc_custom_heading:after',
				'.stm_layout_company .stm-header.active',
				'.stm_layout_company .stm_mobile__header',
				'.stm-navigation__hamburger > ul',
				'.stm-navigation__hamburger .stm_mobile__switcher:before',

				/*Buttons*/
				'.btn_primary.btn_solid:hover',
				'.btn_primary.btn_solid.active',
				'.btn_secondary.btn_solid:hover',
				'.btn_third.btn_solid',

				'.btn_third.btn_outline:hover',
				'.btn_primary.btn_outline:hover .btn__icon:after',
				'.btn_primary.btn_solid .btn__icon:after',

				'.btn_third.btn_outline .btn__icon:after',

				'.btn_white.btn_solid:hover',

				'.stm_slider_style_3.stm_slider .stm_slide__button a:hover',
			)
		),
		'border_colors' => array(
			'main_color'      => array(
				'.mbdc',
				'.mbdc_h:hover',
				'.mbdc_b:before',
				'.mbdc_b_h:hover:before',
				'.mbdc_a:after',
				'.mbdc_a_h:hover:after',
				'.tparrows.persephone:hover',
				'.owl-nav .owl-prev:hover',
				'.owl-nav .owl-next:hover',
				'.stm_pagination_style_1 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_1 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_19 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_19 ul.page-numbers .page-numbers.current',
				'.stm_pagination_style_18 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_18 ul.page-numbers .page-numbers.current',
				'.form-control:focus',
				'.widget_tag_cloud .tagcloud a:hover',
				'.stm_partners_style_2 .stm_partners__single:hover .stm_partners__image:before',
				'.dropcaps_bordered:first-letter',
				'.stm_single_post_style_2 .stm_post__tags a',
				'blockquote',
				'.stm_pagination_style_2 .page-numbers.next',
				'.stm_widget_search.style_2 button:hover',
				'.stm_input_wrapper:before',
				'.stm_carousel_style_2 .owl-dots .owl-dot.active:before',
				'.btn_primary.btn_solid',
				'.working_hours_style_1 .widget_inner',
				'.working_hours_style_1 .widgettitle:before',
				'.working_hours_style_1 .widgettitle:after',
				'.stm_pagination_style_4 ul.page-numbers .page-numbers',
				'.stm_pagination_style_5 ul.page-numbers li.stm_page_num .page-numbers',
				'.stm_pagination_style_5 ul.page-numbers li.stm_next:hover .page-numbers',
				'.stm_pagination_style_5 ul.page-numbers li.stm_prev:hover .page-numbers',
				'.stm_pagination_style_6 ul.page-numbers li.stm_page_num .page-numbers',
				'.stm_pagination_style_6 ul.page-numbers li.stm_next:hover .page-numbers',
				'.stm_pagination_style_6 ul.page-numbers li.stm_prev:hover .page-numbers',
				'.stm_carousel_style_4 .owl-dots .owl-dot span',
				'.stm_widget_pages_style_3 ul',
				'.stm_single_post_style_6 .stm_flex .stm_post__tags a:hover',
				'.stm_opening_hours_table_style_1 .day.today',
				'.stm_opening_hours_table_style_1 .day.opens',
				'.stm_opening_hours_table_style_1 .day:hover',
				'.stm_testimonials_style_6 .stm_testimonials__item:hover,.stm_testimonials_style_6 .stm_testimonials__item:hover:before',
				'.stm_staff_container_grid.style_6 .stm_staff__socials > li > a:hover',
				'.stm_pagination_style_7 ul.page-numbers .page-numbers:not(.current):hover',
				'.stm_pagination_style_8 ul.page-numbers li .page-numbers:hover',
				'.btn_inverted.stm_load_posts:hover',
				'.stm_posttimeline_style_2 .stm_posttimeline__year.active span',
				'.stm_pagination_style_8 .owl-controls .owl-nav .owl-prev:hover, .stm_pagination_style_8 .owl-controls .owl-nav .owl-next:hover',
				'.stm_video.stm_video_style_5 .stm_playb:after',
				'.stm_posts_list_style_3 .stm_posts_list_single__body:after',
				'.stm_post_style_8.stm_post_view_grid .stm_loop__grid .stm_posts_list_single__body:after',
				'.stm_events_list.inverted .stm_event_single_list__alone .btn:hover',
				'.services_price_list_style_2 .services_pills_container li.active a:after',
				'.stm_pagination_style_9 .owl-dots .owl-dot.active span',
				'.stm_testimonials_style_8 .owl-controls .owl-dots .owl-dot span',
				'.stm_testimonials_style_9 .owl-controls .owl-dots .owl-dot span',
				'.widget_contacts_style_7 .widget_contacts_inner',
				'.stm_carousel_style_7 .owl-dots .owl-dot span',
				'.services_price_list_style_3 .service__badge',
				'.services_price_list_style_2 .services_pills_container:before',
				'.services_price_list_style_2 .services_pills_container:after',
				'.stm_testimonials_style_2 .owl-dots .owl-dot.active',
				'.stm_form_style_8 input:focus',
				'.stm_header_style_9 .stm-navigation__default .sub-menu li',
				'.open-table-widget-datepicker',
				'.open-table-widget .selectric-items',
				'.open-table-widget .selectric-open .selectric',
				'.stm_staff_grid_style_1 .stm_staff__image .stm_staff__socials li a',
				'.stm_staff_grid_style_3 .stm_staff__image .stm_staff__socials li a',
				'.stm_form_style_9 input:active, .stm_form_style_9 input:focus, .stm_form_style_9 textarea:active, .stm_form_style_9 textarea:focus',
				'.stm_footer_layout_2 .stm-footer__bottom',
				'.stm_widget_pages_style_5 ul',
				'select[multiple]',
				'.stm_iconbox_style_10 .stm_iconbox__icon',
				'.stm_video_style_6:hover .stm_playb:after',
				'.stm_buttons_style_12 .btn.btn_primary:after',
				'.stm_sidebar_style_12 .stm_wp_widget_text .stm-socials a:hover',
				'.stm_sidebar_style_12 .stm_wp_widget_text .stm-socials a:hover:before',
				'.stm_icon_links_style_4 a',
				'.stm_footer_layout_3 .stm-footer__bottom .stm-socials__icon',
				'.bsd_i>.vc_column-inner',
				'.vc_images_carousel .vc_carousel-indicators li.vc_active',
				'.stm_single_post_video_format:hover:after',
				'.stm_pagination_style_14 .page-numbers.current',
				'.stm_pagination_style_16 .page-numbers.current',
				'.stm_pagination_style_17 .page-numbers.current',
				'.stm_posts_carousel_style_4 .stm_posts_carousel_single__read_more:hover [class*=stmicon]',
				'.stm_woo_category_link_box .vc_sep_holder:after',
				'.stm_woo_category_link_box .stm_woo_category_link_box_thumbnail_frame:after',
				'.stm_sidebar_style_17 .stm_wp_widget_post_gallery_style_1',
				'.stm_sidebar_style_17 .widget_tag_cloud',
				'.stm_sidebar_style_17 .stm_posts_list_style_16',
				'.stm-address-box .stm-address-info',
				'.stm_form_style_13 input:focus',
				'.stm_form_style_13 textarea:focus',
				'.stm_form_style_14 input:focus',
				'.stm_form_style_14 textarea:focus',
                '.stm_pricing-table-flip_style_2.stm_flipbox .stm_flipbox__front',

				'.woocommerce .stm_woo_products .owl-prev',
				'.woocommerce .stm_woo_products .owl-next',

				/*Buttons*/
				'.btn_primary.btn_solid',
				'.btn_primary.btn_outline',
				'.stm_slider_style_2.stm_slider .stm_slide__button a',
			),
			'secondary_color' => array(
				'.sbdc',
				'.sbdc_h:hover',
				'.sbdc_a:after',
				'.sbdc_a_h:hover:after',
				'.sbdc_b:before',
				'.sbdc_b_h:hover:before',
				'.stm_testimonials_style_3 .owl-dots .owl-dot.active',
				'.stm_carousel_style_2 .owl-dots .owl-dot.active:before',
				'.stm_services_text_carousel_style_2 .owl-dot.active',
				'.stm_pagination_style_2 .owl-dot.active',
				'.stm_services_style_4 .stm_services__title:after',
				'.stm_pagination_style_4 ul.page-numbers .page-numbers:hover',
				'.stm_pagination_style_4 ul.page-numbers .page-numbers.current',
				'.stm_tour_style_2 .vc_tta-tabs-position-left .vc_tta-tab.vc_active a',
				'.stm_pricing-table_style_4.has-label',
				'.stm_pagination_style_6 .owl-nav .owl-prev:hover, .stm_pagination_style_6 .owl-nav .owl-next:hover',
				'.stm_form_style_6 .stm_input_wrapper_checkbox:before',
				'.stm_buttons_style_12 .btn.btn_secondary:after',
				'.stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover',
				'.woocommerce .stm_woo_products .owl-prev:hover',
				'.woocommerce .stm_woo_products .owl-next:hover',
				'.store_newsletter .mc4wp-form-fields .btn',
				'.stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover',
				'.stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover',
				'.stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover',
				'.stm_pagination_style_14 .owl-controls .owl-dot span',
				'.stm_form_style_10 .form-control',
				'.woocommerce .stm_product_vertical_carousel .slick-slide.slick-current img',
				'.stm_posts_video_style_1 .stm_post_video__wrapper .post_video__image .post_video__icon_play.stc',
				'.stm_layout_factory .btn_primary.btn_solid:hover',
				'.stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover',

				/*Buttons*/
				'.btn_secondary.btn_outline',
				'.stm_slider_style_4 .stm_slide__button a',
			),
			'third_color'     => array(
				'.tbdc',
				'.tbdc_h:hover',
				'.tbdc_a:after',
				'.tbdc_a_h:hover:after',
				'.tbdc_b:before',
				'.tbdc_b_h:hover:before',
				'.stm_pagination_style_8 .owl-controls .owl-nav .owl-prev, .stm_pagination_style_8 .owl-controls .owl-nav .owl-next',
				'.stm_pagination_style_8 ul.page-numbers li .page-numbers.current',
				'.stm_form_style_7 select:focus, .stm_form_style_7 input[type="text"]:focus, 
				.stm_form_style_7 input[type="email"]:focus, .stm_form_style_7 input[type="search"]:focus, 
				.stm_form_style_7 input[type="password"]:focus, .stm_form_style_7 input[type="number"]:focus, 
				.stm_form_style_7 input[type="date"]:focus, .stm_form_style_7 input[type="tel"]:focus, 
				.stm_form_style_7 textarea:focus, .stm_form_style_7 .stm_select:focus, 
				.stm_form_style_7 .stm_select .form-control:focus',
				'.vc_images_carousel .vc_carousel-indicators li',
				'.stm_sidebar_style_14 .site-content .widget.stm_widget_categories.style_2',
				'.stm_sidebar_style_14 .site-content .widget.widget_tag_cloud .tagcloud a:hover',


				/*Buttons*/
				'.btn_primary.btn_solid:hover',
				'.btn_primary.btn_solid.active',
				'.btn_third.btn_outline',
				'.stm_widget_search.style_2 button',
				'.stm_events_list_style_4 .stm_events_list.not-inverted .btn',
				'.store_newsletter .mc4wp-form-fields .btn:hover',

			),
		)
	);

	$res = $elements_list;


	if (!empty($type)) {
		$res = $elements_list[$type];
		if (!empty($color)) {
			$res = $elements_list[$type][$color];
		}
	}


	return apply_filters('pearl_get_custom_styled_elements_array', $res);

}

function pearl_update_custom_styles()
{

	global $wp_filesystem;

	if (empty($wp_filesystem)) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}

	/*Generate custom css*/
	$custom_css = '';
	//Disable theme HB styles if HB plugin enabled
	if (!pearl_stm_hb_enabled()) {
		$custom_css .= pearl_header_elements_styles();
		$custom_css .= pearl_header_element_custom_styles();
	}
	$custom_css .= preg_replace('/\s+/', ' ', pearl_custom_styles());

	/*Create dir or update*/
	$upload_dir = wp_upload_dir();

	if (!$wp_filesystem->is_dir($upload_dir['basedir'] . '/stm_uploads')) {
		$wp_filesystem->mkdir($upload_dir['basedir'] . '/stm_uploads', FS_CHMOD_DIR);
	}

	$custom_style_file = $upload_dir['basedir'] . '/stm_uploads/skin-custom.css';

	/*Update V*/
	$current_v = get_option('stm_custom_styles_v', 1) + 1;
	update_option('stm_custom_styles_v', $current_v);

	$wp_filesystem->put_contents($custom_style_file, $custom_css, FS_CHMOD_FILE);

}

function pearl_custom_inline_styles($handle = 'pearl-theme-styles')
{
	$custom_css = '';
	wp_add_inline_style($handle, apply_filters('pearl_custom_inline_styles', $custom_css));
}

function pearl_header_elements_styles()
{
	$custom_css = '';
	$top_bar_bg = pearl_get_image_url(pearl_get_option('top_bar_bg'));
	$header_bg = pearl_get_image_url(pearl_get_option('header_bg'));
	$bottom_bar_bg = pearl_get_image_url(pearl_get_option('bottom_bar_bg'));

	$styles = array(
		'.stm-header__row_color_top'                                           => array(
			'padding-top'         => pearl_get_option('top_bar_top'),
			'padding-bottom'      => pearl_get_option('top_bar_bottom'),
			'background-image'    => esc_url($top_bar_bg),
			'color'               => pearl_get_option('top_bar_text_color'),
			'.stm-icontext__text' => array(
				'color' => pearl_get_option('top_bar_text_color')
			),
			'a'                   => array(
				'color' => pearl_get_option('top_bar_text_color')
			),
			'a:hover'             => array(
				'color' => pearl_get_option('top_bar_link_color_hover')
			),
			'li:hover a'          => array(
				'color' => pearl_get_option('top_bar_link_color_hover')
			),
		),
		'.stm-header__row_color_top:before'                                    => array(
			'background-color' => pearl_get_option('top_bar_color'),
		),
		'.stm-header__row_color_center'                                        => array(
			'padding-top'             => pearl_get_option('header_top'),
			'padding-bottom'          => pearl_get_option('header_bottom'),
			'background-image'        => esc_url($header_bg),
			'color'                   => pearl_get_option('header_text_color'),
			'.stm-icontext__text'     => array(
				'color' => pearl_get_option('header_text_color')
			),
			'a'                       => array(
				'color' => pearl_get_option('header_text_color')
			),
			'li:hover > a'            => array(
				'color' => pearl_get_option('header_text_color_hover') . '!important'
			),
			'a:hover'                 => array(
				'color' => pearl_get_option('header_text_color_hover') . '!important'
			),
			'a > .divider'            => array(
				'color' => pearl_get_option('header_text_color') . '!important'
			),
			'a:hover > .divider'      => array(
				'color' => pearl_get_option('header_text_color') . '!important'
			),
			'li:hover > a > .divider' => array(
				'color' => pearl_get_option('header_text_color') . '!important'
			)
		),
		'.stm-header__row_color_center:before'                                 => array(
			'background-color' => pearl_get_option('header_bg_fill') === 'full' ? pearl_get_option('header_color') : '',
		),
		'.stm-header__row_color_center > .container > .stm-header__row_center' => array(
			'background-color' => pearl_get_option('header_bg_fill') === 'container' ? pearl_get_option('header_color') : '',
		),
		'.stm-header__row_color_bottom'                                        => array(
			'padding-top'         => pearl_get_option('bottom_bar_top'),
			'padding-bottom'      => pearl_get_option('bottom_bar_bottom'),
			'background-image'    => esc_url($bottom_bar_bg),
			'color'               => pearl_get_option('bottom_bar_text_color'),
			'.stm-icontext__text' => array(
				'color' => pearl_get_option('bottom_bar_text_color')
			),
			'a'                   => array(
				'color' => pearl_get_option('bottom_bar_text_color')
			),
			'a:hover'             => array(
				'color' => pearl_get_option('bottom_bar_link_color_hover')
			),
			'li:hover a'          => array(
				'color' => pearl_get_option('bottom_bar_link_color_hover')
			)
		),
		'.stm-header__row_color_bottom:before'                                 => array(
			'background-color' => pearl_get_option('bottom_bar_color'),
		),
		'a'                                                                    => array(
			'color' => pearl_color_treads(pearl_get_option('link_color'))
		),
		'a:hover'                                                              => array(
			'color' => pearl_color_treads(pearl_get_option('link_hover_color'))
		),
		'p'                                                                    => array(
			'margin-bottom' => pearl_get_option('p_margin_bottom'),
			'line-height'   => pearl_get_option('p_line_height')
		)
	);

	foreach ($styles as $element => $element_styles) {
		$custom_css .= "{$element}{";
		foreach ($element_styles as $parent_prop => $parent_value) {
			if (!empty($parent_value)) {
				$helpers = pearl_get_style($parent_prop);
				$prefix = $helpers['prefix'];
				$affix = $helpers['affix'];

				/*Second lvl*/
				if (is_array($parent_value)) {
					$custom_css .= "} {$element} {$parent_prop} {";
					foreach ($parent_value as $prop => $value) {
						$helpers = pearl_get_style($parent_prop);
						$prefix = $helpers['prefix'];
						$affix = $helpers['affix'];

						$custom_css .= "{$prop}:{$prefix}{$value}{$affix};";
					}
				} else {
					/*First lvl*/
					$custom_css .= "{$parent_prop}:{$prefix}{$parent_value}{$affix};";
				}
			}
		}
		$custom_css .= '}';
	}

	return $custom_css;
}

function pearl_header_element_custom_styles()
{
	$custom_css = '';
	$data = apply_filters('pearl_builder_elements', pearl_get_option('header_builder'));
	if (empty($data)) return null;

	foreach ($data as $row => $columns) {
		foreach ($columns as $column => $elements) {
			foreach ($elements as $data) {
				$element = sanitize_title($data['$$hashKey']);
				if (!empty($element)) {

					$element = ".stm-header__element.{$element}";
					$media = array(
						'default' => '(min-width:1023px)',
						'tablet'  => '(max-width:1023px) and (min-width:425px)',
						'mobile'  => '(max-width:425px)'
					);


					/*Generate margins*/
					if (!empty($data['margins'])) {
						foreach ($data['margins'] as $display => $margins) {
							if (!empty($margins)) {
								$custom_css .= "@media {$media[$display]}{{$element}{";
								foreach ($margins as $prop => $value) {
									if (isset($prop) && !empty($value)) {
										$custom_css .= "margin-{$prop}:{$value}px !important;";
									}
								}
								$custom_css .= "}}";
							}
						}
					}
					/*Generate text color*/
					if (array_has($data, 'data.textColor.name') && $data['data']['textColor']['name'] === 'Custom') {
						$custom_css .= $element . "{color: " . $data['data']['textColor']['value'] . "}";
					}

					/*Generate icon color*/
					if (array_has($data, 'data.iconColor.name') && $data['data']['iconColor']['name'] === 'Custom') {
						$custom_css .= $element . " [class*='_icon'] {color: " . $data['data']['iconColor']['value'] . "}";
					}


					/*Menu item hover line*/
					if (array_has($data, 'data.lineColor') && !empty($data['data']['lineColor']) &&
						array_has($data, 'data.line') && !empty($data['data']['line'])
					) {
						$custom_css .= $element . " li:before {background-color: {$data['data']['lineColor']} !important;}";
					}

                    /*Menu font size*/
                    if (array_has($data, 'data.fsz') && !empty($data['data']['fsz']) ) {
                        $custom_css .= $element . " li a {font-size: {$data['data']['fsz']}px !important;}";
                    }

					/*Menu item a color*/
					if (array_has($data, 'data.menuLinkColor') && !empty($data['data']['menuLinkColor'])) {
						$custom_css .= $element . " li a {color: {$data['data']['menuLinkColor']} !important;}";
					}
					/*Menu item a color on hover*/
					if (array_has($data, 'data.menuLinkColorOnHover') && !empty($data['data']['menuLinkColorOnHover'])) {
						$custom_css .= $element . " li a:hover {color: {$data['data']['menuLinkColorOnHover']} !important;}";
						$custom_css .= $element . " li:hover > a {color: {$data['data']['menuLinkColorOnHover']} !important;}";
					}

					if (!empty($data['order'])) {
						foreach ($media as $device => $breakpoint) {
							if (!empty($data['order'][$device])) {
								$custom_css .= "@media {$breakpoint} {";
								$custom_css .= $element . "{order: -{$data['order'][$device]}}";
								$custom_css .= "}";
							}
						}
						$custom_css .= $element . "{}";
					}

					$disabled_devices = (!empty($data['disabled'])) ? array_keys(array_filter($data['disabled'])) : array();
					if (!empty($disabled_devices)) {
						foreach ($media as $device => $breakpoint) {
							if (in_array($device, $disabled_devices)) {
								$custom_css .= "@media {$breakpoint} {";
								$custom_css .= $element . "{display: none!important};";
								$custom_css .= "}";
							}
						}
					}

//					Full height
					if (!empty($data['fullHeight']) && $data['fullHeight'] === 'true') {
						$custom_css .= $element . '{height: 100%;}';
					}
				}
			}
		}
	}

	return $custom_css;
}

function pearl_custom_styles()
{
	ob_start();
	get_template_part('partials/skin/skin_template');
	get_template_part('partials/skin/fonts');
	get_template_part('partials/skin/responsive');
	if (class_exists('WooCommerce')) {
		get_template_part('partials/skin/woocommerce');
	}
	get_template_part('partials/skin/layouts/' . get_option('stm_layout', 'business') . '/style');

	return apply_filters('pearl_custom_styles', ob_get_clean());
}

function pearl_get_style($key = '')
{
	$r = array(
		'prefix' => '',
		'affix'  => ''
	);

	$metrix = array(
		'padding-top',
		'padding-bottom',
		'margin-bottom',
		'line-height',
		'border-width'
	);

	$src = array(
		'background-image'
	);

	/*Set px*/
	if (in_array($key, $metrix)) {
		$r['affix'] = 'px';
	}

	/*Set url*/
	if (in_array($key, $src)) {
		$r['prefix'] = 'url("';
		$r['affix'] = '")';
	}

	return apply_filters('pearl_get_style', $r);
}

function pearl_css_styles($font, $ff_only = false, $result = false)
{
	$style = "";
	if (!empty($font['name'])) $style .= "font-family:'{$font['name']}';";
	if (!$ff_only) {
		if (!empty($font['color'])) $style .= "color:{$font['color']};";
		if (!empty($font['size'])) $style .= "font-size:{$font['size']}px;";
		if (!empty($font['fw'])) $style .= "font-weight:{$font['fw']};";
		if (!empty($font['ln'])) $style .= "line-height:{$font['ln']}px;";
		if (!empty($font['ls'])) $style .= "letter-spacing:{$font['ls']}px;";
		if (!empty($font['mgb'])) $style .= "margin-bottom:{$font['mgb']}px;";
	}

	$style = apply_filters('pearl_font_styles', $style);

	if ($result) return $style;

	echo sanitize_text_field($style);
}


