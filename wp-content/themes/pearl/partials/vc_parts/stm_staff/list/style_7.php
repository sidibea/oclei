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
			<div class="stm_flex stm_flex_center stm_flex_last">
				<div class="stm_flex_info">
					<?php if (!empty($name)): ?>
						<h4 class="stm_staff__name no_line"><?php echo sanitize_text_field($name); ?></h4>
					<?php endif; ?>
					<?php if (!empty($job)): ?>
						<div class="stm_staff__job heading_font"><?php echo sanitize_text_field($job); ?></div>
					<?php endif; ?>
				</div>
			</div>

            <?php
            /*Socials*/
            $socials = array();
            if (!empty($facebook)) $socials['facebook'] = $facebook;
            if (!empty($twitter)) $socials['twitter'] = $twitter;
            if (!empty($linkedin)) $socials['linkedin'] = $linkedin;
            if (!empty($gplus)) $socials['gplus'] = $gplus;
            if (!empty($insta)) $socials['insta'] = $insta;
            pearl_load_vc_element('stm_staff', $socials, 'parts/socials');
            ?>

			<?php if (!empty($phone) || !empty($email)) : ?>
				<div class="stm_staff__contacts">
					<?php
					if (!empty($phone)) : ?>
						<div class="stm_staff__contact stm_staff__phone">
							<i class="stmicon-phone"></i>
							<a href="tel:<?php echo sanitize_text_field($phone); ?>"
							   class="no_deco ttc mtc_h"
							   rel="nofollow"><?php echo sanitize_text_field($phone); ?></a>
						</div>
					<?php endif; ?>

					<?php if (!empty(sanitize_email($email))) : ?>
						<div class="stm_staff__contact stm_staff__email">
							<i class="stmicon-envelope"></i>
							<a href="mailto:<?php echo sanitize_email($email); ?>" rel="nofollow"
							   class="no_deco ttc mtc_h"><?php echo sanitize_email($email); ?></a>
						</div>
					<?php endif; ?>

					<?php if (!empty($email)) : ?>
						<div class="stm_staff__contact stm_staff__skype">
							<i class="stmicon-skype"></i>
							<a href="skype:<?php echo sanitize_text_field($skype); ?>?call"
							   class="no_deco ttc mtc_h"
							   rel="nofollow"><?php echo sanitize_text_field($skype); ?></a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($description)): ?>
				<p><?php echo wp_kses_post($description); ?></p>
			<?php endif; ?>

		</div>

	</div>
<?php endif; ?>