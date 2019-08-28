<?php
wp_enqueue_style('animate.css');
wp_enqueue_script('lazysizes');

$id = get_the_ID(); ?>

<div class="stm_posts_list_single animated fadeIn">
    <div <?php post_class('stm_posts_list_single__container') ?>>

		<?php if (!empty($show_image)):
			$item_padding = pearl_get_image_proportion($img_size);
            ?>
            <div class="stm_posts_list_single__image">
                <a href="<?php the_permalink(); ?>"
                   title="<?php the_title() ?>"
                   style="padding-bottom: <?php echo esc_attr($item_padding); ?>%;"
                   class="no_deco stm_lazyload_image">
					<?php echo pearl_lazyload_image($id, $img_size); ?>
                </a>
                <?php if(is_sticky()): ?>
                    <div class="sticky_post mbc wtc"><?php esc_html_e('Sticky post', 'pearl'); ?></div>
                <?php endif; ?>
                <div class="pseudo_element"></div>
            </div>
		<?php endif; ?>

        <div class="stm_posts_list_single__body">

			<?php if (!empty($category = get_the_category())): ?>
                <div class="stm_posts_list_single__category mtc text-transform">
					<?php foreach($category as $single_category): ?>
                        <a class="no_deco" href="<?php echo esc_url(get_term_link($single_category)); ?>">
							<?php echo esc_attr($single_category->name); ?>
                        </a>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>

			<?php if (!empty($show_title)): ?>
                <h2 class="mbc_a">
                    <a href="<?php the_permalink(); ?>"
                       title="<?php the_title() ?>" class="no_deco ttc mtc_h">
						<?php the_title() ?>
                    </a>
                </h2>
			<?php endif; ?>

			<?php if (!empty($show_excerpt)): ?>
                <div class="stm_posts_list_single__excerpt">
					<?php the_excerpt(); ?>
                </div>
			<?php endif; ?>


            <div class="stm_posts_list_single__info mbdc">

				<?php if (!empty($show_date)): ?>
                    <div class="date">
						<?php echo get_the_date('F j, Y') ?>
                    </div>
				<?php endif; ?>

                <div class="post_link">
                    <a href="<?php the_permalink(); ?>" class="ttc tbc_a">
						<?php esc_html_e('View the Post', 'pearl'); ?>
                    </a>
                </div>

            </div>

			<?php if (!empty($show_comments)): ?>
                <div class="comments">
                    <?php echo comments_number(); ?>
                </div>
			<?php endif; ?>

        </div>
    </div>
</div>