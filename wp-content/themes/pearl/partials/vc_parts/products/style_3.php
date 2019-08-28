<?php
$img_size = empty($img_size) ? '360x360' : $img_size;
?>

<div class="stm_product__single">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php if (has_post_thumbnail()) { ?>
			<?php if (!empty($img_size)): ?>
                <div class="product_thumbnail">
                    <span class="product_thumbnail__overlay"></span>
					<?php echo pearl_get_VC_img(get_post_thumbnail_id(), $img_size); ?></div>
			<?php else: ?>
                <div class="product_thumbnail">
                    <span class="product_thumbnail__overlay"></span>
					<?php the_post_thumbnail('pearl-img-80-80', array('class' => 'img-responsive')); ?></div>
			<?php endif; ?>
		<?php } ?>
        <span class="product_info">
            <h4 class="no_line stm_animated"><?php the_title(); ?></h4>
        </span>
    </a>
</div>