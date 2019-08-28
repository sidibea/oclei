<?php
/*Fonts*/
$fonts = pearl_get_font();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
$headings_big = array('h1', 'h2', 'h3');
?>


.stm_slider_style_7 .stm_slide__button a,
.stm_sidebar_style_11 .stm-footer__bottom .stm_markup > div,
.stm_sidebar_style_8 .stm-footer .stm_bottom_copyright span,
.stm_sidebar_style_8 .stm-footer .stm_bottom_copyright a,
.stm_iconbox_style_4 .stm_iconbox__text h5,
.stm_blockquote_style_5 blockquote cite,
.stm_lists_style_1 .wpb_text_column ul.main_font li,
.stm_post_style_5 #cancel-comment-reply-link,
body,
.main_font,
.stm_header_style_4 .stm-navigation > ul > li > ul.sub-menu,
.stm_tabs_style_3  .vc_tta-title-text,
.stm_sidebar_style_4 .stm_bottom_copyright,
.stm_single_post_style_4 .stm_single_post__tags a,
.stm_testimonials_style_7 .stm_testimonials__info h6,
.stm_sidebar_style_9 .stm-footer__bottom .stm_bottom_copyright,
.stm_blockquote_style_9 blockquote cite
{
    <?php
    $lh = round($main_font['ln'] / $main_font['size'], 3);
	pearl_css_styles($main_font);
    ?>
    line-height: <?php echo sanitize_text_field($lh) ?>em;
}

.main_font,
.stm_project_details_style_5 .stm_project_details__value,
.stm_project_details_style_6 .stm_project_details__value,
.stm_project_details_style_7 .stm_project_details__value,
.stm_projects_style_2 .stm_taxonomy h6,
.stm-navigation__default.main_font a,
.stm_contact_style_4 h5,
#audio-player .mejs-container,
.stm_header_style_4 .stm-navigation li a,
.stm_accordions_style_4 .vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text,
.stm_tabs_style_3 .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-title-text,
.stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab .vc_tta-title-text,
.error_page_style_7 .stm_errorpage__inner h1,
.stm_pagination_style_14 .page-numbers,
.sharethis-inline-share-buttons .st-total span.st-label,
.sharethis-inline-share-buttons_bottom .st-total span.st-shares,
.sharethis-inline-share-buttons.in-content .st-total span.st-shares,
{
    <?php pearl_css_styles($main_font, true) ?>
}

<?php echo esc_attr(implode(', ', $headings)) ?>,
	.<?php echo esc_attr(implode(', .', $headings)) ?>,
	.heading_font {
    <?php pearl_css_styles($secondary_font); ?>;
	letter-spacing: <?php echo floatval(pearl_get_option('headings_letter_spacing', 0)); ?>px;
	}
<?php

