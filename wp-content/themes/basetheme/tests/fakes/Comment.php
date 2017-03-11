<?php

namespace Substrakt\Fakes;

/**
 * Fake comment for running tests with
 * @author Stuart Maynes stu@substrakt.com
 */
class Comment extends Fake {

    public function save() {
        $this->overloading();
        $attributes = $this->attributes();
        return ($this->ID = wp_insert_comment($attributes));
    }

    public function map() {
        return [
            'agent'        => 'comment_agent',
            'approved'     => 'comment_approved',
            'author'       => 'comment_author',
            'author_email' => 'comment_author_email',
            'author_IP'    => 'comment_author_IP',
            'author_url'   => 'comment_author_url',
            'content'      => 'comment_content',
            'date'         => 'comment_date',
            'date_gmt'     => 'comment_date_gmt',
            'karma'        => 'comment_karma',
            'parent'       => 'comment_parent',
            'post'         => 'comment_post_ID',
            'type'         => 'comment_type',
            'user'         => 'user_id',
        ];
    }

    private function overloading() {
        if (is_object($this->post)) {
            $this->post = $this->post->ID();
        }

        if (is_numeric($this->user)) {
            $this->user = (integer) $this->user;

            if ($user = get_userdata($this->user)) {
                $this->author       = $user->first_name . ' ' . $user->last_name;
                $this->author_email = $user->get('email');
                $this->author_url   = $user->get('url');
            }
        }

        if (is_object($this->user)) {
            $this->author       = $this->user->display_name();
            $this->author_email = $this->user->email();
            $this->author_url   = $this->user->url();
            $this->user         = $this->user->ID();
        }

        if (is_object($this->parent)) {
            $this->parent = $this->parent->ID();
        }

        if ($this->approved === true) {
            $this->approved = 1;
        }

        if ($this->approved === false) {
            $this->approved = 0;
        }
    }

}
