<?php
$id = get_the_ID();
$product_tab_content_4_1 = get_post_meta($id, 'product_tab_content_4_1', true);
?>

<?php if (!empty($product_tab_content_4_1)): ?>
    <div class="mobile_tab">
        <a href="#products__tab_4" data-toggle="tab" class="mobile_tab"><span><?php esc_html_e('Trim Products', 'pearl'); ?></span></a>
    </div>
    <div class="tab-pane" id="products__tab_4">
        <?php
        $post_type = 'stm_products';

        $args = array(
            'post_type'      => $post_type,
            'posts_per_page' => 8,
        );

        $q = new WP_Query($args);
        if ($q->have_posts()): ?>

            <ul class="products_trim_list">
                <?php while ($q->have_posts()): $q->the_post(); ?>
                    <?php
                        $product_id1 = get_post_meta($id, 'product_id1', true);
                        $product_id2 = get_post_meta($id, 'product_id2', true);
                        $product_id3 = get_post_meta($id, 'product_id3', true);
                        $product_id4 = get_post_meta($id, 'product_id4', true);
                        $product_id5 = get_post_meta($id, 'product_id5', true);
                    ?>
                    <?php if (!empty($product_id1) || !empty($product_id2) || !empty($product_id3) || !empty($product_id4) || !empty($product_id5) and has_post_thumbnail() ): ?>
                    <li>
                        <div>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php if (has_post_thumbnail()) { ?>
                                    <span class="product_thumbnail"><?php the_post_thumbnail('pearl-img-450-450', array('class' => 'img-responsive')); ?></span>
                                <?php } ?>
                            </a>
                        </div>
                        <div>
                            <?php echo esc_attr($product_id1); ?>
                        </div>
                        <div>
                            <?php echo esc_attr($product_id2); ?>
                        </div>
                        <div>
                            <?php echo esc_attr($product_id3); ?>
                        </div>
                        <div>
                            <?php echo esc_attr($product_id4); ?>
                        </div>
                        <div>
                            <?php echo esc_attr($product_id5); ?>
                        </div>
                    </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
<?php endif; ?>