
<?php
$id = get_the_ID();
$img_id = get_post_thumbnail_id($id);
$image_size = '350x170';
$image = get_the_post_thumbnail(get_the_ID(), $image_size);

if(function_exists('pearl_get_VC_img')) {
    $image = pearl_get_VC_img($img_id, $image_size);
}

if(!empty($taxonomy)) {
    $terms = wp_get_post_terms($id, $taxonomy);
    if (!is_wp_error($terms) and !empty($terms)) {
        $terms = wp_list_pluck($terms, 'name');
    }
}

$format = get_post_format();
$classes = array(
    'stm_post_type_list__single no_deco ic ttc clearfix',
    $format
);

?>
<a href="<?php the_permalink(); ?>"
   class="<?php echo esc_attr(implode(' ', $classes)); ?>"
   title="<?php the_title(); ?>">
    <?php if(!empty($image)): ?>
        <div class="stm_post_type_list__image">
            <?php echo html_entity_decode($image); ?>
        </div>
    <?php endif; ?>
    <div class="stm_post_type_list__content stc_b">
        <h4 class="ttc text-uppercase stm_animated">
            <?php echo pearl_minimize_word(get_the_title()); ?>
        </h4>
        <?php if(!empty($terms)): ?>
            <div class="stm_post_type_list__terms mtc">
                <?php echo esc_attr(implode(', ', $terms)); ?>
            </div>
        <?php endif; ?>
        <div class="stm_post_type_list__excerpt">
            <?php the_excerpt(); ?>
        </div>
    </div>
</a>