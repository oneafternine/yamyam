<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class Comment extends Platypus {

    public function __construct($comment) {
        $this->wp = (object) $comment;
    }

    /**
     * @param null
     * @return string User agent for the comment
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function agent() {
        return $this->author()->agent();
    }

    /**
     * Returns instance of Substrakt\Platypus\User by default
     * @param $class Class to return a new instance of for author
     * @uses get_userdata To retrieve the user object
     * @return object Post author
    */
    public function author() {
        return new Author((object) [
            'comment_agent'        => $this->wp->comment_agent,
            'comment_author'       => $this->wp->comment_author,
            'comment_author_email' => $this->wp->comment_author_email,
            'comment_author_IP'    => $this->wp->comment_author_IP,
            'comment_author_url'   => $this->wp->comment_author_url
        ]);
    }

    /**
     * Return a boolean based on if the comment made by a registered user
     * @param null
     * @return boolean
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function by_user() {
        return !!$this->user()->ID();
    }

    /**
     * @param null
     * @return array Comment's children
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function children($params = []) {
        $comments = get_comments(array_merge($params, [
            'parent' => $this->ID()
        ]));
        return $this->to_object($comments, '\Substrakt\Platypus\Comment');
    }

    /**
     * @param null
     * @return string Comment content
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function content() {
        return apply_filters('the_content', $this->wp->comment_content);
    }

    /**
     * @param null
     * @return boolean Comment ID number
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function ID() {
        // var_dump($this->wp);
        return $this->wp->ID;
    }

    /**
     * @param null
     * @return boolean Is the comment approved
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_approved() {
        return $this->wp->comment_approved === 1;
    }

    /**
     * @param null
     * @return boolean Is the comment spam
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_spam() {
        return $this->wp->comment_approved === 'spam';
    }

    /**
     * @param null
     * @return boolean The comment's karma score
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function karma() {
        return $this->wp->comment_karma;
    }

    /**
     * Returns instance of Substrakt\Platypus\Comment is there is a parent
     * If no parent a NullObject is returned
     * @param null
     * @uses get_post To retrieve the comment's parent
     * @return object Comment parent or NullObject
    */
    public function parent() {
        if ($this->wp->comment_parent) {
            return new Comment(get_comment($this->wp->comment_parent));
        }
        return new NullObject;
    }

    /**
     * Returns instance of Substrakt\Platypus\Post by default
     * @param null
     * @uses get_post To retrieve the post object
     * @return object Post comment was attached to
    */
    public function post() {
        return new Post(get_post($this->wp->comment_post_ID));
    }

    /**
     * @param null
     * @return string Type of comment
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function type() {
        if ($this->wp->comment_type) {
            return $this->wp->comment_type;
        }
        return 'comment';
    }

    /**
     * Returns instance of Substrakt\Platypus\User by default
     * @param $class Class to return a new instance of for user
     * @uses get_user_data To retrieve the user object
     * @return object User comment was attached created by
    */
    public function user() {
        if ($this->wp->user_id) {
            return new User(get_userdata($this->wp->user_id));
        }
        return new NullObject;
    }
}
