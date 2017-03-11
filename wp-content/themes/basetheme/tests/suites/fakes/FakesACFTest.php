<?php
/**
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite fakes
*/
use FactoryGirl\Factory as FactoryGirl;

class FakesACF extends PHPUnit_Framework_TestCase {

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        FactoryGirl::resetAll();
        Substrakt\Fakes\Fake::truncate();
    }

    public function acf($array) {
        return [
            'acf' => [
                'group_57aa445697fe7' => $array
            ]
        ];
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_data_can_be_saved_at_one_level() {
        $post = FactoryGirl::create('post', $this->acf(['grandchild' => 'foobar']));
        $this->assertEquals(get_field('grandchild', $post->ID), 'foobar');
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_data_can_be_saved_at_two_levels() {
        $post = FactoryGirl::create('post', $this->acf([
            'child' => [
                ['grandchild' => 'foobar'],
                ['grandchild' => 'barfoo'],
            ]
        ]));

        $data = get_field('child', $post->ID);

        $this->assertEquals(sizeof($data), 2);
        $this->assertEquals($data[0]['grandchild'], 'foobar');
        $this->assertEquals($data[1]['grandchild'], 'barfoo');
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_data_can_be_saved_at_three_levels() {
        $post = FactoryGirl::create('post', $this->acf([
            'parent' => [
                [
                    'child' => [
                        ['grandchild' => 'foobar'],
                        ['grandchild' => 'barfoo'],
                    ]
                ]
            ]
        ]));

        $data = get_field('parent', $post->ID);

        $this->assertEquals(sizeof($data), 1);
        $this->assertEquals($data[0]['child'][0]['grandchild'], 'foobar');
        $this->assertEquals($data[0]['child'][1]['grandchild'], 'barfoo');
    }

}
