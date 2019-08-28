<?php $total_widgets = wp_get_sidebars_widgets();

$footer_widgets = !empty($total_widgets['footer']) ? count($total_widgets['footer']) : 0;
?>

<div class="container <?php echo esc_attr('footer_widgets_count_' . $footer_widgets); ?>">

    <?php if (is_active_sidebar('footer') && $footer_widgets): ?>
        <div class="footer-widgets">
            <?php dynamic_sidebar('footer'); ?>
        </div>
    <?php endif; ?>

    <?php
    $layout = pearl_get_option('stm_footer_layout', 1);

    $style = 'partials/footer/layouts/layout_' . $layout;

    get_template_part($style);
    ?>

</div>
