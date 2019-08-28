<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
/**
 * @var $number
 * @var $pagination
 * @var $per_row
 *
 */
extract($atts);

$classes = array('stm_donation', 'stm_donation_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

pearl_add_element_style('donations', $style);

$number = !empty($number) ? $number : 9;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if ($pagination == 'off') $paged = 1;

$args = array(
	'post_type'      => 'stm_donations',
	'posts_per_page' => $number,
	'post_status'    => 'publish',
	'paged'          => $paged,
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC',
	'meta_query'     => array(
		array(
			'key' => 'date_end'
		)
	)
);

$q = new WP_Query($args);

if ($q->have_posts()): ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="row">
			<?php while ($q->have_posts()): $q->the_post(); ?>
				<?php pearl_load_vc_element('donations', $atts, $style); ?>
			<?php endwhile; ?>
		</div>
	</div>

	<?php
	if ($pagination !== 'off') {

		echo pearl_pagination(
			array(
				'type'    => 'list',
				'format'  => '?paged=%#%',
				'current' => $paged,
				'total'   => $q->max_num_pages,
			)
		);
	}

	wp_reset_postdata();
	?>
<?php endif; ?>