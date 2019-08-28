<div class="stm_post_details clearfix">
    <div class="post_date mbc">
        <span class="day"><?php echo get_the_date('j'); ?></span>
        <span class="month"><?php echo get_the_date('M'); ?></span>
    </div>
    <div class="post_details">
        <div class="post_by">
            <?php _e( 'Author:', 'pearl' ); ?><br /><span><?php the_author(); ?></span>
        </div>
        <div class="post_cat">
            <?php _e( 'Posted in:', 'pearl' ); ?><br />
            <span>
                <?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ); ?>
            </span>
        </div>
        <div class="comments_num">
            <?php _e( 'Comments:', 'pearl' ); ?><br />
            <span><?php comments_number(); ?></span>
        </div>
    </div>

</div>