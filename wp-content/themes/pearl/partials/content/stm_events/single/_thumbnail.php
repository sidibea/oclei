<?php if(has_post_thumbnail()): ?>
    <div class="stm_single_event__thumbnail">
        <?php if(has_post_thumbnail()):
            $img_id = get_post_thumbnail_id($id);
            $image = pearl_get_VC_img($img_id, 'full');
            echo wp_kses_post($image);
        endif; ?>
    </div>
<?php endif; ?>