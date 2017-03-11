<?php get_header(); ?>

<main id="site-content" class="front-page">

    <div class="hero--single content--white">
        <div class="container row">
            <h1 class="page-title">Page Not Found</h1>
        </div>
    </div>

    <div class="content--white">
        <div class="container row">
            <article class="article-main">
                <div class="body-copy max-800">
                    <p>We're sorry, but we can't find the page you're looking for.</p>
                    <p>Maybe the URL has been mistyped, or the page you were looking for has been moved or deleted.</p>
                </div>
            </article>
            <footer class="article-footer">
                <a class="back" href="<?php echo site_url(); ?>">Home</a>
            </footer>
        </div>
    </div>
</main>

<?php get_footer(); ?>
