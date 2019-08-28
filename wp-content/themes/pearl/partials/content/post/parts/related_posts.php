<?php

$wrapper_classes = array('stm_post__related_posts stm_contrast');

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'post__not_in'   => array(get_the_ID()),
	'orderby'        => 'rand',
	'ignore_sticky_posts' => true
);

$q = new WP_Query($args);

if ($q->have_posts()) : ?>
	<div class="vc_container-fluid-force stm_post__related_post_container">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $wrapper_classes)); ?>">
				<div class="related_posts__title h1">
					<?php echo esc_html('Related posts', 'pearl'); ?>
				</div>
				<div class="stm_post__separator mbdc_a mbdc_b">
					<i class="stmicon-bon_appetit_diamond mtc"></i>
				</div>
				<?php while ($q->have_posts()) : $q->the_post(); ?>
					<div class="stm_post__related_post">
						<a href="<?php the_permalink() ?>" class="related_post__image">
							<?php echo wp_kses_post(pearl_get_VC_post_img_safe(get_the_ID(), '250x140')) ?>
						</a>
						<a href="<?php the_permalink() ?>" class="related_post__title mtc_h">
							<?php the_title(); ?>
						</a>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>

	<?php
	wp_reset_postdata();
endif;
