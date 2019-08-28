<div <?php post_class('stm_loop__single_list_style_4 no_deco'); ?>>

	<div class="stm_loop__container stm_flex_row stm_flex">

		<div class="stm_single__date stm_loop__date mbc stm_flex stm_flex_col">
			<span class="day"><?php echo get_the_date('d'); ?></span>
			<span class="month"><?php echo get_the_date('M'); ?></span>
			<span class="year"><?php echo get_the_date('Y'); ?></span>
		</div>


		<div class="stm_flex stm_flex_col stm_single__content">
			<div class="stm_single__image">
				<?php
				if (function_exists('pearl_get_VC_img')) {
					echo pearl_get_VC_img(get_post_thumbnail_id(), '800x370');
				} else {
					the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_28 img-responsive'));
				};

				?>
			</div>
			<div class="stm_single__meta stm_loop__meta">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<h5 class="no_line mtc_h fwn stm_animated"><?php the_title(); ?></h5>
				</a>
				<p class="stm_single__excerpt stm_loop_excerpt ttc">
					<?php echo get_the_excerpt() ?>
				</p>

				<ul class="stm_single__post-details list-unstyled">
					<li class="tags">
						<?php the_tags() ?>
					</li>
					<li class="comments">
						<?php echo esc_html__('Comments: ', 'pearl') . ' ' . get_comments_number() ?>
					</li>
					<li class="author">
						<?php echo esc_html__('Posted by: ', 'pearl') . ' ' .get_the_author()  ?>
					</li>
				</ul>


				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="btn btn_solid mbc tbc_h">
            <?php esc_html_e('Read more', 'pearl'); ?>
        		</a>

			</div>
		</div>
	</div>
</div>