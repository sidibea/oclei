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


$post_views = get_post_meta($id, 'stm_post_views', true);
if (empty($post_views)) {
    $post_views = 0;
}



$post_format = get_post_format($id);

$post_video = false;
if ($post_format === 'video') {
    $post_video = get_post_meta(get_the_ID(), 'single_post_video', true);
    if (!empty($post_video)) {
        $post_video = pearl_generate_youtube($post_video, false);
    }
}
?>

<?php if ($post_video) : ?>
    <div class="stm_single_post__video">
        <iframe src="<?php echo esc_url($post_video); ?>" frameborder="0"></iframe>
    </div>
<?php endif; ?>


    <?php
    $post_titlebox_enabled = get_post_meta($id, 'page_title_box', true);

    if (pearl_check_string(pearl_get_option('post_title')) && $post_titlebox_enabled !== 'true') : ?>

        <div class="col-md-6 col-md-offset-3 stm_single_post__title">
            <h1><?php the_title(); ?></h1>
        </div>
    <div class="stm_single_post__details clearfix">
		<?php
    $categories = get_the_category();
    if (!is_wp_error($categories) && !empty($categories)) : ?>
            <div class="post_categories info__item">
				<?php foreach ($categories as $category) : ?>
                    <div class="post_category">
						<?php echo wp_kses_post($category->name); ?>
                    </div>
					<?php

    endforeach; ?>
            </div>
		<?php endif; ?>

        <div class="date info__item">
            <i class="stmicon-magazine-calendar"></i>
            <span>
                <?php
                $posted = get_the_time('U');
                echo human_time_diff($posted, current_time('U')) . ' ago';
                ?>
            </span>
        </div>

        <div class="author info__item">
            <i class="stmicon-magazine-user"></i>
            <span><?php the_author(); ?></span>
        </div>

        <div class="views_count info__item">
            <i class="stmicon-magazine-view"></i>
            <span><?php echo intval($post_views); ?></span>
        </div>
		<?php if (!empty(get_the_tags())) : ?>
            <div class="tags info__item">
                <i class="stmicon-magazine-tag"></i>
				<?php the_tags('', ',&nbsp;', ''); ?>
            </div>
		<?php endif; ?>
    </div>
<?php endif; ?>
    
<?php
if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
    get_template_part("{$parts}/image");
} ?>


    <div class="stm_mgb_20 stm_single_post__content">
			<?php the_content(); ?>
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
							<?php get_template_part('partials/content/post/single/_share'); ?>
                        </div>
					<?php endif; ?>
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