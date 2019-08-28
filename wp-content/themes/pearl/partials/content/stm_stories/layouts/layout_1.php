<?php $tpl = 'partials/content/stm_stories/single/parts/'; ?>

<?php get_template_part($tpl . '_title'); ?>

<div class="stm_mgb_60">
    <div class="row stm_mgb_30">
        <div class="col-md-6 col-sm-6">
            <?php get_template_part($tpl . '_data'); ?>
        </div>
        <div class="col-md-6 col-sm-6">
            <?php get_template_part($tpl . '_image'); ?>
        </div>
    </div>

    <div class="stm_mgb_50">
        <?php the_content(); ?>
    </div>

    <div class="stm_mgb_50">
        <?php get_template_part($tpl . '_before_after'); ?>
    </div>

    <div class="text-right _share">
        <?php get_template_part('partials/content/post/single/_share'); ?>
    </div>

    <div class="_comments">
        <?php get_template_part('partials/content/post/parts/comments'); ?>
    </div>

</div>