<?php
extract($atts);

$style = 'style_1';

pearl_add_element_style('upcoming_events', $style);
wp_enqueue_script('jquery.countdown');

$translations = array(
	'month'    => esc_html__('months, months', 'pearl'),
	'days'    => esc_html__('days, days', 'pearl'),
	'hours'   => esc_html__('hours, hrs', 'pearl'),
	'minutes' => esc_html__('minutes, min', 'pearl'),
	'seconds' => esc_html__('seconds, sec', 'pearl'),
);
wp_localize_script('pearl_upcoming_event', 'pearl_translations', $translations);
wp_enqueue_script('pearl_upcoming_event');

$classes = array(
	'stm_upcoming_events',
	'stm_upcoming_events_' . $style
);

$event_query_args = array(
	'post_type'      => 'stm_events',
	'posts_per_page' => 4,
	'order'          => 'DESC',
	'orderby'        => 'meta_value_num',
	'meta_query'     => array(

		array(
			'key'     => 'date_start_timestamp',
			'value'   => time(),
			'compare' => '>',
		)
	)
);

$has_link = false;

if (!empty($link)) {
	$link = vc_build_link($link);
	$has_link = true;
}

$event_query = new WP_Query($event_query_args);
$first_event = '';
$last_events = '';


if ($event_query->have_posts()) {
	while ($event_query->have_posts()) :
		$event_query->the_post();
		$date_start_timestamp = get_post_meta(get_the_ID(), 'date_start_timestamp', true);
		$date_start_string = pearl_get_formatted_date($date_start_timestamp, 'F j, Y');
		?>
		<?php
		if ($event_query->current_post === 0) :
			ob_start();
			$post_image_url = pearl_get_VC_post_img_safe(get_the_ID(), '1460x1044', 'full', true);
			?>
            <div class="stm_upcoming_events_first"
                 style="background: url(<?php echo esc_url($post_image_url); ?>);">

                <div class="stm_upcoming_event__content">
                    <div class="stm_upcoming_event__counter">
                        <div class="stm_upcoming_event__counter-container"
                             data-abbr="true"
                             data-date="<?php echo esc_js(date('Y/m/d', $date_start_timestamp)); ?>">
                        </div>
                    </div>

                    <div class="stm_flex_col stm_upcoming_event__info">
                        <div class="stm_upcoming_event__title">
                            <h5>
                                <a class="no_deco" href="<?php the_permalink(); ?>"
                                   title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h5>
                        </div>
                        <div class="stm_upcoming_event__info_footer">
                            <div class="stm_upcoming_event__date">
								<i class="stmicon-psychologist_calendar"></i>
                                <span><?php echo wp_kses($date_start_string, array()); ?></span>
                            </div>
                            <div class="stm_upcoming_event__link">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"
                                   class="mtc mbdc mbdc_b no_deco heading_font">
									<?php echo esc_html__('Details', 'pearl') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			$first_event .= ob_get_clean();
		else :
			ob_start();
			?>
            <div class="stm_upcoming_event__single">
                <div class="stm_flex_col stm_upcoming_event__info">
                    <div class="stm_upcoming_event__title">
                        <h3>
                            <a class="no_deco" href="<?php the_permalink(); ?>"
                               title="<?php the_title(); ?>"><?php echo pearl_minimize_word(get_the_title(), 40) ; ?></a>
                        </h3>
                    </div>
                    <div class="stm_upcoming_event__info_footer">
                        <div class="stm_upcoming_event__date">
                            <span><?php echo wp_kses($date_start_string, array()); ?></span>
                        </div>
                        <div class="stm_upcoming_event__link">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"
                               class="mtc mbdc mbdc_b no_deco heading_font">
								<?php echo esc_html__('Details', 'pearl') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			$last_events .= ob_get_clean();
		endif;
	endwhile;
	?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <div class="row">
            <div class="col-md-8">
				<?php echo html_entity_decode($first_event); ?>
            </div>
            <div class="col-md-4 stm_upcoming_events__list">
                <div class="row">
					<?php echo html_entity_decode($last_events); ?>
                </div>
            </div>
        </div>
    </div>
	<?php
} else {
	_e('No upcoming events', 'pearl');
}

wp_reset_query();



