<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta name="viewport" content="width=device-width">
	<meta charset="<?php bloginfo('charset'); ?>">

    <script type="text/javascript" src="https://fast.fonts.net/jsapi/7908de59-bc35-4f9f-9acd-a619cb483e7e.js"></script>
	<?php wp_head(); ?>
</head>

<body class="<?php the_body_class(); ?>">

	<?php the_ie_warning(); ?>

    <div class="mobile-menu-container hide-lap">
        <div class="container">
            <p class="close-menu align-right"><a href="javascript:;"><small><i class="fa fa-times" aria-hidden="true"></i> Close Menu</small></a></p>
            <ul class="menu menu--mobile">
                <li><a href="<?php echo site_url(); ?>/our-values/">Our Values</a></li>
                <li><a href="<?php echo site_url(); ?>/news/">News</a></li>
                <li><a href="<?php echo site_url(); ?>/contact/">Contact</a></li>
            </ul>
            <?php if (has_nav_menu('header-menu')): ?>
                <nav class="menu menu--mobile">
                    <?php wp_nav_menu(['theme_location' => 'header-menu']); ?>
                </nav>
            <?php endif; ?>
        </div>
    </div>
	<header id="site-header" class="content--white">
        <div class="container">
            <div class="header-left">
                <ul class="show-lap menu menu--main">
                    <li><a href="<?php echo site_url(); ?>/our-values/">Our Values</a></li>
                    <li><a href="<?php echo site_url(); ?>/news/">News</a></li>
                    <li><a href="<?php echo site_url(); ?>/contact/">Contact</a></li>
                </ul>
                <?php if (has_nav_menu('header-menu')): ?>
                    <nav class="menu menu--main">
                        <?php wp_nav_menu(['theme_location' => 'header-menu']); ?>
                    </nav>
                <?php endif; ?>
            </div>
            <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo CHILD_THEME_URL; ?>/assets/images/logo-strakt-health-black.svg" alt="Substrakt Health" width="184" height="61" /></a></div>
            <div class="header-right">
                <a class="hide-lap menu-trigger" href="<?php echo site_url(); ?>news/"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a>
                <a class="header-contact-email mailto" href="javascript:;">health__AT__substrakt__DOT__com</a>
            </div>
        </div>
	</header>
