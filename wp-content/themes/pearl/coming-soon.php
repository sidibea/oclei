<?php
/**
 * Template Name: Coming soon page
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="wrapper">

            <?php get_template_part('partials/coming_soon/' . pearl_coming_soon_style()); ?>

        </div> <!-- id wrapper closed-->
        <?php wp_footer(); ?>
    </body>
</html>