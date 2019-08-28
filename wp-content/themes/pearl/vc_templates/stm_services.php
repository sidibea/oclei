<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
/**
 * @var $number
 * @var $pagination
 *
 */

if (empty($atts['img_size'])) {
    $atts['img_size'] = '370x245';
}
extract($atts);

$classes = array('stm_services stm_loop', 'stm_services_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

pearl_add_element_style('services', $style);

$number = !empty($number) ? $number : 9;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

if($pagination == 'off') $paged = 1;

$args = array(
    'post_type' => 'stm_services',
    'posts_per_page' => $number,
    'post_status' => 'publish',
    'paged' => $paged
);

if(!empty($taxonomy)) {
    $taxonomies = explode(',', $taxonomy);
	$args['tax_query'] = array();
    $args['tax_query'][] = array(
        'taxonomy' => 'service_category',
        'field' => 'id',
        'terms' => $taxonomies
    );
}


$atts['excerpt'] = (!empty(intval($excerpt))) ? $excerpt : '99999';

$q = new WP_Query($args);
if ($q->have_posts()): ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <?php while ($q->have_posts()): $q->the_post();
            $atts['current'] = $q->current_post;
            ?>
            <?php pearl_load_vc_element('services', $atts, 'grid_' . $style); ?>
        <?php endwhile; ?>
    </div>

    <?php
    if($pagination !== 'off') {

        echo pearl_pagination(
            array(
                'type' => 'list',
                'format' => '?paged=%#%',
                'current' => $paged,
                'total' => $q->max_num_pages,
            )
        );
    }

    wp_reset_postdata();
    ?>
<?php endif; ?>