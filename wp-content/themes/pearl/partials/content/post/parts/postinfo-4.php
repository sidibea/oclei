<div class="stm_single__post-details clearfix">
    <ul class="clearfix list-unstyled">
        <li class="post_date">
            <span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_comments_count">
            <span>
                <?php _e( 'Comments: ', 'pearl' ); ?>
            </span>
            <span>
                <?php echo get_comments_number(); ?>
            </span>
        </li>
        <li class="post_by">
            <?php _e( 'Posted by:', 'pearl' ); ?> <span><?php the_author(); ?></span>
        </li>
    </ul>
</div>