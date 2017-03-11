<?php

/**
 * Tests for Platypus NullObject class
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusNullObjectTest extends PHPUnit_Framework_TestCase {

    public function test_platypus_nullobject_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\NullObject'));
    }

    public function test_all_methods_are_callable() {
        $this->assertTrue(class_exists('Substrakt\Platypus\NullObject'));
    }

    public function test_all_propperties_are_accessible() {

    }

}
