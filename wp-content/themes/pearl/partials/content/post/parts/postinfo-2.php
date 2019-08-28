<div class="stm_post_details clearfix">
    <div class="post_date mbc">
        <span class="day"><?php echo get_the_date('d'); ?></span>
        <span class="month"><?php echo get_the_date('M'); ?></span>
    </div>
    <div class="post_details">
        <div class="post_by">
            <?php _e( 'Posted by:', 'pearl' ); ?> <span><?php the_author(); ?></span>
        </div>
        <div class="post_cat">
            <?php _e( 'Category:', 'pearl' ); ?>
            <span>
                <?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ); ?>
            </span>
        </div>
        <div class="comments_num">
            <a href="<?php comments_link(); ?>" class="mtc no_deco ttc_h">
                <i class="stmicon-comment2"></i> <?php comments_number(); ?>
            </a>
        </div>
    </div>

</div>