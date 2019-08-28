<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';
$rand = uniqid('stm_album_list');

$classes = array('stm_album_list');
$classes[] = $rand;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_album_list_' . $style;

pearl_add_element_style('album_list', $style);

$per_page = (!empty($posts_per_page)) ? $posts_per_page : pearl_posts_per_page();

$args = array(
	'post_type'      => 'stm_albums',
	'posts_per_page' => $per_page,
);

if(!empty($category) and $category !== 'all') {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'album_category',
			'field'    => 'id',
			'terms'    => $category,
		)
	);
}

if ($carousel == 'enable') {
	wp_enqueue_style('owl-carousel2');
	wp_enqueue_script('pearl-owl-carousel2');
}

$img_size = (!empty($img_size)) ? $img_size : '330x330';

$q = new WP_Query($args);

if ($q->have_posts()): ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php if(!empty($title) or $carousel == 'enable'): ?>
			<div class="container stm_album_list__heading">
				<div class="row">
					<div class="col-md-8 col-sm-6">
						<?php if(!empty($title)): ?>
							<h2 class="<?php echo esc_attr($text_class); ?>"><?php echo sanitize_text_field($title); ?></h2>
						<?php endif; ?>
					</div>
					<div class="col-md-4 col-sm-6">
						<?php if($carousel == 'enable'): ?>
							<div class="stm_album_list__nav">
								<div class="owl-controls">
									<div class="owl-nav"></div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="stm_album_list__flex">
			<?php while ($q->have_posts()):
				$q->the_post();
				$id = get_the_ID();
				$album_desc = get_post_meta($id, 'album_desc', true);
				?>
				<a class="inner no_deco wtc"
				   title="<?php the_title(); ?>"
				   href="<?php the_permalink(); ?>">
					<?php echo html_entity_decode(pearl_get_VC_img(get_post_thumbnail_id($id), $img_size)); ?>
					<div class="album-info" data-audio="true">
						<div class="album-info__inner">
							<div class="mbc stm_album__play" data-album="<?php echo intval($id) ?>"></div>
							<h4 class="wtc"><?php the_title(); ?></h4>
							<span><?php echo sanitize_text_field($album_desc); ?></span>
						</div>
					</div>
				</a>
			<?php endwhile; ?>
		</div>
	</div>

	<?php if ($carousel == 'enable'):
        ob_start();
        ?>
			(function ($) {
				$(document).ready(function () {
					var $carousel = '.<?php echo esc_js($rand); ?> .stm_album_list__flex';
					var nav_container = '.<?php echo esc_js($rand); ?> .stm_album_list__nav .owl-nav';
					var owlRtl = false;
					if ($('body').hasClass('rtl')) {
						owlRtl = true;
					}
					$($carousel).owlCarousel({
						rtl: owlRtl,
						items: 5,
						dots: false,
						nav: true,
						slideBy: 1,
						smartSpeed: 800,
						autoplay: false,
						navText: '',
						navContainer: nav_container,
						loop: true,
						responsive: {
							0: {
								items: 1,
							},
							550: {
								items: 2
							},
							768: {
								items: 3,
							},
							1024: {
								items: 4
							},
							1300: {
								items: 5
							}
						}
					})
				})
			})(jQuery);
	<?php
    $script = ob_get_clean();
    wp_add_inline_script('pearl-theme-scripts', $script);
    endif; ?>

<?php endif;
wp_reset_query(); ?>