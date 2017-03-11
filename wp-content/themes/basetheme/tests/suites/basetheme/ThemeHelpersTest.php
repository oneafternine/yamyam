<?php
/**
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite basetheme
*/
class ThemeHelpersTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        global $post;
        $this->post = $post = get_posts(['posts_per_page' => 1, 'order' => 'rand'])[0];
    }

    public function testIDwithoutParam() {
        $this->assertEquals($this->post->ID, ID());
    }

    public function testIDwithParam() {
        $this->assertEquals($this->post->ID, ID($this->post->ID));
    }
}
