<div class="stm_post_details clearfix">
    <ul class="clearfix">
        <li class="post_date">
            <span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_by">
            <?php _e( 'Posted by:', 'pearl' ); ?> <span><?php the_author(); ?></span>
        </li>
        <li class="post_cat">
            <?php _e( 'Category:', 'pearl' ); ?>
            <span>
                <?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ); ?>
            </span>
        </li>
    </ul>
    <div class="comments_num">
        <a href="<?php comments_link(); ?>" class="ttc no_deco mtc_h">
            <i class="fa fa-comment-o mtc"></i> <?php comments_number(); ?>
        </a>
    </div>
</div>