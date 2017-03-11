<?php

use Substrakt\Platypus\Platypus as Platypus;

/**
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
*/
class PlatypusTest extends PHPUnit_Framework_TestCase {

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        Substrakt\Fakes\Fake::truncate();
    }

    public function test_platypus_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\Platypus'));
    }
}
