<div class="stm_post_details clearfix">
    <ul class="clearfix">
        <li class="post_date">
            <i class="stmicon-charity_calendar stc"></i>
            <span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_by">
            <i class="stmicon-user2 stc"></i>
            <span><?php the_author(); ?></span>
        </li>
        <li class="post_comments">
            <i class="stmicon-comment2 stc"></i>
            <span><?php comments_number(); ?></span>
        </li>
    </ul>
</div>