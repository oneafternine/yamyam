<?php

use \Substrakt\Platypus\NullObject as NullObject;

$health = new NullObject;

/**
 * @codeCoverageIgnore
 */
add_action('wp', function() {
    global $post, $health, $news;

    if (is_front_page() || is_page() || is_404()) {
        $health = new \Substrakt\Health\Page($post);
    }

    if (is_single()) {
        $news = new \Substrakt\Health\Post($post);
    }

});
