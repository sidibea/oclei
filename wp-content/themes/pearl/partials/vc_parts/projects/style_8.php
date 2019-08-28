<?php
if(!empty($atts)) extract($atts);
pearl_add_element_style('projects_carousel');

$classes = 'stm_projects_carousel__item stm_loop__grid stm_loop__grid_3 ';
$img_size = (!empty($img_size)) ? sanitize_text_field($img_size) : '350x234';

if(!empty($class)) $classes .= esc_attr($class);

$id = get_the_ID();
if(!empty($post_type)) {
	$taxonomy = pearl_get_post_type_taxonomy($post_type);
	if (!empty($taxonomy)) {
		$terms = pearl_get_terms_array($id, $taxonomy, 'name', true, array('class' => 'mbc ttc no_deco sbc_h wtc_h'));
	}
}
?>

<div <?php post_class( $classes ); ?> >

    <div class="stm_projects_carousel__info">
        <div class="stm_projects__thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
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
            </a>
        </div>

        <div class="stm_projects__meta tbc_b mbc_b_h">
            <div class="inner">
                <?php if(!empty($terms)): ?>
                    <div class="terms">
                        <?php echo implode('', $terms); ?>
                    </div>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="h6 no_deco mtc_h" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            </div>
        </div>
    </div>

</div>