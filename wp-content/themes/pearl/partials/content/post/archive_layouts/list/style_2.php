<div id="post-<?php the_ID(); ?>"
	<?php post_class('stm_loop__single stm_loop__single_list_style_2 stm_loop__list no_deco'); ?>>

	<div class="stm_loop__container">

		<a href="<?php the_permalink() ?>" class="stm_loop__post_image">
			<div class="stm_single-date stm_loop__date mbc">
				<span class="day"><?php echo get_the_date('d'); ?></span>
				<span class="month"><?php echo get_the_date('M'); ?></span>
			</div>
			<?php
			if (function_exists('pearl_get_VC_img')) {
				echo pearl_get_VC_img(get_post_thumbnail_id(), '350x220');
			} else {
				the_post_thumbnail('medium', array('class' => 'stm_mgb_28 img-responsive'));
			};
			?>
		</a>

		<div class="stm_loop__content">
			<a href="<?php the_permalink() ?>"
			   class="h5 no_deco no_line mtc_h stm_mgb_31 stm_dpb stm_lh_24"
			   title="<?php the_title(); ?>">
				<span><?php the_title(); ?></span>
			</a>
			<div class="stm_post_details">
				<?php _e('Category: ', 'pearl') ?>
				<?php echo pearl_minimize_word(implode(', ', wp_get_post_categories(get_the_ID(), array('fields' => 'names'))), 36); ?>
			</div>
			<div class="post_excerpt stm_mgb_34">
				<?php echo pearl_minimize_word(get_the_excerpt(), 180); ?>
			</div>
		</div>
	</div>
</div>