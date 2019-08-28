<?php
$per_row = (empty($per_row)) ? 3 : $per_row;
$img_size = (empty($img_size)) ? '' : $img_size;

$classes = array(
    'stm_loop__grid no_deco col-md-' . 12 / $per_row
);

$icon = get_post_meta(get_the_ID(), 'service_icon', true);

$bg_colors = array('mbc', 'sbc', 'tbc');
$bg_colors = $bg_colors[rand(0,2)];

$bg_colors_h = 'tbc_h';
if($bg_colors === 'tbc') $bg_colors_h = 'mbc_h';
?>


<div <?php post_class(implode(' ', $classes)); ?>>
    <a href="<?php the_permalink(); ?>"
       title="<?php the_title(); ?>"
       class="no_line no_deco title wtc <?php echo esc_attr($bg_colors . ' ' . $bg_colors_h); ?>">

        <?php if (!empty($icon)) : ?>
            <div class="stm_services__icon">
                <i class="<?php echo esc_attr($icon) ?>"></i>
            </div>
        <?php endif; ?>

        <div class="stm_services__content">
            <h5 class="stm_services__title stm_animated wtc">
                <?php the_title(); ?>
            </h5>

            <div class="excerpt">
                <?php echo pearl_minimize_word(get_the_excerpt(), $excerpt); ?>
            </div>
        </div>

    </a>
</div>