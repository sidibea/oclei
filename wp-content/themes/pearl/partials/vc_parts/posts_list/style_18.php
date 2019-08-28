<?php
//Psycho
$id = get_the_ID();
pearl_add_element_style('posts_list', $style);
$img_size = !empty($img_size) ? $img_size : '320x180';

$post_views = get_post_meta($id, 'stm_post_views', true);
if (empty($post_views)) {
	$post_views = 0;
}
?>

<div class="stm_posts_list_single col-<?php echo intval($cols); ?>">
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image) and has_post_thumbnail()): ?>

			<div class="stm_posts_list_single__image">
				<a href="<?php the_permalink(); ?>"
				   title="<?php the_title() ?>" class="no_deco">
					<?php echo pearl_get_VC_post_img_safe($id, $img_size, 'large'); ?>
				</a>
			</div>

		<?php endif; ?>
		<div class="stm_posts_list_single__body <?php if (has_post_thumbnail()): ?>has_single__image<?php endif; ?>">

			<?php $categories = wp_get_post_categories(get_the_ID(), array('fields' => 'all')); ?>

			<?php if (!empty($categories)) : ?>
				<div class="category">
					<a class="mtc_h mbc_b no_deco" href="<?php echo esc_attr(get_category_link($categories[0]->term_id)); ?>">
						<?php echo wp_kses_post($categories[0]->name); ?>
					</a>
				</div>
			<?php endif; ?>

			<?php if (!empty($show_title)): ?>
				<div class="title">
					<h3>
						<a href="<?php the_permalink(); ?>"
						   title="<?php the_title() ?>" class="no_deco">
							<?php the_title() ?>
						</a>
					</h3>
				</div>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
				<div class="stm_posts_list_single__excerpt">
					<?php echo get_the_excerpt(); ?>
				</div>
			<?php endif; ?>


			<div class="footer">
				<?php if (!empty($show_date)): ?>
					<div class="date">
						<i class="stmicon-psychologist_calendar"></i>
						<span><?php the_date(); ?></span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>