<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Post as Post;

/**
 * Tests for Platypus Post class
 * Tests concerning dates are located in ./PostDateTest.php
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusPostTest extends PHPUnit_Framework_TestCase {

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
    public function test_platypus_post_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\Post'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_author() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'author'));
    }

    /**
     * The author method should return an instance of Substrakt\Platypus\User by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_author_method_returns_expected_instance() {
        $factory = FactoryGirl::create('Post');
        $post = new Post($factory);
        $this->assertInstanceOf('Substrakt\Platypus\User', $post->author());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_content() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'content'));
    }

    /**
     * trim is to remove the whitespace WordPress adds after the p tag
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_content_method_returns_expected_string() {
        $factory = FactoryGirl::create('Post', ['content' => 'Lorem dolor sit amit']);
        $post = new Post($factory);
        $this->assertEquals('<p>Lorem dolor sit amit</p>', trim($post->content()));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_excerpt() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'excerpt'));
    }

    /**
     * trim is to remove the whitespace WordPress adds after the p tag
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_excerpt_method_returns_expected_string() {
        $factory = FactoryGirl::create('Post', ['excerpt' => 'An example of when the excerpt has been explicitly set.']);
        $post = new Post($factory);
        $this->assertEquals('<p>An example of when the excerpt has been explicitly set.</p>', trim($post->excerpt()));
    }

    /**
     * Pass an empty string to stop FactoryGirl generating one.
     * The excerpt should then be generated based on the content.
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_excerpt_method_returns_expected_generated_excerpt_string() {
        $factory = FactoryGirl::create('Post', ['excerpt' => null, 'content' => 'For the excerpt']);
        $post = new Post($factory);
        $this->assertStringStartsWith('<p>For the excerpt', $post->excerpt());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_ID() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'ID'));
    }

    /**
     * Post ID can not be passed as an attribute to the factory,
     * but is returned by WordPress on post save.
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_ID_method_returns_expected_integer() {
        $factory = FactoryGirl::create('Post');
        $post = new Post($factory);
        $this->assertEquals($factory->ID, $post->ID());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_parent() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'parent'));
    }

    /**
     * A parent hasn't been set so an instance of NullObject
     * No parent means it's a top level post
     * should be returned by defualt
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_parent_method_returns_expected_instance() {
        $factory = FactoryGirl::create('Post');
        $post = new Post($factory);
        $this->assertInstanceOf('Substrakt\Platypus\NullObject', $post->parent());
    }

    /**
     * When a parent is set an instance of post should be returned
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_parent_method_returns_expected_instance_when_parent() {
        $parent = new Post(FactoryGirl::create('Post'));
        $child = FactoryGirl::create('Post', ['parent' => $parent]);
        $post = new Post($child);
        $this->assertInstanceOf('Substrakt\Platypus\Post', $post->parent());
    }

    /**
     * The parent method should return an instance of the passed parameter $class
     * @example Performance returns a Production
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_parent_method_with_param_returns_expected_instance_when_parent() {
        $parent = new Post(FactoryGirl::create('Post'));
        $child = FactoryGirl::create('Post', ['parent' => $parent]);
        $post = new Post($child);
        $this->assertInstanceOf('\stdClass', $post->parent('\stdClass'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_permalink() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'permalink'));
    }

    /**
     * To set the permalink we have to set the posts name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_permalink_method_returns_expected_string() {
        $factory = FactoryGirl::create('Post', ['name' => 'foo-bar']);
        $post = new Post($factory);
        $this->assertStringEndsWith('/foo-bar/', $post->permalink());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_post_responds_to_status() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'status'));
    }

    /**
     * Factory default status is publish
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_status_method_return_expected_string() {
        $factory = FactoryGirl::Create('Post', ['status' => 'draft']);
        $post = new Post($factory);
        $this->assertEquals('draft', $post->status());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_post_responds_to_title() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'title'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_title_method_return_expected_string() {
        $factory = FactoryGirl::Create('Post', ['title' => 'Foo Bar']);
        $post = new Post($factory);
        $this->assertEquals('Foo Bar', $post->title());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_post_responds_to_type() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'type'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_type_method_return_expected_string() {
        $factory = FactoryGirl::Create('Post', ['type' => 'foobar']);
        $post = new Post($factory);
        $this->assertEquals('foobar', $post->type());
    }
}
