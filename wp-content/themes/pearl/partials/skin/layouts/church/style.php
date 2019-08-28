<?php $headings_big = array('h1', 'h2', 'h3'); ?>

.stm-header__row_color.stm-header__row_color_top:before {
	background-color: #1a1a1a !important;
}

.stm_page_bc {
    a {
        color: #808080 !important;
    }
}


@media (max-width:768px) { <?php
foreach ($headings_big as $heading) :
	echo sanitize_text_field(".{$heading}, {$heading} {");
	$settings = array_filter(pearl_get_option("{$heading}_settings", array()));
	$settings = wp_parse_args($settings, $secondary_font);

	if(!empty($settings['size'])):
		$font_size = intval($settings['size']*0.75); ?>
        font-size: <?php echo sanitize_text_field($font_size); ?>px !important;
	<?php endif; ?>
    line-height: 1.2 !important;
	<?php echo sanitize_text_field("}");
endforeach; ?>
}

.stm_events_layout_4 {
    .stm_single_stm_events {
        .stm_single_event__title {
            h2 {text-transform: none !important; font-size: 42px; }
        }
    }
}