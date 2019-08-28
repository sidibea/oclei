<?php

pearl_add_element_style('posts_list', $style);
$img_size = !empty($img_size) ? $img_size : '510x330';


$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
if(empty($post_views)) {
    $post_views = 0;
}
$video_label = esc_html('Video', 'pearl');
if ($video_duration = get_post_meta(get_the_ID(), 'single_post_video_duration', true)) {
	if ($video_duration && $video_duration !== 0) {
		$video_duration = new DateInterval($video_duration);
		if ($video_duration->format('%H') > 0) {
			$video_label = $video_duration->format('%H:%I:%S');
		} else {
			$video_label = $video_duration->format('%I:%S');
		}
	}
}
?>

<div <?php post_class('stm_posts_list_single'); ?>>
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image) and has_post_thumbnail() ): 
			$image_url = pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large', true);
			?>

			<div class="stm_posts_list_single__image" style="background-image: url(<?php echo esc_url($image_url); ?>)">
				<a href="<?php the_permalink(); ?>"
				   title="<?php the_title() ?>" class="no_deco">
				</a>
                <div class="video_label mbc_b">
                    <?php echo wp_kses_post($video_label); ?>
                </div>
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

            <div class="stm_posts_list_single__info">
                <div class="categories info__item">
					<?php
					$categories = wp_get_post_categories(get_the_ID(), array('fields' => 'all'));

					foreach ($categories as $category) {
						?>
                        <div class="category info__item">
							<?php echo wp_kses_post($category->name); ?>
                        </div>
						<?php
					} ?>
                </div>

				<?php if (!empty($show_date)): ?>
                    <div class="date info__item">
						<?php
						$posted = get_the_time('U');
						echo human_time_diff($posted, current_time( 'U' )) . ' ago';
						?>
                    </div>
				<?php endif; ?>

				<?php if (!empty($show_comments)): ?>
                    <div class="comments info__item">
                        <i class="stmicon-magazine-comment"></i>
                        <span>
                            <?php echo comments_number(0, 1, '%'); ?>
                        </span>
                    </div>
				<?php endif; ?>

				<?php if (!empty($show_views)): ?>
                    <div class="views info__item">
                        <span class="stmicon-magazine-view"></span>
						<?php echo intval($post_views); ?>
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