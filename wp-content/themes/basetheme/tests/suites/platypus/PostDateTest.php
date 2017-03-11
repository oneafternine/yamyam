<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Post as Post;

/**
 * Tests for Platypus Post class date related methods
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusPostDateTest extends PHPUnit_Framework_TestCase {

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        FactoryGirl::resetAll();
        Substrakt\Fakes\Fake::truncate();
        $this->date = '2016:12:26 12:00:00';
        $this->post = new Post(FactoryGirl::create('Post', ['date' => $this->date]));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_date() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'date'));
    }

    /**
     * By default the date method should return the date formatted
     * according to the format option set in the admin
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_date_method_returns_expected_string() {
        $date = new DateTime($this->date);
        $string = $date->format(get_option('date_format'));
        $this->assertEquals($string, $this->post->date());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_date_method_with_format_param_returns_expected_string() {
        $date = new DateTime($this->date);
        $string = $date->format('Y-m-d H:i:s');
        $this->assertEquals($string, $this->post->date('Y-m-d H:i:s'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_date_gmt() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'date_gmt'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_time() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'time'));
    }

    /**
     * By default the time method should return the time formatted
     * according to the format option set in the admin
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_time_method_returns_expected_string() {
        $time = new DateTime($this->date);
        $string = $time->format(get_option('time_format'));
        $this->assertEquals($string, $this->post->time());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_time_method_with_format_param_returns_expected_string() {
        $time = new DateTime($this->date);
        $string = $time->format('H:i.s');
        $this->assertEquals($string, $this->post->time('H:i.s'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_class_responds_to_time_gmt() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Post', 'time_gmt'));
    }

}
