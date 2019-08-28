<?php get_header(); ?>
    <?php pearl_get_titlebox(); ?>

<?php if (have_posts()): ?>
    <?php get_template_part('partials/content/archive'); ?>
<?php else: ?>
    <?php get_template_part('partials/content/none'); ?>
<?php endif; ?>

<?php get_footer(); ?>