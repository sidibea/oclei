<?php

pearl_add_element_style('posts_list', $style);
$img_size = !empty($img_size) ? $img_size : '100x100';

$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
if(empty($post_views)) {
    $post_views = 0;
}
?>

<div class="stm_posts_list_single">
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image) and has_post_thumbnail() ): ?>

			<div class="stm_posts_list_single__image">
				<a href="<?php the_permalink(); ?>"
				   title="<?php the_title() ?>" class="no_deco">
					<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
				</a>
			</div>

		<?php endif; ?>
		<div class="stm_posts_list_single__body <?php if ( has_post_thumbnail() ): ?>has_single__image<?php endif; ?>">

			<?php if (!empty($show_title)): ?>
				<h5>
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title() ?>" class="no_deco">
						<?php the_title() ?>
					</a>
				</h5>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
				<div class="stm_posts_list_single__excerpt">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>

			<div class="stm_posts_list_single__info">

				<?php if (!empty($show_date)): ?>
					<div class="date">
                        <?php
                            $posted = get_the_time('U');
                            echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                        ?>
					</div>
				<?php endif; ?>

                <?php if (!empty($show_views)): ?>
                    <div class="views">
                        <?php echo esc_attr($post_views); ?>
                        <?php if($post_views == 1) : ?>
                            <?php esc_html_e('view', 'pearl'); ?>
                        <?php else: ?>
                            <?php esc_html_e('views', 'pearl'); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

				<?php if (!empty($show_comments)): ?>
					<div class="comments">
						<?php echo comments_number(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>