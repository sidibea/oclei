<?php
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
if(empty($post_views)) {
    $post_views = 0;
}

$badge = pearl_get_post_popular_badge(get_the_ID());
?>

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

<?php if(get_the_excerpt()): ?>
    <div class="post-excerpt">
        <?php the_excerpt(); ?>
    </div>
<?php endif; ?>

<div class="post_info">
    <?php if (pearl_check_string(pearl_get_option('post_author'))) {
        $author_name = apply_filters('author_name_17_post_layout', get_the_author_meta('display_name'));
        $author_avatar = apply_filters('author_avatar_17_post_layout', get_avatar(get_the_author_meta('email'), 174));
        ?>
        <div class="stm_author_post clearfix">
            <div class="stm_author_post__avatar">
                <?php echo $author_avatar; ?>
            </div>
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
    <?php if(!empty($badge)):
        $badge_class = array(
            $badge['class'],
            'no_deco stm_posts_list_single__icon_box'
        );

        ?>
        <a href="<?php echo esc_attr($badge['url']); ?>" class="<?php echo esc_attr(implode(' ', $badge_class)); ?>">
            <span class="stmicon-viral_<?php echo esc_attr($badge['class']); ?>"></span>
        </a>
    <?php endif; ?>
</div>

<?php if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
    get_template_part("{$parts}/image");
} ?>

<div class="stm_mgb_20 stm_single_post__content">
    <?php the_content(); ?>
</div>
<div class="clearfix"></div>

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

<div class="sharethis-inline-share-buttons sharethis-inline-share-buttons_bottom"></div>

<?php
    if (pearl_check_string(pearl_get_option('post_author'))) {
        get_template_part("{$path}/_author");
    }
?>

<?php get_template_part("{$parts}/prev_next_posts_2"); ?>