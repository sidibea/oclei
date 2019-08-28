<?php
extract($atts);

$style = 'style_1';

pearl_add_element_style('upcoming_event', $style);
wp_enqueue_script('jquery.countdown');

$translations = array(
   'days' => esc_html__('days, days', 'pearl'),
	'hours' => esc_html__('hours, hours', 'pearl'),
	'minutes' => esc_html__('minutes, minutes', 'pearl'),
	'seconds' => esc_html__('seconds, seconds', 'pearl'),
);
wp_localize_script('pearl_upcoming_event', 'pearl_translations', $translations);
wp_enqueue_script( 'pearl_upcoming_event' );

$classes = array(
	'stm_upcoming_event',
	'stm_upcoming_event_' . $style
);

$event_query_args = array(
	'post_type'      => 'stm_events',
	'posts_per_page' => 1,
	'order'          => 'ASC',
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


if ($event_query->have_posts()) {
	while ($event_query->have_posts()) {
		$event_query->the_post();

		$date_start_timestamp = get_post_meta(get_the_ID(), 'date_start_timestamp', true);

		$date_start_string = pearl_get_formatted_date($date_start_timestamp, 'F j, Y \a\t g:i A');
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" >
			<div class="row">
				<div class="col-md-4 stm_flex_col stm_upcoming_event__info">
					<div class="stm_upcoming_event__date">
						<div class="stm_upcoming_event__date-title">
							<?php esc_html_e('Upcoming event', 'pearl'); ?>
						</div>
						<div class="stm_upcoming_event__date-sep">
							|
						</div>
						<div class="stm_upcoming_event__date-string">
							<?php echo wp_kses($date_start_string, array()); ?>
						</div>
					</div>

					<div class="stm_upcoming_event__title">
						<h5>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h5>
					</div>
				</div>

				<div class="col-md-4 stm_flex_col stm_upcoming_event__counter">
					<div class="stm_upcoming_event__counter-container" data-date="<?php echo esc_js(date('Y/m/d', $date_start_timestamp)); ?>">

					</div>

				</div>

				<div class="col-md-4 stm_flex_col stm_upcoming_event__actions">
					<div class="stm_flex_row">
						<a class="btn btn_sm btn_primary btn_outline stm_upcoming_event__actions-button"
						   href="<?php the_permalink() ?>"
						   title="<?php the_title() ?>"><?php _e('Read more', 'pearl'); ?></a>



						<?php


						if ($has_link && !empty($link['url'] && !empty($link['title']))) : ?>
							<a class="btn btn_sm btn_primary btn_solid stm_upcoming_event__actions-button"
								<?php if (!empty($link['rel'])) : ?>
									rel="<?php echo esc_attr($link['rel']); ?>"
								<?php endif; ?>
							   href="<?php echo esc_attr($link['url']); ?>"
							   title="<?php echo esc_attr($link['title']); ?>"><?php echo esc_attr($link['title']) ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
} else {
	_e('No upcoming events', 'pearl');
}

wp_reset_query();



