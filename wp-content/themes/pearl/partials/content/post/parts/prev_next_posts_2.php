<?php
$pn_posts = array();
$prev_post = get_previous_post();
$next_post = get_next_post();

$post_type = (!empty(get_post_type())) ? get_post_type() : 'post';
$post_object = get_post_type_object($post_type);
$post_name = (!empty($post_object->label)) ? $post_object->label : esc_html__('Post', 'pearl');

if (!empty($prev_post)) {
	$pn_posts['prev'] = array(
		'id'    => $prev_post->ID,
		'title' => $prev_post->post_title,
		'url' => get_the_permalink($prev_post->ID),
	);
};
if (!empty($next_post)) {
	$pn_posts['next'] = array(
		'id'    => $next_post->ID,
		'title' => $next_post->post_title,
		'url' => get_the_permalink($next_post->ID),
	);
};

if (!empty($pn_posts)): ?>
	<div class="stm_prevnext">
		<?php foreach ($pn_posts as $post_key => $prev_next): ?>
			<?php if (!empty($prev_next)): ?>
				<div class="stm_prevnext__post stm_prevnext__post_<?php echo esc_attr($post_key) ?> mtc_b">
					<a href="<?php echo esc_url($prev_next['url']); ?>" class="inner no_deco mtc_h" title="<?php echo esc_attr($prev_next['title']); ?>">
						<div class="stm_prevnext__content">
							<div class="stm_prevnext__title heading_font">
								<?php echo esc_attr($prev_next['title']); ?>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>