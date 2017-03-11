<?php get_header(); ?>

<main id="site-content" class="front-page">

    <?php include CHILD_THEME_PATH . '/includes/page-masthead.php'; ?>

    <div class="content--white">
        <div class="container row">
            <article class="article-main">
                <div class="body-copy max-800">
                    <?php echo $health->content(); ?>
                </div>
            </article>
        </div>
    </div>
</main>

<?php get_footer(); ?>
