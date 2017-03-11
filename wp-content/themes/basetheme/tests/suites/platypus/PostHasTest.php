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
class PlatypusPostHasTest extends PHPUnit_Framework_TestCase {

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
    public function test_platypus_has_term_is_defined() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'has_term'));
    }

    /**
    * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_has_term_method_returns_true_when_category_term_is_not_assigned() {
        $post = new Post(FactoryGirl::create('Post'));
        $this->assertFalse($post->has_term('Foobarfoo'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_has_term_method_returns_true_when_category_term_is_assigned() {
        $post = new Post(FactoryGirl::create('Post', ['categories' => 'Foobar']));
        $this->assertTrue($post->has_term('Foobar'));
    }

    /**
     * Use ['taxonomies' => ['genre' => 'Foobar']] so we know it's a taxomony and not meta data
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_has_term_method_returns_true_when_taxonomy_term_is_assigned() {
        $post = new Post(FactoryGirl::create('Post', ['taxonomies' => ['genre' => 'Foobar']]));
        $this->assertTrue($post->has_term('Foobar', 'genre'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_has_term_method_returns_true_when_multiple_taxonomy_terms_are_assigned() {
        $post = new Post(FactoryGirl::create('Post', [
            'taxonomies' => [
                'genre' => ['Foobar', 'Boofar'],
                'class' => ['Boobar', 'Foofar']
            ]
        ]));
        $this->assertTrue($post->has_term('Boobar', 'class'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_has_term_method_returns_true_when_multiple_taxonomy_terms_are_assigned_with_similar_names() {
        $post = new Post(FactoryGirl::create('Post', [
            'taxonomies' => [
                'genre' => ['Boobar', 'Foofar'],
                'class' => ['Boobar', 'Foofar']
            ]
        ]));
        $this->assertTrue($post->has_term('Boobar', 'class'));
    }

}