if(!empty($secondary_font['name'])): ?>
    .stm_blockquote_style_11 blockquote,
    .stm_buttons_style_3 .btn,
    .stm-counter_style_2 .stm-counter__label,
    .stm_infobox_style_1 .stm_infobox__content span,
    .stm_infobox_style_1 .stm_infobox__content a,
    .stm_sidebar_style_3 .stm_widget_posts.style_2>ul li .stm_widget_posts__title,
    .stm_sidebar_style_11 .widget.widget_recent_entries ul li a,
    .stm_single_post .stm_single_post_style_11 .stm_image_description,
    .stm_demo_sidebar__url,
    .stm_demo_sidebar__buy,
	.stm_blockquote_style_10 blockquote,
	.stm_single_post .stm_single_post_style_11 .wp-caption .wp-caption-text,
	ul.page-numbers li.stm_page_num span, ul.page-numbers li.stm_page_num a,
	.stm_single_post table thead tr th,
	.woocommerce-account .woocommerce-MyAccount-content fieldset legend,
	.woocommerce-account .woocommerce-EditAccountForm label,
	.woocommerce-thankyou-order-received,
	.stm_sidebar_style_8 .stm_markup__sidebar_divider aside.widget.stm_widget_categories.style_1 ul li a,
	.single-post.stm_post_style_8 .stm_post_actions .stm_post__tags,
	.stm_post_style_8 .stm_post_details,
	.stm_buttons_style_8 .btn,
	.stm_buttons_style_8 button,
	.widget_calendar caption,
	.stm_titlebox_style_8,
	.stm_events_list_style_4 .stm_event_single_list > div,
	.stm_projects_grid_style_5,
	.stm_icontext_style_3 span span,
	.stm_icontext_style_4 span span,
	.stm_posts_list_style_3 .stm_posts_list_single__body,
    .ui-timepicker-container .ui-timepicker li a,
    .stm_blockquote_style_7 blockquote,
    .stm_widget_posts.style_4 .stm_widget_posts__title,
    .stm_buttons_style_6 .btn,
    .stm_buttons_style_6 button,
    .stm_stories_style_2 .stm_story__title,
    .stm_gmap_wrapper.style_2 .gmap_addresses .owl-item .item ul li .text:before,
    .stm_header_style_6 .stm-iconbox__text,
    .vc_tta-title-text,
    .stm_testimonials_style_7 .stm_testimonials__review,
	.stm_widget_posts.style_6 .stm_widget_posts__title,
	.services_price_list_style_2.services_price_list_list .services__tab_heading,
	.stm_buttons_style_2 .btn,
	.stm_buttons_style_2 button,
    .stm_blockquote_style_9 blockquote,
    .stm_services_single__prices li span,
    .stm_services_single__panel .stm_services_single__phone,
	.stm-counter_style_6 .stm-counter__prefix,
	.stm-counter_style_6 .stm-counter__value,
	.stm-counter_style_6 .stm-counter__affix,
    .special_offer_product__countdown .count_meta,
    .stm_shop_layout_store.single-product div.product .woocommerce-tabs .comment-reply-title,
    .stm_shop_layout_store.single-product div.product .woocommerce-tabs .comment-form label,
    .stm_posts_list_style_10 .stm_posts_list_single__category,
    .stm_posts_carousel_style_2 .stm_posts_carousel_single__category,
    .single-format-standard.stm_post_style_21 .drop_caps,
    .stm_blockquote_style_13 blockquote p,
    .stm_titlebox_style_12 .stm_titlebox__subtitle,
    .stm_single_post_style_24 .sharethis-inline-share-buttons .st-total .st-label,
    .stm_widget_posts.style_9 .stm_widget_posts__title,
    .stm_sidebar_style_18 .stm_widget_categories.style_1 ul li
    {
        font-family: "<?php echo esc_attr($secondary_font['name']); ?>";
    }

<?php endif;

if (pearl_check_string(pearl_get_option('headings_line'))) {
    echo esc_attr(implode(':before,', $headings)) . ':before,';
    echo esc_attr(implode(':after,', $headings)) . ':after,';
    echo esc_attr(implode(':before,.', $headings)) . ':before,';
    echo esc_attr(implode(':after,.', $headings)) . ':before';
    $heading_width = pearl_get_option('headings_line_width', 46);
    $heading_height = pearl_get_option('headings_line_height', 5); ?>
    {
        width: <?php echo esc_attr($heading_width)?>px !important;
        height: <?php echo esc_attr($heading_height) ?>px !important;
    }
<?php } ?>

