<?php
/**
 * Template Name: Narrow Content
 * The template for displaying content in a narrow column in the middle of a page
 *
 * @package yamyamcards
 */

get_header(); ?>

	<main class="site-main" role="main">
        <div class="o-container o-row">
            <div class="o-max-800 o-block--centred">
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </div>
        </div>

	</main><!-- #main -->

<?php
get_footer();
