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
	<header class="site-header">
        <div class="c-mobile-menu-container">
            <div class="o-container">
                <nav class="c-mobile-menu">
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
                </nav>
            </div>
        </div>
        <div class="header-left">
            <h1>Yam Yam Cards</h1>
        </div>
        <div class="header-right">
            <a class="c-menu-trigger" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a>
            <nav class="c-main-menu" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
        </div>
	</header><!-- #masthead -->

	<main id="content" class="site-content">
