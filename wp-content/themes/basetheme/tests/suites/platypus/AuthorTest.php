<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Comment as Comment;
use Substrakt\Platypus\Post as Post;

/**
 * Tests for Platypus Post class
 * Tests concerning dates are located in ./PostDateTest.php
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusAuthorTest extends PHPUnit_Framework_TestCase {

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        FactoryGirl::resetAll();
        Substrakt\Fakes\Fake::truncate();
        $factory = FactoryGirl::create('Post');
        $this->post = new Post(get_post($factory->ID));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_platypus_author_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\Author'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_agent() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Author', 'agent'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_agent_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'agent' => 'agent-string-foo-bar']);
        $comment = new Comment($factory);
        $this->assertEquals('agent-string-foo-bar', $comment->author()->agent());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_email() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Author', 'email'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_email_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'author_email' => 'foo@example.com']);
        $comment = new Comment($factory);
        $this->assertEquals('foo@example.com', $comment->author()->email());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_IP() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Author', 'IP'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_IP_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'author_IP' => '213.123.191.198']);
        $comment = new Comment($factory);
        $this->assertEquals('213.123.191.198', $comment->author()->IP());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_name() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Author', 'name'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_name_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'author' => 'Foobar Barfoo']);
        $comment = new Comment($factory);
        $this->assertEquals('Foobar Barfoo', $comment->author()->name());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_URL() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Author', 'url'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_URL_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'author_url' => 'http://example.com']);
        $comment = new Comment($factory);
        $this->assertEquals('http://example.com', $comment->author()->url());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_website() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Author', 'website'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_website_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'author_url' => 'http://example.com/again']);
        $comment = new Comment($factory);
        $this->assertEquals('http://example.com/again', $comment->author()->website());
    }
}
