<?php if ($masthead = $health->thumbnail()->url('1800x900')): ?>
    <div class="hero--single hero--single--image" style="background-image: url('<?php echo $masthead; ?>');">
        <div class="container row">
            <div class="hero-copy">
                <h1 class="page-title"><?php echo $health->title(); ?></h1>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="hero--single content--white">
        <div class="container row">
            <h1 class="page-title"><?php echo $health->title(); ?></h1>
        </div>
    </div>
<?php endif; ?>
