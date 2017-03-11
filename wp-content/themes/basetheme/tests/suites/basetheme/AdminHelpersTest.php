<?php
/**
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite basetheme
*/
class AdminHelpersTest extends PHPUnit_Framework_TestCase {

    public function testIsSubstraktCoUk() {
        $this->assertTrue(is_substrakt('stu@substrakt.co.uk'));
    }

    public function testIsSubstraktCom() {
        $this->assertTrue(is_substrakt('stu@substrakt.com'));
    }

    public function testIsNotSubstrakt() {
        $this->assertFalse(is_substrakt('stu@example.co.uk'));
    }
}
