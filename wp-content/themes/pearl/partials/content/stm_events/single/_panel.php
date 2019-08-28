<div class="stm_single_event__panel tbc">
    <div class="stm_flex stm_flex_center stm_flex_last">
        <div class="stm_single_event__categories">
            <?php
            $terms = pearl_get_terms_array(
                get_the_ID(),
                'event_category',
                'name',
                true,
                array('class' => 'wtc mtc_h no_deco')
            );
            ?>
            <i class="stmicon-tag2 __icon icon_20px mtc"></i>
            <span class="wtc stm_mf"><?php echo implode(', ', $terms); ?></span>
        </div>
        <div class="stm_single_event__share">
            <?php get_template_part('partials/content/post/single/_share'); ?>
        </div>
    </div>
</div>