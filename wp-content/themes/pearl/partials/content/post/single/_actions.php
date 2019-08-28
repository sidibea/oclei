<div class="stm_post__actions stm_flex stm_flex_center stm_mgb_40 stm_flex_last">

    <?php
    if(pearl_check_string(pearl_get_option('post_tags'))) {
        get_template_part('partials/content/post/single/_tags');
    }

    if(pearl_check_string(pearl_get_option('post_share'))) {
        get_template_part('partials/content/post/single/_share');
    }
    ?>
</div>