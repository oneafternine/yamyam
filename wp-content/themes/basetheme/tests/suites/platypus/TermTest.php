<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Post as Post;
use Substrakt\Platypus\Term as Term;

/**
 * Tests for Post class
 */
class TermPost extends PHPUnit_Framework_TestCase {

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
    public function test_platypus_term_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\Term'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_count_method_return_expected() {
        $factory = FactoryGirl::create('Term');
        for ($i = 0; $i < rand(1, 5); $i++) {
            FactoryGirl::resetAll();
            FactoryGirl::create('Post', ['categories' => $factory->name]);
        }
        $wpterm = get_term($factory->ID, 'category');
        $term = new Term($wpterm);
        $this->assertEquals($wpterm->count, $term->count());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_term_responds_to_description() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'description'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_description_method_returns_expected() {
        $factory = FactoryGirl::create('Term', ['description' => 'A little description']);
        $term = new Term($factory);
        $this->assertEquals('A little description', $term->description());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_term_responds_to_ID() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'ID'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_ID_method_return_expected() {
        $factory = FactoryGirl::create('Term');
        $term = new Term($factory);
        $this->assertEquals($factory->term_id, $term->ID());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_term_responds_to_name() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'name'));
    }


    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_name_method_return_expected() {
        $factory = FactoryGirl::create('Term', ['name' => 'Foo']);
        $term = new Term($factory);
        $this->assertEquals('Foo', $term->name());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_parent_method_return_expected() {
        $parent = FactoryGirl::create('Term', ['name' => 'Parent']);
        $factory = FactoryGirl::create('Term', ['parent' => [$parent->ID], 'name' => 'child']);
        $term = new Term($factory);
        $this->assertInstanceOf('Substrakt\Platypus\Term', $term->parent());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_parent_method_return_expected_when_no_parent() {
        $factory = FactoryGirl::create('Term');
        $term = new Term($factory);
        $this->assertInstanceOf('Substrakt\Platypus\NullObject', $term->parent());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_term_responds_to_slug() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'slug'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_slug_method_return_expected() {
        $factory = FactoryGirl::create('Term');
        $term = new Term($factory);
        $this->assertEquals($factory->slug, $term->slug());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_term_responds_to_taxonomy() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'taxonomy'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_taxonomy_method_return_expected() {
        $factory = FactoryGirl::create('Term', ['name' => 'Bar', 'taxonomy' => 'Classification']);
        $term = new Term($factory);
        $this->assertInstanceOf('Substrakt\Platypus\Taxonomy', $term->taxonomy());
    }

    /**
     * Title is an alias to name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_term_responds_to_title() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'title'));
    }

    /**
     * Title is an alias to name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_title_method_return_expected() {
        $factory = FactoryGirl::create('Term', ['name' => 'Bar']);
        $term = new Term($factory);
        $this->assertEquals('Bar', $term->title());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_term_responds_to_permalink() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Term', 'permalink'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_permalink_method_return_expected() {
        $factory = FactoryGirl::create('Term');
        $term = new Term($factory);
        $this->assertEquals(get_term_link($factory), $term->permalink());
    }

    /**
     * For when the term is valid
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_permalink_method_does_not_return_an_empty_string() {
        $factory = FactoryGirl::create('Term');
        $term = new Term($factory);
        $this->assertNotEquals('', trim($term->permalink()));
    }

}
