<?php

$show_tags = pearl_check_string(pearl_get_option('post_tags'));
$show_share = pearl_check_string(pearl_get_option('post_share'));

if($show_tags or $show_share) {

	$terms = pearl_get_terms_array(
		get_the_ID(),
		'post_tag',
		'name',
		true,
		array('class' => 'mbc_h no_deco')
	);

	if (!empty($terms) || function_exists('stm_get_shares')): ?>

        <div class="stm_post_panel">
            <div class="stm_flex stm_flex_justify_space_between stm_flex_last">
				<?php if ($show_tags): ?>
                    <div class="stm_single_post__tags">
						<?php if (!empty($terms)): ?>
                            <div><?php echo implode('', $terms); ?></div>
						<?php endif; ?>
                    </div>
				<?php endif; ?>

				<?php if ($show_share): ?>
                    <div class="stm_single_event__share">
						<?php get_template_part('partials/content/post/single/_share'); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>

	<?php endif;
}