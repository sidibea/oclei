<?php
$post = get_queried_object();
$id = (!empty($post->ID)) ? $post->ID : '';
/*If is shop*/
$id = (pearl_is_shop_category() or pearl_is_shop() or pearl_is_account_page()) ? pearl_shop_page_id() : $id;

$settings = pearl_title_box_settings($id);

$titlebox_style = pearl_get_option('page_title_box_style', 'style_1');

if (pearl_check_string($settings['page_title_box']) and !is_front_page()):

	/*Its post or page and has title*/
	if (empty($settings['page_title_box_title']) and !empty($id)) {
		$settings['page_title_box_title'] = $post->post_title;
	}

	/*Its post or page and has title*/
	if (empty($settings['page_title_box_title']) and !empty($id)) $settings['page_title_box_title'] = $post->post_title;

	/*Its not a page or post with id, so check if it has label*/

	if (is_search()) $settings['page_title_box_title'] = esc_html__('Search', 'pearl');

	if (empty($id) and !empty($post) and !empty($post->label)) {
		$settings['page_title_box_title'] = $post->label;
	}

	$titlebox = array(
		"stm_titlebox stm_titlebox_{$titlebox_style}",
		"stm_titlebox_text-{$settings['page_title_box_align']}"
	);

	/*Its a category*/
	if (empty($id) and !empty($post) and !empty($post->term_id)) {
		$settings['page_title_box_title'] = $post->name;
	}

	/*if is shop category*/
	if (pearl_is_shop_category() and !empty($post) and !empty($post->term_id)) {
		$settings['page_title_box_title'] = $post->name;
	}

	/*Title size*/
	$title_size = (!empty($settings['page_title_box_title_size'])) ? $settings['page_title_box_title_size'] : 'h1';

	/*If its date archive*/
	if (is_date()) {
		$settings['page_title_box_title'] = esc_html__('Date Archive', 'pearl');
	}

	$categories = array();

	if (!empty($settings['page_title_box_category'])) {
		$categories = wp_get_post_categories($id, array('fields' => 'names'));
		foreach ($categories as $category) {
		}
	}

	?>

    <div class="<?php echo esc_attr(implode(' ', $titlebox)); ?>">
        <div class="container">
            <div class="stm_flex stm_flex_last stm_flex_center">
                <div class="stm_titlebox__inner">
					<?php
					if (!empty($settings['page_title_box_title_line'])) {
						echo '<div class="stm_separator mbc stm_mgb_15"></div>';
					}
					?>

					<?php
					//category
					if (!empty($categories)) :
						?>
                        <div class="stm_titlebox__categories">
							<?php foreach ($categories as $category) : ?>
                                <div class="stm_titlebox__category mbc">
									<?php echo wp_kses_post($category) ?>
                                </div>
							<?php endforeach; ?>
                        </div>
					<?php endif; ?>

                    <h1 class="<?php echo esc_attr($title_size); ?> stm_titlebox__title no_line text-transform stm_mgb_2">
						<?php echo sanitize_text_field($settings['page_title_box_title']); ?><?php if ($titlebox_style === 'style_9') : ?>
                            <div class="stm_titlebox__separator">
                                <div class="separator__content"></div>
                            </div>
						<?php endif; ?>
                    </h1>


                    <div class="stm_titlebox__subtitle">
						<?php echo sanitize_text_field($settings['page_title_box_subtitle']); ?>
                    </div>

                        <?php if (!empty($settings['page_title_box_author'])) :
						$author_id = get_post_field('post_author', $id);
						$author = array(
							'avatar' => get_avatar($author_id, 44),
							'name'   => get_the_author_meta('display_name', $author_id)
						);
						$post_date = get_the_time('U', $id);
						$post_date = human_time_diff($post_date, current_time('U')) . ' ago';
						?>
                        <div class="stm_titlebox__author">
                            <div class="stm_titlebox__author_avatar">
                                <?php echo wp_kses_post($author['avatar']); ?>
                            </div>
                            <div class="stm_titlebox__author_name">
                                <?php echo wp_kses_post($author['name']); ?>
                            </div>
                            <div class="stm_titlebox__author_date">
                                <?php echo wp_kses_post($post_date); ?>
                            </div>
                        </div>
					<?php endif; ?>


					<?php if (pearl_check_string($settings['page_title_breadcrumbs'])) {
						get_template_part('partials/global/breadcrumbs');
					} ?>
                </div>
				<?php if (pearl_check_string($settings['page_title_button'])): ?>
                    <div class="stm_titlebox__actions">
                        <!--Button-->
						<?php if (pearl_check_string($settings['page_title_button'])): ?>
							<?php if (!empty($settings['page_title_button_text']) and !empty($settings['page_title_button_url'])): ?>
                                <a href="<?php echo esc_attr($settings['page_title_button_url']); ?>"
                                   class="btn btn_white btn_icon-right btn_solid"
                                   title="<?php echo esc_attr($settings['page_title_button_text']); ?>"
                                   target="_blank">
                                    <i class="fa fa-chevron-right btn__icon mtc icon_20px"></i>
									<?php echo esc_attr($settings['page_title_button_text']); ?>
                                </a>
							<?php endif; ?>
						<?php endif; ?>

                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>


<?php endif; ?>
