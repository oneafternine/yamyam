<?php get_header(); ?>

<main id="site-content" class="front-page">

    <?php include CHILD_THEME_PATH . '/includes/post-masthead.php'; ?>

    <div class="content--white">
        <div class="container row">
            <article class="article-main">
                <div class="body-copy max-800">
                    <?php echo $news->content(); ?>
                </div>
                <?php if ($images = $news->related_images()): ?>
                    <div class="breakout-images max-1000">
                        <?php foreach ($images as $image): ?>
                            <figure class="img-container">
                                <img src="<?php echo $image['sizes']['large'] ?>" title="<?php echo $image['caption'] ?>" alt="<?php echo $image['caption'] ?>">
                            </figure>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </article>
            <footer class="article-footer">
                <a class="back" href="<?php echo site_url(); ?>/news/">Back</a>
            </footer>
        </div>
    </div>
    <?php if ($related = $news->related_stories()): ?>
        <div class="page-title-arrow content--white"><h2 class="arrow-title">Related</h2></div>
        <div class="content--green">
            <div class="container row">
                <ul class="list--default gutter-60 grid">
                    <?php foreach ($related as $i => $feature): ?>
                        <?php include CHILD_THEME_PATH . '/includes/news-item.php'; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
