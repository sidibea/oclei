<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$post_type = 'stm_products';
$view = 'grid';

$uniq = uniqid('stm_products_');

$classes = array('stm_products stm_loop');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_products_' . $style;


pearl_add_element_style('products', $style);

$posts_per_page = (!empty($posts_per_page)) ? intval($posts_per_page) : pearl_posts_per_page();

$pagination = pearl_check_string($pagination);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (!$pagination) $paged = 1;

$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'paged'          => $paged,
);

$q = new WP_Query($args);

$tpl = 'partials/content/' . $post_type . '/' . $style;
if ($q->have_posts()): ?>
	<?php if (!empty($show_categories)) : ?>
        <ul class="stm_products_categories">
			<?php
			$products_category = get_terms(array('taxonomy' => 'products_category', 'parent' => 0));
			foreach ($products_category as $category) {
				echo '<li class="mtc_a"><i class="fa fa-caret-right mtc" aria-hidden="true"></i> <a href="' . get_term_link($category, 'products_category') . '" class="stc mtc_h mbc_a">';
				echo esc_attr($category->name);
				echo '</a></li>';
			}
			?>
        </ul>
	<?php endif; ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?> stm_products_<?php echo $per_row ?>_columns">
        <div class="<?php echo esc_attr($uniq); ?>">
			<?php while ($q->have_posts()): $q->the_post();
				pearl_load_vc_element('products', $atts, $style);
			endwhile; ?>
        </div>
    </div>
	<?php if ($q->found_posts > $number): ?>
		<?php if (pearl_check_string($load_more)): ?>
            <a href="#"
               data-element=".<?php echo esc_js($uniq); ?>"
               data-page="1"
               data-per_page="<?php echo esc_js($number); ?>"
               data-style="<?php echo esc_js($style); ?>"
               data-view="<?php echo esc_js($view); ?>"
               data-post_type="<?php echo esc_js($post_type); ?>"
               class="btn btn_outline btn_primary products_more_btn btn_loading stm_load_posts <?php echo esc_attr((!empty($inverted))) ? 'btn_inverted' : 'btn-not_inverted'; ?>">
                <span><?php esc_html_e('Load more', 'pearl'); ?></span>
                <span class="preloader"></span>
            </a>
		<?php endif; ?>
	<?php endif; ?>
	<?php
	if ($pagination) {

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
endif; ?>