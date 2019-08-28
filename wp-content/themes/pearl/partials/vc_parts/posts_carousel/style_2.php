<?php
$classes = array();
$offset = 0;
$unique_id = uniqid();
$classes[] = 'stm_posts_carousel stm_posts_carousel_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $unique_id;
pearl_add_element_style('posts_carousel', $style);
wp_enqueue_script('pearl_post_carousel/style_2');
$img_size = !empty($img_size) ? $img_size : '1110x600';

$args = array(
	'post_type'           => 'post',
	'posts_per_page'      => 4,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'tax_query' => array()
);

if ($order === 'custom') {
	if (!empty($include)) {
		$include = explode(',', $include);
		$args['post__in'] = $include;
	}
} else {
	$args['orderby'] = $order;
}

if (!empty($post_format) and $post_format !== 'all') {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => $post_format,
		)
	);
}

if (is_single()) {
    $args['post__not_in'] = array(get_the_ID());
}

$current_id = get_the_ID();

$q = new WP_Query($args);

if ($q->have_posts()): ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <?php $i = 0; while ($q->have_posts()): $q->the_post(); $i++; ?>

            <?php
            $post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
            if(empty($post_views)) {
                $post_views = 0;
            }

            $active_class = ($i === 1) ? 'active' : '';
            ?>

            <div class="stm_posts_carousel_single <?php echo esc_attr($active_class); ?>">
                <div class="stm_posts_carousel_single__container">
                    <?php if (has_post_thumbnail() ): ?>

                        <div class="stm_posts_carousel_single__image">
                            <?php $badge = pearl_get_post_popular_badge(get_the_ID());
                                if(!empty($badge)):
                                $badge_class = array(
                                    $badge['class'],
                                    'no_deco stm_posts_list_single__icon_box'
                                );

                                ?>
                                <a href="<?php echo esc_attr($badge['url']); ?>" class="<?php echo esc_attr(implode(' ', $badge_class)); ?>">
                                    <span class="stmicon-viral_<?php echo esc_attr($badge['class']); ?>"></span>
                                </a>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>"
                               title="<?php the_title() ?>" class="no_deco">
                                <?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
                            </a>
                        </div>

                    <?php endif; ?>
                    <div class="stm_posts_carousel_single__body">

                        <?php if (!empty($category = get_the_category())): ?>
                            <div class="stm_posts_carousel_single__category">
                                <?php foreach($category as $single_category): ?>
                                    <a class="no_deco" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                                        <?php echo esc_attr($single_category->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($show_title)): ?>
                            <h5>
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php the_title() ?>" class="no_deco">
                                    <?php the_title() ?>
                                </a>
                            </h5>
                        <?php endif; ?>

                        <?php if (!empty($show_excerpt)): ?>
                            <div class="stm_posts_carousel_single__excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="stm_posts_carousel_single__info">
                            <?php
                                $author_name = get_the_author_meta('display_name');
                            ?>

                            <div class="stm_posts_carousel_single__avatar">
                                <div class="author_avatar"><?php echo get_avatar( get_the_author_meta( 'email' ), 54 ); ?></div>
                                <div class="author_info">
                                    <?php esc_html_e( 'by', 'pearl' ); ?> <span class="name"><?php echo esc_html($author_name); ?></span>
                                    <?php if (!empty($show_date)): ?>
                                        <div class="date">
                                            <?php
                                            $posted = get_the_time('U');
                                            echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if (!empty($show_views)): ?>
                                <div class="views">
                                    <span class="stmicon-viral_eye stm_posts_carousel_single__icon"></span>
                                    <?php echo esc_attr($post_views); ?>
                                    <?php if($post_views == 1) : ?>
                                        <?php esc_html_e('view', 'pearl'); ?>
                                    <?php else: ?>
                                        <?php esc_html_e('views', 'pearl'); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($show_comments)): ?>
                                <div class="comments">
                                    <span class="stmicon-viral_comments stm_posts_carousel_single__icon"></span> <?php echo comments_number(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <ol class="stm_posts_carousel_single__list">
            <?php $i = 0; while ($q->have_posts()): $q->the_post(); $i++; ?>
                <?php
                $post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
                if(empty($post_views)) {
                    $post_views = 0;
                }

                $active_class = ($i === 1) ? 'active' : '';
                ?>

                <li class="<?php echo esc_attr($active_class); ?>">
                    <h5><?php the_title() ?></h5>
                    <div class="stm_posts_carousel_single__info">
                        <?php if (!empty($show_date)): ?>
                            <div class="date">
                                <?php
                                $posted = get_the_time('U');
                                echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($show_views)): ?>
                            <div class="views">
                                <?php echo esc_attr($post_views); ?>
                                <?php if($post_views == 1) : ?>
                                    <?php esc_html_e('view', 'pearl'); ?>
                                <?php else: ?>
                                    <?php esc_html_e('views', 'pearl'); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ol>
    </div>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>