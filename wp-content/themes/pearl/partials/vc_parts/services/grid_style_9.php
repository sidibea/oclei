<?php
//psycho
$per_row = (empty($per_row)) ? 2 : $per_row;
$img_size = (empty($img_size)) ? '445x350' : $img_size;

$classes = array(
	'stm_loop__grid no_deco col-md-' . 12 / $per_row
);

$icon = get_post_meta(get_the_ID(), 'service_icon', true);

$current = ($current < 10) ? '0' . ($current + 1) : ($current + 1);

?>


<div <?php post_class(implode(' ', $classes)); ?>>
    <a href="<?php the_permalink(); ?>"
       title="<?php the_title(); ?>"
       class="no_line no_deco title wtc">
        <div class="stm_services__content">
            <h2 class="stm_services__title stm_animated mtc">
				<?php echo pearl_minimize_word(get_the_title()); ?>
            </h2>
            <div class="stm_services__excerpt ttc">
                <?php echo pearl_minimize_word(get_the_excerpt(), $excerpt); ?>
            </div>
        </div>
		<?php if (!empty($icon)) : ?>
            <div class="stm_services__icon mbc">
                <i class="<?php echo esc_attr($icon) ?>"></i>
            </div>
		<?php endif; ?>

    </a>
</div>