.stm_event_wide_details .stm_single_event_part-label,
.stm_project_details_style_4 .stm_project_details__label,
.stm_projects_grid_style_2 .stm_projects_carousel__tab a,
.stm_buttons_style_style_3 .stm_select .stm-select__val,
.stm_vacancies_style_3 .stm_details .info .stm_details__value,
.stm_single_post_style_1 .stm_author_box .stm_author_box__name,
.stm_single_post_style_1 ul.comment-list .comment .comment-meta,
.stm_pagination_style_3 .page-numbers,
.stm_lists_style_1 .wpb_text_column ul li,
.stm_blockquote_style_3 blockquote,
.stm_single_event__calendar .addtocalendar,
.stm_staff_list_style_3 .stm_staff__job,
.stm_testimonials_style_4 .stm_testimonials__review,
.stm_sidebar_style_1 .widget.widget_recent_entries ul li a,
.stm_contact_style_2 .stm_contact__info,
.vc_progress_bar .vc_single_bar .vc_label,
.stm_header_style_1 .stm-navigation,
.widget_contacts_style_2 .widget_contacts_inner,
.stm_widget_posts.style_1 ul li .stm_widget_posts__title,
.stm_material_form,
.stm_testimonials_style_2 .stm_testimonials__review,
.stm_mf,
.stm_blockquote_style_5 blockquote p,
.stm_pagination_style_5 ul.page-numbers li .page-numbers,
.stm_testimonials_style_5 .stm_testimonials__review,
.stm_pricing-table_style_3 .stm_pricing-table__price,
.dropcaps_circle:first-letter,
.dropcaps_style_2:first-letter,
.stm_blockquote_style_4 blockquote,
.stm_cta.style_4 .stm_cta__content,
.stm_blockquote_style_6 blockquote p,
.stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label span,
.stm_sidebar_style_9 .widgettitle h4,
.stm_testimonials_style_10 .stm_testimonials__review,
.stm_post_style_10 .stm_loop__grid .stm_loop__single .post_comments_icon,
.stm_pagination_style_11 .page-numbers,
.stm_layout_logistics.stm_footer_layout_1 .stm_bottom_copyright,
.special_offer_product__countdown .count_meta,
.stm_single_post_style_13 .stm_post_details_wrap .stm_post_details .post_date .day,
.stm_layout_store .stm-cart_style_1 .mini-cart__product-body,
.stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a,
.stm_layout_viral .stm-post-filter ul li a,
.stm-footer .footer-widgets .widget_nav_menu ul li,
.stm_layout_viral table,
.stm-socials-hidden .stm-socials-btn,
.stm-header-popup__button,
.sharethis-inline-share-buttons_bottom .st-total span.st-label,
.sharethis-inline-share-buttons.in-content .st-total span.st-label,
.stm_layout_company.stm_buttons_style_9 .btn,
.stm_layout_company .stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb .stm_slide_thumb_body,
.stm_layout_company .stm_slider_thumbs_container ul.stm_slider_thumbs_list li.stm_slide_thumb .stm_slide_thumb_content

    {
    <?php pearl_css_styles($secondary_font, true); ?>
}

<?php
/*Heading sizes*/
foreach ($headings as $heading) {
    $settings = array_filter(pearl_get_option("{$heading}_settings", array()));
    $settings = wp_parse_args($settings, $secondary_font);
    echo sanitize_text_field(".{$heading}, {$heading} {" . pearl_css_styles($settings, false, true) . "}");

    if(!empty($settings['size'])) {
        $position = intval(round(intval($settings['size']) * 0.5 + 7));
        echo sanitize_text_field($heading) ?> i.position_top {
            top: -<?php echo esc_attr($position); ?>px;
        }
        <?php echo sanitize_text_field($heading) ?> i.position_bottom {
            bottom: -<?php echo esc_attr($position); ?>px;
        }
    <?php }
} ?>

@media (max-width:550px) { <?php
    foreach ($headings_big as $heading) :
        echo sanitize_text_field(".{$heading}, {$heading} {");
            $settings = array_filter(pearl_get_option("{$heading}_settings", array()));
            $settings = wp_parse_args($settings, $secondary_font);

			if(!empty($settings['size'])):
			$font_size = intval($settings['size']*0.85); ?>
            font-size: <?php echo sanitize_text_field($font_size); ?>px !important;
			<?php endif; ?>
            line-height: 1.2 !important;
        <?php echo sanitize_text_field("}");
    endforeach; ?>
}


<?php //Booked
if (class_exists('booked_plugin')):
    $default = pearl_get_layout_config();
    $main_color = pearl_get_option('main_color', $default['main_color']);
    $secondary_color = pearl_get_option('secondary_color', $default['secondary_color']);
    $third_color = pearl_get_option('third_color', $default['third_color']);
    ?>
    body .booked-modal .bm-window p.booked-title-bar small,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time .timeslot-title,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time .timeslot-range,
    .booked-list-view-nav {
        <?php pearl_css_styles($secondary_font, true); ?>
    }
    body #booked-profile-page input[type=submit].button-primary,
    body table.booked-calendar input[type=submit].button-primary,
    body .booked-list-view input[type=submit].button-primary,
    body .booked-modal input[type=submit].button-primary,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button span {
        color: <?php echo esc_attr(pearl_color_treads($third_color)); ?>
    }

    body .booked-list-view .booked-appt-list h2 strong,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time i.fa,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time .timeslot-range {
        color: <?php echo esc_attr(pearl_color_treads($main_color)); ?> !important;
    }
<?php endif;