<?php
//Rental
$image_size = (!empty($image_size)) ? $image_size : '280x280';
$image = (!empty($image)) ? pearl_get_VC_img($image, $image_size) : '';

if(!empty($image)): ?>
    <div class="stm_staff__image">
        <?php echo wp_kses_post($image); ?>
    </div>
    <div class="stm_staff__info">
        <?php if(!empty($name)): ?>
            <h6 class="stm_staff__name"><?php echo sanitize_text_field($name); ?></h6>
        <?php endif; ?>
        <div class="stm_staff__info_content">
            <?php if(!empty($job)): ?>
                <div class="stm_staff__job"><?php echo sanitize_text_field($job); ?></div>
            <?php endif; ?>
            <?php if(!empty($description)): ?>
                <div class="stm_staff__description">
                    <p><?php echo wp_kses_post($description); ?></p>
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