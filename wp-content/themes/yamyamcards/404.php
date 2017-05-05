<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package yamyamcards
 */

get_header(); ?>

    <main class="site-main" role="main">
        <div class="o-container o-row">
            <div class="o-max-800 o-block--centred">

    			<section class="error-404 not-found">
    				<header class="page-header">
    					<h1 class="page-title"><?php esc_html_e( 'Yam lost bab!', 'yamyamcards' ); ?></h1>
    				</header><!-- .page-header -->

    				<div class="page-content">

                        <p class="intro">It seems the page you're looking for doesn't exist, or you could have mistyped a url.</p>
                        <p>Head back to the <a href="/">Homepage</a> and try again.</p>

    				</div><!-- .page-content -->
    			</section><!-- .error-404 -->
            </div>
        </div>
	</main><!-- #main -->

<?php
get_footer();
