<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yamyamcards
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="c-mobile-menu-container">
        <div class="o-container">
            <p class="c-close-menu"><a href="javascript:;"><i class="fa fa-times" aria-hidden="true"></i> Close</a></p>
            <nav class="c-menu--mobile">
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'c-menu--mobile__primary' ) ); ?>
                <ul class="c-menu--mobile__secondary">
                    <li><a href="">twitter</a></li>
                    <li><a href="">instagram</a></li>
                    <li><a href="">facebook</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <header class="c-site-header">
        <div class="o-container">
            <div class="c-header-left">
                <h1 class="c-header__title"><a href="/">YamYam</a></h1>
            </div>
            <div class="c-header-right">
                <a class="c-menu-trigger" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a>
                <nav class="c-main-menu" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'c-menu-primary' ) ); ?>
                    <ul class="c-menu-secondary">
                        <li><a href="">twitter</a></li>
                        <li><a href="">instagram</a></li>
                        <li><a href="">facebook</a></li>
                    </ul>
                </nav><!-- #site-navigation -->
            </div>
        </div>
	</header><!-- #masthead -->

	<main id="content" class="site-content">
        <?php get_template_part( 'template-parts/content', 'quick-info' ); ?>

