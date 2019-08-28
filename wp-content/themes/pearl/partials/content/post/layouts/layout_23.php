<?php
//Factory
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

$post = get_queried_object();
$id = (!empty($post->ID)) ? $post->ID : '';
/*If is shop*/
$id = (pearl_is_shop() or pearl_is_account_page()) ? pearl_shop_page_id() : $id;

$settings = pearl_title_box_settings($id);

$terms = pearl_get_terms_array(
    get_the_ID(),
    'post_tag',
    'name',
    true,
    array('class' => 'wtc mtc_h no_deco')
);

?>
<?php if (pearl_check_string($settings['page_title_box'])): ?>
    <div class="stm_post_details with_titlebox clearfix mbc wtc stm_mf">
        <span class="stm_post_details_info">
            <a href="<?php the_permalink() ?>" class="no_deco wtc">
                <span class="stmicon-factory_calendar"></span> <?php echo get_the_date('M j, Y') ?>
            </a>
        </span>
        <span class="stm_post_details_info">
            <span class="stmicon-factory_user"></span> <?php _e( 'Posted by:', 'pearl' ); ?> <?php the_author(); ?>
        </span>
        <span class="stm_post_details_info">
            <?php if (!empty($category = get_the_category())): ?>
                <?php foreach($category as $single_category): ?>
                    <a class="no_deco" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                        <span class="stmicon-factory_cat"></span> <?php echo esc_attr($single_category->name); ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </span>
    </div>
    <?php else: ?>
        <?php if (pearl_check_string(pearl_get_option('post_title'))): ?>
            <h2><?php the_title(); ?></h2>
        <?php endif; ?>
        <div class="stm_post_details clearfix mbc stm_mf">
            <span class="stm_post_details_info">
                <a href="<?php the_permalink() ?>" class="no_deco ">
                    <span class="stmicon-factory_calendar"></span> <?php echo get_the_date('j F Y') ?>
                </a>
            </span>
            <span class="stm_post_details_info">
                <span class="stmicon-factory_user"></span> <?php _e( 'Posted by:', 'pearl' ); ?> <?php the_author(); ?>
            </span>
            <span class="stm_post_details_info">
                 <?php if (!empty($category = get_the_category())): ?>
                    <?php foreach($category as $single_category): ?>
                        <a class="no_deco" href="<?php echo esc_url(get_term_link($single_category)); ?>">
                            <span class="stmicon-factory_cat"></span> <?php echo esc_attr($single_category->name); ?>
                        </a>
                    <?php endforeach; ?>
                 <?php endif; ?>
            </span>
        </div>
<?php endif; ?>
<?php
if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
    get_template_part("{$parts}/image");
} else { ?>

<?php } ?>

    <div class="stm_mgb_20 stm_single_post__content">
        <?php the_content(); ?>
    </div>

    <div class="stm_post_panel">
        <div class="stm_flex stm_flex_center stm_flex_last">
            <?php
            if (!empty($tags = get_the_tags()) && pearl_check_string(pearl_get_option('post_tags'))) : ?>
                <div class="stm_single_post__tags">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag)) ?>"
                           title="<?php echo $tag->name; ?>"
                           class="stm_single_post__tag mbc_h">
                            <?php echo $tag->name; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (pearl_check_string(pearl_get_option('post_share'))) : ?>
                <div class="stm_single_event__share">
                    <div class="sharethis-inline-share-buttons sharethis-inline-share-buttons_bottom"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>