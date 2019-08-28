<?php
/*STM STAFF LIST*/
$image_size = (!empty($image_size)) ? $image_size : '280x280';
$image = (!empty($image)) ? pearl_get_VC_img($image, $image_size) : '';


if (!empty($image)): ?>
	<div class="stm_staff__image">
		<?php echo wp_kses_post($image); ?>
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
							<i class="stmicon-phone2 stc"></i>
							<a href="tel:<?php echo sanitize_text_field($phone); ?>" rel="nofollow"><?php echo sanitize_text_field($phone); ?></a>

						</div>
					<?php endif; ?>

					<?php if (!empty($email)) : ?>
						<div class="stm_staff__contact stm_staff__email stc_b">
							<i class="stmicon-envelope stc"></i>
							<a href="mailto:<?php echo sanitize_email($email); ?>" rel="nofollow" class="mtc"><?php echo sanitize_email($email); ?></a>
						</div>
					<?php endif; ?>

					<?php if (!empty($skype)) : ?>
						<div class="stm_staff__contact stm_staff__skype stc_b">
							<i class="stmicon-skype stc"></i>
							<a href="skype:<?php echo sanitize_text_field($skype); ?>?call" rel="nofollow"><?php echo sanitize_text_field($skype); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

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
<?php endif; ?>