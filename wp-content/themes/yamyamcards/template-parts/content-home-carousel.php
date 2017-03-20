<?php
/**
 * Template part for the homepage featured carousel
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yamyamcards
 */

?>

<section class="c-home-carousel">
    <div class="o-container">
        <?php if( have_rows('carousel_item') ): ?>
            <div class="owl-carousel owl-theme">
            <?php while ( have_rows('carousel_item') ) : the_row(); ?>
                <div>
                    <a href="<?php the_sub_field('carousel_url'); ?>">
                        <img src="<?php the_sub_field('carousel_image'); ?>" title="<?php the_sub_field('carousel_title'); ?>">
                    </a>
                </div>
            <?php endwhile; ?>
            </div>
        <?php else: ?>
        <?php endif; ?>
    </div>
</section>
