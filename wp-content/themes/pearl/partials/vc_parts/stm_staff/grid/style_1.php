<?php
/*STM STAFF LIST*/
$image_size = (!empty($image_size)) ? $image_size : '280x280';
$image = (!empty($image)) ? pearl_get_VC_img($image, $image_size) : '';

if(!empty($image)): ?>
    <div class="stm_staff__image">
        <?php echo wp_kses_post($image); ?>
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
    <div class="stm_staff__info">
        <?php if(!empty($name)): ?>
            <h5 class="stm_staff__name text-transform"><?php echo sanitize_text_field($name); ?></h5>
        <?php endif; ?>
        <?php if(!empty($job)): ?>
            <div class="stm_staff__job"><?php echo sanitize_text_field($job); ?></div>
        <?php endif; ?>
        <?php if(!empty($description)): ?>
            <p><?php echo wp_kses_post($description); ?></p>
        <?php endif; ?>

        <?php if(!empty($full_description)): ?>
            <p class="js_trigger__unit"><?php echo wp_kses_post($full_description); ?></p>
        <?php endif; ?>

        <div class="stm_staff__links clearfix">
            <?php if(!empty($full_description)): ?>
                <a class="btn btn_primary btn_solid js_trigger__click"
                   href="#"
                   title="<?php esc_html_e("View full Information", 'pearl'); ?> ">
                    <?php esc_html_e('View more', 'pearl'); ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="stm_linear_repeater"></div>
    </div>
<?php endif; ?>