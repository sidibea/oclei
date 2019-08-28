<a href="<?php the_permalink(); ?>"
    <?php post_class('stm_loop__single stm_post_grid_style_6 no_deco ttc'); ?>
   title="<?php the_title(); ?>">
    <?php if (has_post_thumbnail()): ?>
        <div class="stm_post_grid__image mbc_b">
            <span class="cats mbc wtc">
                <?php echo implode(', ', wp_get_post_categories(get_the_ID(), array('fields' => 'names'))); ?>
            </span>
            <?php the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_28 img-responsive')); ?>
        </div>
    <?php endif; ?>
    <div class="postinfo">
        <div class="postinfo_grid ttc">
            <div class="post_date">
                <span class="heading_font mtc"><?php echo sanitize_text_field(get_the_date('j')); ?></span>
                <?php echo sanitize_text_field(get_the_date('M')); ?>
            </div>
            <div class="post_comments">
                <i class="stmicon-speech-bubble"></i>
                <span><?php comments_number('0', '1', '%'); ?></span>
            </div>
        </div>
        <div class="postinfo_content">
            <h5 class="no_line ttc mtc_h stm_animated">
                <?php echo pearl_minimize_word(get_the_title(), 70); ?>
            </h5>
            <div class="__content">
                <?php echo the_excerpt(); ?>
            </div>
        </div>
    </div>
</a>