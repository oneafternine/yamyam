<?php get_header(); ?>

	<main id="site-content" class="front-page">
        <div class="hero--feature content--white">
            <div class="container row">
                <div class="hero-copy body-copy max-700">
                    <?php echo $health->content(); ?>
                </div>
            </div>
        </div>
        <div class="page-title-arrow content--white"><h2 class="arrow-title">News</h2></div>
        <div class="content--green">
            <div class="container">
                <div class="row">
                    <ul class="list--default gutter-60 grid">

                        <?php if ($featured = $health->featured_stories()): ?>
                            <?php foreach ($featured as $i => $feature): ?>
                                <?php include CHILD_THEME_PATH . '/includes/news-item.php'; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
	</main>

<?php get_footer(); ?>
