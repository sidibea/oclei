<?php
$per_row = (empty($per_row)) ? 3 : $per_row;
$img_size = (empty($img_size)) ? '' : $img_size;

$classes = array(
    'stm_loop__single stm_loop__grid stm_loop__single_style2 no_deco stm_loop__grid_' . $per_row
);



?>


<a href="<?php the_permalink(); ?>"
    <?php post_class(implode(' ', $classes)); ?>
   title="<?php the_title(); ?>">

    <?php if(has_post_thumbnail()):
        $icon = get_post_meta(get_the_ID(), 'service_icon', true);
        $icon = (empty($icon)) ? 'stmicon-service' : $icon;
        ?>
        <div class="stm_services__image">
            <i class="<?php echo esc_attr($icon); ?>"></i>
            <?php if(!empty($img_size)): ?>
                <?php echo html_entity_decode(pearl_get_VC_img(get_post_thumbnail_id(), $img_size)); ?>
            <?php else: ?>
                <?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_15 img-responsive')); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="stm_services__title text-uppercase tbc stm_animated">
        <span class="h6 wtc"><?php the_title(); ?></span>
    </div>

</a>