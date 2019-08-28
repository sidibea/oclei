<div class="stm_post_details clearfix">
    <ul class="clearfix">
        <li class="post_date">
			<i class="stmicon-calendar"></i>
            <span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_comments">
			<i class="stmicon-comment"></i>
            <span><?php echo intval(get_comments_number()); ?></span>
        </li>
    </ul>
</div>