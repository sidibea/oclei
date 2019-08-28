<?php
/*STM STAFF LIST*/
$image_size = (!empty($image_size)) ? $image_size : '280x280';
$image = (!empty($image)) ? pearl_get_VC_img($image, $image_size) : '';


if (!empty($image)): ?>
	<div class="stm_staff__image">
		<?php echo wp_kses_post($image); ?>
		<div class="stm_staff__links">
			<?php
			/*Socials*/
			$socials = array();
			if(!empty($facebook)) $socials['facebook'] = $facebook;
			if(!empty($twitter)) $socials['twitter'] = $twitter;
			if(!empty($linkedin)) $socials['linkedin'] = $linkedin;
			if(!empty($gplus)) $socials['gplus'] = $gplus;
			if(!empty($insta)) $socials['insta'] = $insta;
			pearl_load_vc_element('stm_staff', $socials, 'parts/socials');
			?>
		</div>
	</div>
	<div class="stm_staff__info">
		<div class="stm_staff__info-inner">
			<?php if (!empty($name)): ?>
				<h5 class="stm_staff__name no_line"><?php echo sanitize_text_field($name); ?></h5>
			<?php endif; ?>
			<?php if (!empty($job)): ?>
				<div class="stm_staff__job"><?php echo sanitize_text_field($job); ?></div>
			<?php endif; ?>



			<?php
			if (!empty($phone) || !empty($email)) :
				?>
				<div class="stm_staff__contacts">
					<?php
					if (!empty($phone)) : ?>
						<div class="stm_staff__contact stm_staff__phone stc_b">
							<i class="stmicon-iphone"></i>
							<?php echo sanitize_text_field($phone); ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($email)) : ?>
						<div class="stm_staff__email stm_staff__contact">
							<i class="stmicon-envelope2"></i>
							<a href="mailto:<?php echo sanitize_email($email); ?>" rel="nofollow" class="stc"><?php echo sanitize_email($email); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>




		</div>

	</div>
<?php endif; ?>