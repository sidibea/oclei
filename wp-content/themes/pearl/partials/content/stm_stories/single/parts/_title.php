<?php

$id = get_the_ID();


$intro = get_post_meta($id, 'stm_intro', true);

?>

<div class="stm_mgb_55">
    <h1 class="mtc text-center stm_mgb_10"><?php the_title(); ?></h1>

    <?php if(!empty($intro)): ?>
        <div class="text-center fsz_20"><?php echo sanitize_text_field($intro); ?></div>
    <?php endif; ?>
</div>
