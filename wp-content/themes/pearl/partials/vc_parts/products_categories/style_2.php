<ul class="inner stm_products_<?php echo $per_row ?>_columns">
    <?php
        $taxonomy = 'products_category';
        $terms = get_terms( array( 'taxonomy' => $taxonomy, 'parent' => 0,  'number' => $number ) );
    ?>

    <?php foreach ( $terms as $term ) { ?>
        <?php
            $term_id = $term->term_id;
            $image_id = get_term_meta($term_id, 'pearl_products_category_image', true);
        ?>
        <li>
            <a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">
                <?php echo pearl_get_VC_attachment_img_safe($image_id, $image_size); ?>
                <span class="product_cat_info">
                    <span class="product_cat_title"><?php echo $term->name; ?></span>
                    <span class="product_cat_description"><?php echo $term->description; ?></span>
                </span>
            </a>
        </li>
    <?php } ?>

</ul>