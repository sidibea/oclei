<?php
$posts = array();
$posts_per_page = empty($posts_per_page) ? '-1' : $posts_per_page;
$q_args = array(
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
	'order'          => 'ASC'
);

if (!empty($categories)) {
	$categories = explode(',', $categories);
	if (is_array($categories)) {
		$q_args['category__in'] = $categories;
	}
}

$q = new WP_Query($q_args);

if ($q->have_posts()) {
	while ($q->have_posts()) {
		$q->the_post();
		$year = get_the_date('Y');
		$title = (pearl_check_string($show_title)) ? get_the_title() : '';
		$id = get_the_ID();
		$url = get_the_permalink($id);
		$excerpt = get_the_excerpt($id);

		$image_id = get_post_thumbnail_id($id);
		$image = pearl_get_VC_img($image_id, $image_size);

		if (empty($posts[$year])) $posts[$year] = array();

		$posts[$year][] = array(
			'id'      => $id,
			'title'   => $title,
			'image'   => $image,
			'year'    => (pearl_check_string($show_year)) ? $year : '',
			'excerpt' => $excerpt,
			'url'     => $url
		);
	}

	wp_reset_postdata();
}

if (!empty($posts)): $current_odd = $current_even = $counter = 0; ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<div class="stm_posttimeline__year_posts">
			<!--LEFT COLUMN ALL ODD POSTS-->
			<div class="stm_posttimeline__year_posts_left">
				<?php foreach ($posts as $year => $year_posts) {
					foreach ($year_posts as $key => $post) {
						$current_odd++;
						if ($current_odd % 2 == 0) continue;
						pearl_display_posttimeline($key, $post, $counter);
						$counter++;
					};
				} ?>
			</div>

			<!--Right COLUMN ALL EVEN POSTS-->
			<div class="stm_posttimeline__year_posts_right">
				<?php $counter = 0; foreach ($posts as $year => $year_posts) {
					foreach ($year_posts as $key => $post) {
						$current_even++;
						if ($current_even % 2 != 0) continue;
						pearl_display_posttimeline($key, $post, $counter);
						$counter++;
					};
				} ?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$('.stm_posttimeline__post')
					.mouseenter(function(){
						var year = $(this).attr('data-related');
						$('[data-year="'+ year +'"]').addClass('active');
					})
					.mouseleave(function(){
						var year = $(this).attr('data-related');
						$('[data-year="'+ year +'"]').removeClass('active');
					});

				$('[data-year]').mouseenter(function(){
					var year = $(this).attr('data-year');
					$('[data-related="'+ year +'"]').addClass('active');
				})
					.mouseleave(function(){
						var year = $(this).attr('data-year');
						$('[data-related="'+ year +'"]').removeClass('active');
					});

				mix_posts();
			});


			function mix_posts() {
				if(window.innerWidth < 600) {
					$('.stm_posttimeline__year_posts_right .stm_posttimeline__post').each(function(){
						var $post = $(this);
						var index = $post.attr('data-key');
						var $insertAfter = $('.stm_posttimeline__year_posts_left .stm_posttimeline__post[data-key="'+index+'"]');
						$insertAfter.after($post);
					});
					$('.stm_posttimeline__year_posts_right').remove();
				}
			}

		})(jQuery);
	</script>
<?php endif;

function pearl_display_posttimeline($key, $post, $counter)
{
	extract($post);
	/**
	 * @var $id
	 * @var $title
	 * @var $image
	 * @var $year
	 * @var $excerpt
	 * @var $url
	 */
	$post_classes = array(
		'stm_posttimeline__post',
		'stm_posttimeline__post_' . $id,
	);
	$post_classes[] = (has_post_thumbnail($id)) ? 'has_thumb' : 'no_thumb';
	$post_classes[] = ($key === 0) ? 'main_year' : 'has_year';
	$post_classes[] = get_post_format($id);
	?>
	<div class="<?php echo esc_attr(implode(' ', $post_classes)); ?>" data-related="<?php echo intval($year); ?>" data-key="<?php echo intval($counter); ?>">
		<a href="<?php echo esc_url(get_the_permalink($id)); ?>"
		   class="stm_posttimeline__post_inner no_deco ttc">
			<?php if (in_array('main_year', $post_classes)): ?>
				<div class="stm_posttimeline__year heading_font" data-year="<?php echo intval($year); ?>">
					<span><?php echo intval($year) ?></span>
				</div>
			<?php endif; ?>
			<?php if (!empty($image)): ?>
				<div class="stm_posttimeline__post_image mbc_b">
					<?php echo html_entity_decode($image); ?>
				</div>
			<?php endif; ?>

			<div class="stm_posttimeline__post_info heading_font">
				<div
					class="stm_posttimeline__post_info-date mtc"><?php echo sanitize_text_field(get_the_date('j F', $id)); ?></div>
				<div class="stm_posttimeline__post_info-author" data-content="<?php esc_html_e('By', 'pearl'); ?>"><?php the_author(); ?>
					<span><?php echo get_avatar(get_the_author_meta('email'), 174); ?></span></div>
			</div>

			<div class="stm_posttimeline__post_title">
				<h5><?php echo sanitize_text_field($title); ?></h5>
			</div>
			<div class="stm_posttimeline__post_excerpt"><?php echo sanitize_text_field($excerpt); ?></div>
		</a>
	</div>
<?php }