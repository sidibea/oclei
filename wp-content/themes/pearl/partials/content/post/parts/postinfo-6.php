<div class="stm_post_details clearfix">
    <ul class="clearfix">
        <li class="post_cat">
            <span class="mbc">
                <?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ); ?>
            </span>
        </li>
        <li class="post_date">
            <span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_comments">
            <i class="stmicon-speech-bubble"></i>
            <span><?php comments_number(); ?></span>
        </li>
        <li class="post_by">
            <i class="stmicon-head"></i>
            <span><?php the_author(); ?></span>
        </li>
    </ul>
</div>