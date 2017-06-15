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

    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-23811099-4', 'auto');
      ga('send', 'pageview');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '1616473705061629');
    fbq('track', 'PageView');
    </script>
    <noscript>
     <img height="1" width="1"
    src="https://www.facebook.com/tr?id=1616473705061629&ev=PageView
    &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

</head>

<body <?php body_class(); ?>>
    <div class="c-mobile-menu-container">
        <div class="o-container">
            <p class="c-close-menu"><a href="javascript:;"><i class="fa fa-times" aria-hidden="true"></i> Close</a></p>
            <nav class="c-menu--mobile">
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'c-menu--mobile__primary' ) ); ?>
                <ul class="c-menu--mobile__secondary">
                    <li><a target="_blank" href="https://twitter.com/yamyamcards">twitter</a></li>
                    <li><a target="_blank" href="https://instagram.com/yamyamcards">instagram</a></li>
                    <li><a target="_blank" href="https://www.facebook.com/yamyamcards/">facebook</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <header class="c-site-header">
        <div class="o-container">
            <div class="c-header-left">
                <h1 class="c-header__title"><a href="/">YamYamCards</a></h1>
            </div>
            <div class="c-header-right">
                <a class="c-menu-trigger" href="javascript:;"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a>
                <nav class="c-main-menu" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'c-menu-primary' ) ); ?>
                    <ul class="c-menu-secondary">
                    <li><a target="_blank" href="https://twitter.com/yamyamcards">twitter</a></li>
                    <li><a target="_blank" href="https://instagram.com/yamyamcards">instagram</a></li>
                    <li><a target="_blank" href="https://www.facebook.com/yamyamcards/">facebook</a></li>
                    </ul>
                </nav><!-- #site-navigation -->
            </div>
        </div>
	</header><!-- #masthead -->

	<main id="content" class="site-content">
        <?php get_template_part( 'template-parts/content', 'quick-info' ); ?>

