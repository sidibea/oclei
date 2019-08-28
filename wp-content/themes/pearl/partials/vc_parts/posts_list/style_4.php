<?php
pearl_add_element_style('posts_list', $style);
$comments = get_comment_count();
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
				<div class="stm_posts_list_single__title">
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title() ?>" class="no_deco ttc mtc_h">
						<?php the_title() ?>
					</a>
				</div>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
				<div class="stm_posts_list_single__excerpt">
					<?php the_excerpt() ?>
				</div>
			<?php endif; ?>

			<div class="stm_posts_list_single__info">

				<?php if (!empty($show_date)): ?>
					<div class="date mtc">
						<i class="stmicon-charity_calendar stc"></i>
						<?php echo get_the_date('F j, Y') ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($show_comments)):

					?>
					<div class="comments">
						<i class="stmicon-comment2 stc"></i>
						<?php echo intval($comments['approved']) ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>