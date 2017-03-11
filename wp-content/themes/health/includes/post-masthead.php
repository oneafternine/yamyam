<?php if ($masthead = $news->thumbnail()->url('1800x900')): ?>
    <div class="hero--single hero--single--image" style="background-image: url('<?php echo $masthead; ?>');">
        <div class="container row">
            <div class="hero-copy">
                <h1 class="page-title"><?php echo $news->title(); ?></h1>
                <div class="max-800">
                    <p class="intro"><?php echo $news->introduction(); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="hero--single content--white">
        <div class="container row">
            <h1 class="page-title"><?php echo $news->title(); ?></h1>
            <div class="max-800">
                <p class="intro"><?php echo $news->introduction(); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>
