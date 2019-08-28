<?php
$categories = wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) );
?>

<div class="stm_post_details clearfix">
    <ul class="clearfix">
        <li class="post_date">
            <i class="fa fa-clock-o mtc"></i>
            <span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_by">
            <i class="fa fa-user mtc"></i>
            <span><?php the_author(); ?></span>
        </li>
        <?php if(!empty($categories)): ?>
            <li class="post_cat">
                <i class="fa fa-tag mtc"></i>
                <span>
                    <?php echo implode( ', ', $categories ); ?>
                </span>
            </li>
        <?php endif; ?>
        <li class="post_comments">
            <i class="fa fa-comments mtc"></i>
            <span><?php comments_number(); ?></span>
        </li>
    </ul>
</div>