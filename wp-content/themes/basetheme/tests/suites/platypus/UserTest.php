<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Post as Post;
use Substrakt\Platypus\User as User;

/**
 * Tests for Platypus Post class
 * Tests concerning dates are located in ./PostDateTest.php
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusUserTest extends PHPUnit_Framework_TestCase {

    /**
     * WordPress doesn't allow users with the same email addresss
     * to register. Truncating the database will fix that.
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        FactoryGirl::resetAll();
        Substrakt\Fakes\Fake::truncate();
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_platypus_comment_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\User'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_comments() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'comments'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_comments_method_returns_expected_instance() {
        $post = new Post(FactoryGirl::create('Post'));
        $user = new User(FactoryGirl::create('User'));
        FactoryGirl::create('Comment', ['post' => $post, 'user' => $user->ID()]);
        $this->assertContainsOnlyInstancesOf('Substrakt\Platypus\Comment', $user->comments());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_comments_method_returns_expected_empty_array() {
        $user = new User(FactoryGirl::create('User'));
        $comments = $user->comments();
        if (!empty($comments)) var_dump($comments, $user);
        $this->assertEmpty($comments, 'Comments method did not return an empty array');
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_description() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'description'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_description_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['description' => 'Description for user.']));
        $this->assertEquals('Description for user.', $user->description());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_display_name() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'display_name'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_display_name_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['display_name' => 'Witty Display Name']));
        $this->assertEquals('Witty Display Name', $user->display_name());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_email() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'email'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_email_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['email' => 'foobaz@example.com']));
        $this->assertEquals('foobaz@example.com', $user->email());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_first_name() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'first_name'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_first_name_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['first_name' => 'Foobaz']));
        $this->assertEquals('Foobaz', $user->first_name());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_ID() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'ID'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_ID_method_returns_expected_string() {
        $factory = FactoryGirl::create('User');
        $user = new User($factory);
        $this->assertEquals($factory->ID, $user->ID());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_last_name() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'last_name'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_last_name_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['last_name' => 'foofoofoo']));
        $this->assertEquals('foofoofoo', $user->last_name());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_username() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'username'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_username_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['username' => 'foobert']));
        $this->assertEquals('foobert', $user->username());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_nicename() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'nicename'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_nicename_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['nicename' => 'bertfoobaz']));
        $this->assertEquals('bertfoobaz', $user->nicename());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_nickname() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'nickname'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_nickname_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['nickname' => 'nicolas-name']));
        $this->assertEquals('nicolas-name', $user->nickname());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_password() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'password'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_password_method_returns_expected_string() {
        $factory = FactoryGirl::create('User', ['password' => 'passw0rd']);
        $user = new User($factory);
        $this->assertEquals($factory->password, $user->password());
        $this->assertNotEquals('passw0rd', $user->password());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_posts() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'posts'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_posts_method_returns_expected_instance() {
        $user = new User(FactoryGirl::create('User'));
        $post = new Post(FactoryGirl::create('Post', ['user' => $user]));
        $this->assertContainsOnlyInstancesOf('Substrakt\Platypus\Post', $user->posts());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_posts_method_returns_expected_empty_array() {
        $user = new User(FactoryGirl::create('User'));
        $this->assertEmpty($user->posts());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_registered() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'registered'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_registered_method_returns_expected_instance() {
        $user = new User(FactoryGirl::create('User'));
        $this->isInstanceOf('DateTime', $user->registered());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_rich_editing() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'rich_editing'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_rich_editing_method_returns_expected_instance() {
        $user = new User(FactoryGirl::create('User', ['rich_editing' => true]));
        $this->assertTrue($user->rich_editing());

        $user = new User(FactoryGirl::create('User', ['rich_editing' => false]));
        $this->assertFalse($user->rich_editing());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_role() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'role'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_role_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['role' => 'admin']));
        $this->assertEquals('admin', $user->role());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_url() {
        $this->assertTrue(method_exists('Substrakt\Platypus\User', 'url'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_url_method_returns_expected_string() {
        $user = new User(FactoryGirl::create('User', ['url' => 'http://example.com']));
        $this->assertEquals('http://example.com', $user->url());
    }
}
