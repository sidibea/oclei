<?php
pearl_add_element_style('posts_list', $style);
?>

<div class="stm_posts_list_single">
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image)): ?>
			<div class="stm_posts_list_single__image">
				<a href="<?php the_permalink(); ?>"
				   title="<?php the_title() ?>" class="no_deco">
					<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
				</a>
			</div>
		<?php endif; ?>
		<div class="stm_posts_list_single__body">

			<?php if (!empty($show_title)): ?>
				<h5>
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title() ?>" class="no_deco ttc mtc_h">
						<?php the_title() ?>
					</a>
				</h5>
			<?php endif; ?>
			<div class="stm_posts_list_single__info mbdc">

				<?php if (!empty($show_date)): ?>
					<div class="date">
						<span>
						<?php echo get_the_date('F j, Y') ?>
						</span>
					</div>
				<?php endif; ?>

				<?php if (!empty($show_comments)): ?>
					<div class="comments">
						<span>
						<?php echo comments_number(); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>

			<?php if (!empty($show_excerpt)): ?>
				<div class="stm_posts_list_single__excerpt">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>


		</div>
	</div>
</div>