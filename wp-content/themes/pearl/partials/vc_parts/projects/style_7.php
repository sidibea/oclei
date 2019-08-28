<?php
if(!empty($atts)) extract($atts);
pearl_add_element_style('projects_carousel');

$classes = 'stm_projects_carousel__item stm_loop__grid stm_loop__grid_3 ';
$img_size = (!empty($img_size)) ? sanitize_text_field($img_size) : '350x243';

if(!empty($class)) $classes .= esc_attr($class);

$id = get_the_ID();

$prices = get_post_meta($id, 'service_rental_prices', true);
$badge = get_post_meta($id, 'service_rental_badge', true);

?>

<div <?php post_class( $classes ); ?> >

    <div class="stm_projects_carousel__info">
        <div class="stm_projects__thumbnail">
            <?php
                if(!function_exists('pearl_get_VC_img')) {
                    the_post_thumbnail('pearl-img-1110-630');
                } else {
                    $img_id = get_post_thumbnail_id(get_the_ID());
                    $image = pearl_get_VC_img($img_id, $img_size);
                    $full_image = pearl_get_image_url($img_id);
                    echo html_entity_decode($image);
                }
            ?>
        </div>

        <div class="stm_projects__links">
            <a href="<?php echo esc_url($full_image); ?>" class="item_thumbnail_popup stm_lightgallery__selector"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
            <a href="<?php the_permalink(); ?>" class="item_link"><i class="fa fa-eye" aria-hidden="true"></i></a>
        </div>

        <div class="stm_projects__meta tbc_b mbc_b_h">
            <div class="inner">
                <h6 class="wtc"><?php the_title(); ?></h6>
                <?php if(!empty($prices)): ?>
                    <ul class="stm_projects__prices">
                    <?php foreach($prices as $value) : ?>
                        <?php if(!empty($value['label']) and !empty($value['name']) and !empty($badge)): ?>
                            <li><?php echo sanitize_text_field($badge); ?> <?php echo sanitize_text_field($value['label']); ?> <?php echo sanitize_text_field($value['name']); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>