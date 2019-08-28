<?php
if(!empty($atts)) extract($atts);
pearl_add_element_style('projects_carousel');

$classes = 'stm_projects_carousel__item stm_loop__grid stm_loop__grid_3 ';
$img_size = (!empty($img_size)) ? sanitize_text_field($img_size) : '350x243';

if(!empty($class)) $classes .= esc_attr($class);
?>

<a href="<?php the_permalink(); ?>"
    <?php post_class( $classes ); ?>
   target="_self"
   title="<?php the_title(); ?>">


    <?php
        if(!function_exists('pearl_get_VC_img')) {
            the_post_thumbnail('pearl-img-1110-630');
        } else {
            $img_id = get_post_thumbnail_id(get_the_ID());
            $image = pearl_get_VC_img($img_id, $img_size);
            echo html_entity_decode($image);
        }
    ?>

    <span class="stm_projects_carousel__overlay"></span>
    <h4 class="stm_projects_carousel__name no_line">
        <?php the_title(); ?>
    </h4>
    <span class="btn btn_primary btn_solid btn_xs stm_projects_carousel__btn">
        <?php esc_html_e('View more', 'pearl'); ?>
    </span>
</a>