<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Post as Post;

/**
 * Tests for Platypus Post class is_* methods
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusPostIsTest extends PHPUnit_Framework_TestCase {

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
    public function test_class_responds_to_is_draft() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'is_draft'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_draft_method_returns_expected_boolean() {
        $factory = FactoryGirl::create('Post', ['status' => 'publish']);
        $post = new Post($factory);
        $this->assertFalse($post->is_draft());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_draft_method_returns_expected_boolean_when_draft() {
        $factory = FactoryGirl::create('Post', ['status' => 'draft']);
        $post = new Post($factory);
        $this->assertTrue($post->is_draft());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_is_future() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'is_future'));
    }

    /**
     * Set the post date in the past
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_future_method_returns_expected_boolean() {
        $factory = FactoryGirl::create('Post', ['date' => '2015-01-01 00:00:00']);
        $post = new Post($factory);
        $this->assertFalse($post->is_future());
    }

    /**
     * Set the post date in the future
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_future_method_returns_expected_boolean_when_future() {
        $factory = FactoryGirl::create('Post', ['date' => '3000-01-01 00:00:00']);
        $post = new Post($factory);
        $this->assertTrue($post->is_future());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_is_private() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'is_private'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_private_method_returns_expected_boolean() {
        $factory = FactoryGirl::create('Post', ['status' => 'publish']);
        $post = new Post($factory);
        $this->assertFalse($post->is_private());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_private_method_returns_expected_boolean_when_private() {
        $factory = FactoryGirl::create('Post', ['status' => 'private']);
        $post = new Post($factory);
        $this->assertTrue($post->is_private());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_is_published() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'is_published'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_published_method_returns_expected_boolean() {
        $factory = FactoryGirl::create('Post', ['status' => 'draft']);
        $post = new Post($factory);
        $this->assertFalse($post->is_published());
    }

    /**
     * publish is what WordPress status uses for published
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_published_method_returns_expected_boolean_when_published() {
        $factory = FactoryGirl::create('Post', ['status' => 'publish']);
        $post = new Post($factory);
        $this->assertTrue($post->is_published());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_is_sticky() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'is_sticky'));
    }

    /**
     * Default is for posts not to be sticky
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_sticky_method_returns_expected_boolean_when_not_sticky() {
        $factory = FactoryGirl::create('Post', ['sticky' => false]);
        $post = new Post($factory);
        $this->assertFalse($post->is_sticky());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_is_sticky_method_returns_expected_boolean_when_sticky() {
        $factory = FactoryGirl::create('Post', ['sticky' => true]);
        $post = new Post($factory);
        $this->assertTrue($post->is_sticky());
    }
}
