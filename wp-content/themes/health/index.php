<?php get_header(); ?>

	<main id="site-content" class="front-page">
        <div class="hero--default content--white">
            <div class="container row">
                <h1 class="page-title">News</h1>
            </div>
        </div>
        <div class="content--green">
            <div class="container">
                <div class="row">
                    <ul class="list--default gutter-60 grid">
                        <?php foreach (get_news() as $i => $story): ?>
                            <li class="list-item grid-item tablet-one-half">
                                <figure class="img-container<?php echo $story->fallback_image_class(); ?>">
                                    <a href="<?php echo $story->permalink(); ?>"><?php echo $story->featured_image(); ?></a>
                                </figure>
                                <h3 class="list-item-title"><a href="<?php echo $story->permalink(); ?>"><?php echo $story->title(); ?></a></h3>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pagination">
                    <?php echo pagination([
                        'slug'         => 'news',
                        'next_label'   => 'Older Stories',
                        'prev_label'   => 'Newer Stories',
                        'next_classes' => 'page-nav next',
                        'prev_classes' => 'page-nav prev'
                    ]); ?>
                </div>
            </div>
        </div>
	</main>

<?php get_footer(); ?>
