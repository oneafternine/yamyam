<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yamyamcards
 */

?>

	</main><!-- #content -->

    <?php get_template_part( 'template-parts/content', 'newsletter-signup' ); ?>
    <footer id="c-site-footer">
        <div class="o-container">
            <div class="c-terms">
                <?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_class' => 'c-menu-footer' ) ); ?>
                <span class="terms__credit">A <a target="_blank" href="http://oneafternine.com">oneafternine</a> project powered by woocommerce</span>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>
