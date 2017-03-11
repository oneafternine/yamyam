<?php

use FactoryGirl\Factory as FactoryGirl;
use Substrakt\Platypus\Comment as Comment;
use Substrakt\Platypus\User as User;
use Substrakt\Platypus\Post as Post;

/**
 * Tests for Platypus Comment class comment
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class PlatypusCommentTest extends PHPUnit_Framework_TestCase {

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function setUp() {
        FactoryGirl::resetAll();
        Substrakt\Fakes\Fake::truncate();
        $factory = FactoryGirl::create('Post');
        $this->post = new Post(get_post($factory->ID));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
     */
    public function test_platypus_comment_is_defined() {
        $this->assertTrue(class_exists('Substrakt\Platypus\Comment'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_agent() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'agent'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_agent_method_returns_expected_instance() {
        $factory = FactoryGirl::create('comment', ['agent' => 'webkit']);
        $comment = new Comment($factory);
        $this->assertEquals('webkit', $comment->agent());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_author() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'author'));
    }

    /**
     * The author method should return an instance of Substrakt\Platypus\User by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_author_method_returns_expected_instance() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertInstanceOf('Substrakt\Platypus\Author', $comment->author());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_children() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'children'));
    }

    /**
     * The children method should return an empty array when no children
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_children_method_returns_expected_instance() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertEmpty($comment->children());
    }

    /**
     * The children method should return an array of children object instance of
     * Substrakt\Platypus\Comment when the comment has children/replys
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_children_method_returns_expected_instance_when_child() {
        $parent = FactoryGirl::create('comment', ['post' => $this->post]);
        $child = FactoryGirl::create('comment', ['post' => $this->post, 'parent' => $parent->ID]);
        $comment = new Comment($parent);
        $this->assertContainsOnlyInstancesOf('Substrakt\Platypus\Comment', $comment->children());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_content() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'content'));
    }

    /**
     * Trim is used on the content to remove newline added by WordPress
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_post_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment', ['content' => 'Lorem ipsum']);
        $comment = new Comment($factory);
        $this->assertEquals('<p>Lorem ipsum</p>', trim($comment->content()));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_is_approved() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'is_approved'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_is_approved_method_returns_expected_boolean() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'approved' => true]);
        $comment = new Comment($factory);
        $this->assertTrue($comment->is_approved());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_is_approved_method_returns_expected_boolean_when_not_approved() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'approved' => false]);
        $comment = new Comment($factory);
        $this->assertFalse($comment->is_approved());
    }

    /**
     * Comment has been marked as spam
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_is_approved_method_returns_expected_boolean_when_spam() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'approved' => 'spam']);
        $comment = new Comment($factory);
        $this->assertFalse($comment->is_approved());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_is_spam() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'is_spam'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_is_spam_method_returns_expected_boolean() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'approved' => 'spam']);
        $comment = new Comment($factory);
        $this->assertTrue($comment->is_spam());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_is_spam_method_returns_expected_boolean_when_not_approved() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'approved' => false]);
        $comment = new Comment($factory);
        $this->assertFalse($comment->is_spam());
    }

    /**
     * Comment has been marked as spam
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_is_spam_method_returns_expected_boolean_when_appraoved() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'approved' => true]);
        $comment = new Comment($factory);
        $this->assertFalse($comment->is_spam());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_karma() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'karma'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_karma_method_returns_expected_integer() {
        $factory = FactoryGirl::create('comment', ['karma' => 1]);
        $comment = new Comment($factory);
        $this->assertEquals(1, $comment->karma());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_parent() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'parent'));
    }

    /**
     * The parent method should return an instance of Substrakt\Platypus\NullObject
     * when the comment is a top level comment
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_parent_method_returns_expected_instance() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertInstanceOf('Substrakt\Platypus\NullObject', $comment->parent());
    }

    /**
     * The parent method should return an instance of Substrakt\Platypus\Comment
     * when the comment is a child/reply comment
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_parent_method_returns_expected_instance_when_child() {
        $parent = new Comment(FactoryGirl::create('comment', ['post' => $this->post]));
        $factory = FactoryGirl::create('comment', ['post' => $this->post, 'parent' => $parent]);
        $comment = new Comment($factory);
        $this->assertInstanceOf('Substrakt\Platypus\Comment', $comment->parent());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_post() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'post'));
    }

    /**
     * The post method should return an instance of Substrakt\Platypus\Post by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_post_method_returns_expected_instance() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertInstanceOf('Substrakt\Platypus\Post', $comment->post());
    }

    /**
     * The post method should return the post the comment was attached to
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_post_method_returns_expected_post() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertEquals($this->post->ID(), $comment->post()->ID());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_type() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'type'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_type_method_returns_expected_string() {
        $factory = FactoryGirl::create('comment');
        $comment = new Comment($factory);
        $this->assertEquals('comment', $comment->type());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_type_method_returns_expected_string_when_pingback() {
        $factory = FactoryGirl::create('comment', ['type' => 'pingback']);
        $comment = new Comment($factory);
        $this->assertEquals('pingback', $comment->type());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_type_method_returns_expected_string_when_trackback() {
        $factory = FactoryGirl::create('comment', ['type' => 'trackback']);
        $comment = new Comment($factory);
        $this->assertEquals('trackback', $comment->type());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_user() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'user'));
    }

    /**
     * The post method should return an instance of Substrakt\Platypus\Post by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_user_method_returns_expected_instance() {
        $user = new User(FactoryGirl::create('User'));
        $factory = FactoryGirl::create('comment', ['user' => $user]);
        $comment = new Comment($factory);
        $this->assertInstanceOf('Substrakt\Platypus\User', $comment->user());
    }

    /**
     * The author method should return an instance of Substrakt\Platypus\User by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_user_method_returns_expected_instance_when_no_user() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertInstanceOf('Substrakt\Platypus\NullObject', $comment->user());
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_class_responds_to_by_user() {
        $this->assertTrue(method_exists('Substrakt\Platypus\Comment', 'by_user'));
    }

    /**
     * The author method should return an instance of Substrakt\Platypus\User by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_by_user_method_returns_expected_boolean_when_user() {
        $user = new User(FactoryGirl::create('User'));
        $factory = FactoryGirl::create('comment', ['user' => $user]);
        $comment = new Comment($factory);
        $this->assertTrue($comment->by_user());
    }

    /**
     * The author method should return an instance of Substrakt\Platypus\User by default
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function test_by_user_method_returns_expected_boolean_when_no_user() {
        $factory = FactoryGirl::create('comment', ['post' => $this->post]);
        $comment = new Comment($factory);
        $this->assertFalse($comment->by_user());
    }

}
