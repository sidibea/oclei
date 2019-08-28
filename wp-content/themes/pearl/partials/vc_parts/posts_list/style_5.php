<?php
pearl_add_element_style('posts_list', $style);
?>

<div class="stm_posts_list_single">
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image)): ?>
			<div class="stm_posts_list_single__image">
				<div class="image_deco"></div>
				<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>

				<a href="<?php the_permalink(); ?>"
				   title="<?php the_title() ?>" class="no_deco">
				</a>
			</div>
		<?php endif; ?>
		<div class="stm_posts_list_single__body">

			<?php if (!empty($show_title)): ?>
				<h5>
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title() ?>" class="no_deco mtc ttc_h">
						<?php the_title() ?>
					</a>
				</h5>
			<?php endif; ?>
			<div class="stm_posts_list_single__info mbdc">

				<?php if (!empty($show_date)): ?>
					<div class="date">
						<i class="stmicon-bon-clock stc"></i>
						<span>
						<?php echo get_the_date('F j, Y') ?>
						</span>
					</div>
				<?php endif; ?>

				<?php if (!empty($show_comments)): ?>
					<div class="comments">
						<i class="stmicon-bon-phrase stc"></i>
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

			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="stm_posts_list_single__read_more btn btn_solid btn_primary">
				<?php echo esc_html('Read more', 'pearl'); ?>
			</a>


		</div>
	</div>
	<div class="stm_posts_list_single__sep mbdc mtc">
		<i class="stmicon-bon_appetit_diamond"></i>
	</div>
</div>