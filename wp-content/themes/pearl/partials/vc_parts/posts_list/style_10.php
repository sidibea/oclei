<?php

pearl_add_element_style('posts_list', $style);
$img_size = !empty($img_size) ? $img_size : '350x185';

$icon_size = (!empty($icon_size)) ? $icon_size : '24x24';
$icon = (!empty($icon)) ? pearl_get_VC_img($icon, $icon_size) : '';

$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
if(empty($post_views)) {
    $post_views = 0;
}
$badge = pearl_get_post_popular_badge(get_the_ID());
?>

<div class="stm_posts_list_single">
	<div class="stm_posts_list_single__container">
		<?php if (!empty($show_image) and has_post_thumbnail() ): ?>
			<div class="stm_posts_list_single__image">

                <?php if (!empty($category = get_the_category())): ?>
                    <div class="stm_posts_list_single__category">
                        <?php foreach($category as $single_category): ?>
                            <a class="no_deco" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                                <?php echo esc_attr($single_category->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if(!empty($badge)):
                    $badge_class = array(
                        $badge['class'],
                        'no_deco stm_posts_list_single__icon_box'
                    );

                    ?>
                    <a href="<?php echo esc_attr($badge['url']); ?>" class="<?php echo esc_attr(implode(' ', $badge_class)); ?>">
                        <span class="stmicon-viral_<?php echo esc_attr($badge['class']); ?>"></span>
                    </a>
                <?php endif; ?>

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