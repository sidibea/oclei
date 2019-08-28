<div class="stm_post_details clearfix">
    <ul>
        <li class="post_date">
			<i class="stmicon-bon-clock mtc"></i>
            <span><?php echo get_the_date(); ?></span>
        </li>
		<li class="post_by">
			<i class="stmicon-bon-innk mtc"></i>
			<span><?php the_author(); ?></span>
		</li>
        <li class="post_comments">
			<i class="stmicon-bon-phrase mtc"></i>
            <span><?php comments_number(); ?></span>
        </li>
    </ul>
</div>