<?php
//Rental
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';

$post = get_queried_object();
$id = (!empty($post->ID)) ? $post->ID : '';
/*If is shop*/
$id = (pearl_is_shop() or pearl_is_account_page()) ? pearl_shop_page_id() : $id;

$settings = pearl_title_box_settings($id);
$post_image_url = get_the_post_thumbnail_url($id, 'full');

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

?>
<?php if (pearl_check_string($settings['page_title_box'])): ?>
    <div class="stm_post_details with_titlebox clearfix wtc">
        <span class="stm_post_details_info">
            <i class="fa fa-user-circle-o stm_post_details_icons"
               aria-hidden="true"></i> <?php _e('Posted by:', 'pearl'); ?> <?php the_author(); ?>
        </span>
        <span class="stm_post_details_info">
            <a href="<?php the_permalink() ?>" class="no_deco wtc">
                <i class="fa fa-calendar-o stm_post_details_icons" aria-hidden="true"></i> <?php echo get_the_date(); ?>
            </a>
        </span>
        <span class="stm_post_details_info">
            <a href="<?php comments_link(); ?>" class="wtc no_deco wtc_h">
                <i class="stmicon-quote4 stm_post_details_icons"></i> <?php comments_number(); ?>
            </a>
        </span>
    </div>
<?php else: ?>
    <div class="post__titlebox vc_container-fluid-force"
         style="background-image: url(<?php echo wp_kses_post($post_image_url); ?>)">

        <div class="container ">
            <div class="post__title col-md-6">
                <h1><?php the_title(); ?></h1>
            </div>

            <div class="stm_post_details clearfix mbc_b">
				<?php
				$categories = get_the_category();
				if (!is_wp_error($categories) && !empty($categories)) :
					?>
                    <div class="post_categories info__item">
						<?php foreach ($categories as $category) {
							?>
                            <div class="post_category">
								<?php echo wp_kses_post($category->name); ?>
                            </div>
							<?php
						} ?>
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

				<?php if (!empty(get_the_tags())): ?>
                    <div class="tags info__item">
                        <i class="stmicon-magazine-tag"></i>
						<?php the_tags('', ',&nbsp;', ''); ?>
                    </div>
				<?php endif; ?>
                <div class="post__share info__item">
					<?php get_template_part('partials/content/post/single/_share'); ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php
if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()) {
	get_template_part("{$parts}/image");
} ?>

    <div class="stm_mgb_20 stm_single_post__content">
		<?php the_content(); ?>
    </div>

    <div class="stm_post_panel">
        <div class="stm_flex stm_flex_center stm_flex_last">
            <div class="stm_single_post__tags">
				<?php if (!empty($terms)): ?>
                    <span class="stm_mf"><?php echo implode(' ', $terms); ?></span>
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