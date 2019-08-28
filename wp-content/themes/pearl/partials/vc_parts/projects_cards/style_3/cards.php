<?php
//Due to masonry, 7 images is the best number of images
$offset = (!empty($_GET['offset'])) ? intval($_GET['offset']) : 0;
$args = array(
	'post_type'      => 'stm_projects',
	'posts_per_page' => $number,
	'offset'         => $offset,
	'post_status'    => 'publish',
	'meta_query'     => array(array('key' => '_thumbnail_id'))
);

$q = new WP_Query($args);

$sizes = array(
	'350x350',
);

$classes = array(
	'3x',
);

if ($q->have_posts()):
	$image_key = 0;
	$total = $q->found_posts; ?>
	<?php while ($q->have_posts()): $q->the_post();
		$id = get_the_ID();
		$terms = pearl_get_terms_array($id, 'project_category', 'name');
		$item_padding = pearl_get_image_proportion($sizes[$image_key]);
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  class="stm_projects_card stm_projects_card_<?php echo esc_attr($classes[$image_key]); ?>">
			<div class="stm_projects_cards__image stm_lazyload_image"
				 style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;">
				<?php echo pearl_lazyload_image($id, $sizes[$image_key]); ?>
			</div>
			<div class="stm_projects_cards__info">
				<?php if (!empty($terms)): ?>
					<div class="stm_projects_cards__tags_wrapper">
						<div class="stm_projects_cards__tags"><?php echo implode(', ', array_slice($terms, 0, 1)); ?></div>
					</div>
				<?php endif; ?>
				<h3 class="stm_projects_cards__title">
					<?php the_title(); ?>
				</h3>
			</div>
		</a>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

	<?php if($total > $number + $offset && empty($is_ajax)): ?>
		</div> <!--Close inner-->
		<div class="text-center stm_mgt_20 stm_mgb_10">
			<a href="#"
			   class="btn btn_primary btn_outline btn_load"
			   data-number="<?php echo intval($number); ?>"
			   data-total="<?php echo intval($total); ?>"
			   data-offset="<?php echo intval($offset + $number); ?>">
				<span><?php esc_html_e('Load more', 'pearl'); ?></span>
			</a>
		<!--</div>--> <!--Will be closed by inner-->
	<?php endif; ?>

<?php endif;