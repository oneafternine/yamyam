<?php
/**
 * The template for displaying the homepage
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yamyamcards
 */

get_header(); ?>

    <?php get_template_part( 'template-parts/content', 'quick-info' ); ?>

    <?php get_template_part( 'template-parts/content', 'home-carousel' ); ?>

	<main class="site-main" role="main">
        <div class="o-container o-row">
            <div class="c-home-product-list">
                <?php
                while ( have_posts() ) : the_post();
                        the_content();
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'yamyamcards' ),
                            'after'  => '</div>',
                        ) );
                endwhile; // End of the loop.
                ?>
            </div>
        </div>
	</main><!-- #main -->

<?php
get_footer();
