<?php
//Magazine
pearl_add_element_style('posts_list', $style);
$img_size = !empty($img_size) ? $img_size : '100x100';

$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
if (empty($post_views)) {
	$post_views = 0;
}
?>

<div class="stm_posts_list_single">
    <div class="stm_posts_list_single__container">
		<?php if (!empty($show_image) and has_post_thumbnail()): ?>

            <div class="stm_posts_list_single__image">
                <a href="<?php the_permalink(); ?>"
                   title="<?php the_title() ?>" class="no_deco">
					<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
                </a>
            </div>

		<?php endif; ?>
        <div class="stm_posts_list_single__body <?php if (has_post_thumbnail()): ?>has_single__image<?php endif; ?>">

			<?php if (!empty($show_title)): ?>
                <h3>
                    <a href="<?php the_permalink(); ?>"
                       title="<?php the_title() ?>" class="no_deco">
						<?php the_title() ?>
                    </a>
                </h3>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
                <div class="stm_posts_list_single__excerpt">
					<?php the_excerpt(); ?>
                </div>
			<?php endif; ?>

            <div class="stm_posts_list_single__info">

                <div class="post_categories info__item">
					<?php
					$categories = wp_get_post_categories(get_the_ID(), array('fields' => 'all'));
					foreach ($categories as $category) : ?>
                        <a class="ttc ttc_h" href="<?php echo esc_attr(get_category_link($category->term_id)); ?>">
                            <div class="post_category">
								<?php echo wp_kses_post($category->name); ?>
                            </div>
                        </a>
					<?php endforeach; ?>
                </div>

				<?php if (!empty($show_date)): ?>
                    <div class="date info__item">
                        <span class="stmicon-magazine-calendar"></span>
						<?php
						$posted = get_the_time('U');
						echo human_time_diff($posted, current_time('U')) . ' ago';
						?>
                    </div>
				<?php endif; ?>

				<?php if (!empty($show_comments)): ?>
                    <div class="comments_count info__item">
                        <i class="stmicon-magazine-comment"></i>
						<?php echo comments_number(0, 1, '%'); ?>
                    </div>
				<?php endif; ?>

				<?php if (!empty($show_views)): ?>
                    <div class="views_count info__item">
                        <i class="stmicon-magazine-view"></i>
						<?php echo intval($post_views); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>