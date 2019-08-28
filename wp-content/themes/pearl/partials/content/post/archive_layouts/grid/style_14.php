<?php $img_size = '445x340'; ?>

<div class="stm_posts_list_single animated fadeIn">
    <div class="stm_posts_list_single__container">

        <div class="stm_posts_list_single__image">
            <a href="<?php the_permalink(); ?>"
               title="<?php the_title() ?>" class="no_deco">
				<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
            </a>
        </div>

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

            <h2 class="mbc_a">
                <a href="<?php the_permalink(); ?>"
                   title="<?php the_title() ?>" class="no_deco ttc mtc_h">
					<?php the_title() ?>
                </a>
            </h2>

            <div class="stm_posts_list_single__excerpt">
				<?php the_excerpt(); ?>
            </div>


            <div class="stm_posts_list_single__info mbdc">

                <div class="date">
					<?php echo get_the_date('F j, Y') ?>
                </div>

                <div class="post_link">
                    <a href="<?php the_permalink(); ?>" class="ttc tbc_a">
						<?php esc_html_e('View the Post', 'pearl'); ?>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>