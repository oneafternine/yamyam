<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Post as Post;

/**
 * Tests for Platypus Post class comment related methods
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusPostCommentsTest extends PHPUnit_Framework_TestCase {

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        FactoryGirl::resetAll();
        Substrakt\Fakes\Fake::truncate();
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_comments() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'comments'));
    }

    /**
     * Comments method should return a empty array when there are no comments
     * attached to the post
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_comments_method_returns_an_array() {
        $post = new Post(FactoryGirl::create('Post'));
        $comments = $post->comments();
        $this->assertTrue(is_array($comments) && empty($comments));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_comments_method_returns_an_array_when_comments() {
        $post = new Post(FactoryGirl::create('Post'));
        FactoryGirl::create('Comment', ['post' => $post]);
        $comments = $post->comments();
        $this->assertTrue(is_array($comments) && !empty($comments));
    }

}
