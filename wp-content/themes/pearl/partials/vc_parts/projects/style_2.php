<?php
if (!empty($atts)) extract($atts);
pearl_add_element_style('projects_carousel');

$classes = 'stm_projects_carousel__item stm_loop__grid stm_loop__grid_3 ';
$img_size = (!empty($img_size)) ? sanitize_text_field($img_size) : '350x243';

if (!empty($class)) $classes .= esc_attr($class);

$classes .= ' flippable ';

$terms = pearl_get_terms_array(get_the_ID(), 'project_category', 'name');

$img_id = get_post_thumbnail_id(get_the_ID());
$image_url = pearl_get_image_url($img_id, 'pearl-img-1110-630');
$style = 'style="background-image: url('.$image_url.')"';

$rand = rand(0,1);

$flip_style = $rand ? 'vertical' : 'horizontal';
?>

<a href="<?php the_permalink(); ?>"
	<?php post_class($classes); ?>
   target="_self"
   title="<?php the_title(); ?>">

    <div class="stm_flipbox stm_flipbox__<?php echo esc_attr($flip_style); ?>">
        <div class="stm_flipbox__front tbc_a" <?php echo wp_kses_post($style) ?>>
            <div class="inner_flip">
                <div class="stm_projects__meta tbc_b mbc_b_h">
                    <div class="inner">
                        <h5 class="wtc"><?php the_title(); ?></h5>
                        <span class="stm_projects__meta_terms mtc stm_animated">
                            <?php echo sanitize_text_field(implode(', ', $terms)); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stm_flipbox__back mbc_a" <?php echo wp_kses_post($style) ?>>
            <div class="inner_flip">
                <div class="stm_projects__meta tbc_b mbc_b_h">
                    <div class="inner wtc">
                        <p><?php echo pearl_minimize_word(get_the_excerpt(), 140); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</a>