<?php
$viewed_albums = pearl_get_cookie('stm_albums_viewed');

$args = array(
	'post_type'      => 'stm_albums',
	'posts_per_page' => '1',
	'meta_query'     => array(
		array(
			'key'   => 'new_album',
			'value' => 'show'
		)
	)
);

if (!empty($viewed_albums)) $args['post__not_in'] = explode(',', $viewed_albums);

$q = new WP_Query($args);
if ($q->have_posts()): ?>
	<div class="stm_album__popup wtc">
		<div class="stm_album__bg"></div>
		<div class="stm_album__close mbc_b_h mbc_a_h"></div>
		<div class="container">
			<?php while ($q->have_posts()) :
				$q->the_post();
				$id = get_the_ID();
				$album_links = get_post_meta($id, 'album_links', true);
				$label = get_post_meta($id, 'album_desc', true);
				$new_album_label = get_post_meta($id, 'new_album_label', true);

				$viewed_albums = array_filter(explode(',', $viewed_albums));
				$viewed_albums[] = $id;
				$viewed_albums = implode(',', array_unique($viewed_albums));
				?>
				<div class="row">
					<div class="col-md-5 col-md-offset-1">
						<div class="stm_album__popup_image">
							<?php if (!empty($new_album_label)): ?>
								<div
									class="mbc heading_font wtc text-uppercase stm_album__popup_label"><?php echo sanitize_text_field($new_album_label); ?></div>
							<?php endif; ?>
							<?php echo html_entity_decode(pearl_get_VC_post_img_safe($id, '450x450', 'full')); ?>
						</div>
					</div>
					<div class="col-md-5">
						<h2 class="wtc stm_mgb_10"><?php the_title(); ?></h2>
						<?php if (!empty($label)): ?>
							<div
								class="text-uppercase wtc heading_font stm_album__popup_subtitle"><?php echo sanitize_text_field($label); ?></div>
						<?php endif; ?>
						<?php if (!empty($album_links)): ?>
							<div class="stm_album__popup__links">
								<?php foreach ($album_links as $album_link): ?>
									<?php if (!empty($album_link['label']) and !empty($album_link['name'])): ?>
										<a href="<?php echo esc_url($album_link['label']); ?>" target="_blank">
											<?php echo html_entity_decode(pearl_get_VC_img(intval($album_link['name']), '150x45')); ?>
										</a>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<a href="<?php the_permalink() ?>"
                           target="_blank"
                           class="btn btn_outline btn_white"
						   title="<?php the_title(); ?>">
							<?php esc_html_e('View more', 'pearl'); ?>
						</a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>

	<script type="text/javascript">
		(function ($) {
			$(document).ready(function () {
				$('.stm_album__bg, .stm_album__close').click(function () {
					$('.stm_album__popup').addClass('inactive');
					setTimeout(function () {
						$('.stm_album__popup').remove();
					}, 500);
				});
				createCookie('stm_albums_viewed', "<?php echo sanitize_text_field($viewed_albums); ?>", 7);
			})
		})(jQuery);
	</script>

<?php endif;