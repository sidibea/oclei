<?php
$per_row = (empty($per_row)) ? 3 : $per_row;
$img_size = (empty($img_size)) ? '' : $img_size;

$classes = array(
	'stm_loop__grid no_deco col-md-' . 12 / $per_row
);

$icon = get_post_meta(get_the_ID(), 'service_icon', true);

?>


<div <?php post_class(implode(' ', $classes)); ?>>
	<div class="stm_services__container">

		<?php if (!empty($icon)) : ?>
			<div class="stm_services__icon">
				<i class="mtc_b <?php echo esc_attr($icon) ?>"></i>
			</div>
		<?php endif; ?>




		<div class="stm_services__content">
			<div class="stm_services__title stm_animated">
				<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"
				   class="h5 no_line title"><?php the_title(); ?></a>

			</div>

			<div class="excerpt">
				<?php echo pearl_minimize_word(get_the_excerpt(), $excerpt); ?>
			</div>
		</div>
	</div>
</div>