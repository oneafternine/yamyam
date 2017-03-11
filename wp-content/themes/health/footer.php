	<footer id="site-footer">
        <div class="container">
            <div class="footer-left">
                <ul class="show-lap menu menu--footer">
                    <li><a href="<?php echo site_url(); ?>/our-values/">Our Values</a></li>
                    <li><a href="<?php echo site_url(); ?>/news/">News</a></li>
                    <li><a href="<?php echo site_url(); ?>/contact/">Contact</a></li>
                </ul>
                <?php if (has_nav_menu('footer-menu')): ?>
                    <nav>
                        <?php wp_nav_menu(['theme_location' => 'footer-menu']); ?>
                    </nav>
                <?php endif; ?>

            </div>
            <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo CHILD_THEME_URL; ?>/assets/images/logo-strakt-health-white.svg" alt="Substrakt Health" width="184" height="61" /></a></div>
            <div class="footer-right">
                <a href="https://www.substrakt.com"><small>Visit substrakt.com</small></a>
                <small>&copy; Substrakt <?php echo date('Y') ?></small>
            </div>
        </div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
