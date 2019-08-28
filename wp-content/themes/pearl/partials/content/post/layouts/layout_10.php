<?php
//Rental
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
            <i class="fa fa-user-circle-o stm_post_details_icons" aria-hidden="true"></i> <?php _e( 'Posted by:', 'pearl' ); ?> <?php the_author(); ?>
        </span>
        <span class="stm_post_details_info">
            <a href="<?php the_permalink() ?>" class="no_deco wtc">
                <i class="fa fa-calendar-o stm_post_details_icons" aria-hidden="true"></i> <?php echo get_the_date(); ?>
            </a>
        </span>
        <span class="stm_post_details_info">
            <a href="<?php comments_link(); ?>" class="wtc no_deco wtc_h">
                <span class="stmicon-quote4 stm_post_details_icons"></span> <?php comments_number(); ?>
            </a>
        </span>
    </div>
    <?php else: ?>
        <?php if (pearl_check_string(pearl_get_option('post_title'))): ?>
            <h1 class="h2 text-transform stm_lh_40"><?php the_title(); ?></h1>
        <?php endif; ?>
        <div class="stm_post_details clearfix mbc stm_mf">
            <span class="stm_post_details_info">
                <i class="fa fa-user-circle-o stm_post_details_icons" aria-hidden="true"></i> <?php _e( 'Posted by:', 'pearl' ); ?> <?php the_author(); ?>
            </span>
            <span class="stm_post_details_info">
                <a href="<?php the_permalink() ?>" class="no_deco ">
                    <i class="fa fa-calendar-o stm_post_details_icons" aria-hidden="true"></i> <?php echo get_the_date(); ?>
                </a>
            </span>
            <span class="stm_post_details_info">
                <a href="<?php comments_link(); ?>" class="no_deco">
                    <span class="stmicon-quote4 stm_post_details_icons"></span> <?php comments_number(); ?>
                </a>
            </span>
        </div>
<?php endif; ?>
<?php
if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
    get_template_part("{$parts}/image");
} else { ?>
    <div class="stm_mgb_40"></div>
<?php } ?>

    <div class="stm_mgb_20 stm_single_post__content">
        <?php the_content(); ?>
    </div>

    <div class="stm_post_panel">
        <div class="stm_flex stm_flex_center stm_flex_last">
            <div class="stm_single_post__tags">
                <?php if(!empty($terms)): ?>
                    <span class="stm_mf"><?php echo implode(' ', $terms); ?></span>
                <?php endif; ?>
            </div>
            <div class="stm_single_event__share">
                <?php get_template_part('partials/content/post/single/_share'); ?>
            </div>
        </div>
    </div>

<?php

if (pearl_check_string(pearl_get_option('post_author'))) {
    get_template_part("{$path}/_author");
}

if (pearl_check_string(pearl_get_option('post_comments'))) {
    get_template_part("{$parts}/comments");
}