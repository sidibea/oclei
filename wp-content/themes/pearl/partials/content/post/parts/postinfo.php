<div class="stm_post_details clearfix mbc wtc stm_mf">
    <ul class="clearfix">
        <li class="post_date">
			<div href="<?php the_permalink() ?>" class="no_deco wtc">
            	<i class="stmicon-calendar3"></i> <?php echo get_the_date(); ?>
			</div>
        </li>
        <li class="post_by">
            <i class="stmicon-user_b"></i> <?php _e( 'Posted by:', 'pearl' ); ?> <?php the_author(); ?>
        </li>
    </ul>
    <div class="comments_num">
        <a href="<?php comments_link(); ?>" class="wtc no_deco wtc_h">
            <i class="stmicon-comment3"></i> <?php comments_number(); ?>
        </a>
    </div>
</div>