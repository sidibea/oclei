<?php
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
if(empty($post_views)) {
    $post_views = 0;
}

$bg_image = '';
if(has_post_thumbnail()) {
    wp_enqueue_script('parallax');
    $bg_image = pearl_get_VC_post_img_safe(get_the_id(), '1920x940', 'large', true);
    if(!empty($bg_image)) {
        $bg_image = 'style="background-image: url(\'' . $bg_image . '\')"';
    }
}

$badge = pearl_get_post_popular_badge(get_the_ID());

$likes = get_post_meta(get_the_ID(), 'pearl_likes', true);
$dislikes = get_post_meta(get_the_ID(), 'pearl_dislikes', true);
if (empty($likes)) {
    $likes = 0;
}
if (empty($dislikes)) {
    $dislikes = 0;
}
?>

<div class="tbc post_thumbnail_box vc_container-fluid-force" <?php echo $bg_image; ?>>
    <?php get_template_part("{$parts}/prev_next_posts_4"); ?>
</div>
<div class="stm_single_post_content_wrap">
    <?php if (!empty($category = get_the_category())): ?>
        <div class="post-category text-uppercase">
            <?php foreach($category as $single_category): ?>
                <a class="no_deco sbc" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                    <?php echo esc_attr($single_category->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (pearl_check_string(pearl_get_option('post_title'))): ?>
        <h1 class="post-title mtc_a"><?php the_title(); ?></h1>
    <?php endif; ?>

    <div class="post_info">
        <?php if (pearl_check_string(pearl_get_option('post_author'))) {
            $author_name = apply_filters('author_name_19_post_layout', get_the_author_meta('display_name'));
            $author_avatar = apply_filters('author_avatar_19_post_layout', get_avatar(get_the_author_meta('email'), 174));
            ?>
            <div class="stm_author_post clearfix">

                <?php if(!empty($badge)):
                    $badge_class = array(
                        $badge['class'],
                        'no_deco stm_posts_list_single__icon_box'
                    );

                    ?>
                    <div class="stm_author_post__avatar">
                        <a href="<?php echo esc_attr($badge['url']); ?>" class="<?php echo esc_attr(implode(' ', $badge_class)); ?>">
                            <span class="stmicon-viral_<?php echo esc_attr($badge['class']); ?>"></span>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="stm_author_post__info">
                    <div class="stm_author_post__name">
                        <?php esc_html_e('by:', 'pearl'); ?>
                        <span><?php echo esc_html($author_name); ?></span>
                    </div>
                    <div class="date">
                        <?php
                        $posted = get_the_time('U');
                        echo human_time_diff($posted, current_time( 'U' )) . ' ago';
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="views">
            <span class="stmicon-viral_eye stm_posts_single__icon"></span>
            <?php echo esc_attr($post_views); ?>
        </div>
        <div class="shared">
            <div class="sharethis-inline-share-buttons"></div>
        </div>
        <div class="comments">
            <span class="stmicon-viral_comments stm_posts_single__icon"></span> <?php echo comments_number(); ?>
        </div>
        <div class="sharethis-inline-share-buttons sharethis-inline-share-buttons-small"></div>
    </div>

    <?php if(get_the_excerpt()): ?>
        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>
    <?php endif; ?>
</div>
<div class="stm_mgb_20 stm_single_post__content">
    <?php the_content(); ?>
</div>
<div class="stm_single_post_content_wrap">
    <?php pearl_wp_link_pages(); ?>

    <?php if(!empty($tags = get_the_tags())): ?>
        <div class="post_tags">
            <?php foreach($tags as $tag): ?>
                <a href="<?php echo esc_url(get_tag_link($tag)) ?>"
                   title="<?php echo $tag->name; ?>"
                   class="post_tag mbc_a">
                    <?php echo $tag->name; ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div id="likeDislike" data-post="<?php echo get_the_ID(); ?>">
        <div class="likeDislike_title"><?php esc_html_e('React', 'pearl'); ?></div>
        <button class="like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="likes"><?php echo wp_kses_post($likes); ?></span></button>
        <button class="dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <span class="dislikes"><?php echo wp_kses_post($dislikes); ?></span></button>
    </div>

    <div class="sharethis-inline-share-buttons sharethis-inline-share-buttons_bottom"></div>

    <?php
        if (pearl_check_string(pearl_get_option('post_author'))) {
            get_template_part("{$path}/_author");
        }
    ?>
</div>

<?php wp_enqueue_script('pearl_post_carousel/like_dislike'); ?>