<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class User extends Platypus {

    public $wp;

    public function __construct($user) {
        $this->wp = (object) $user;
    }

    /**
     * @param null
     * @return
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function comments($params = []) {
        $params = array_merge($params, [
            'post_author' => $this->ID()
        ]);
        return $this->to_object(get_comments($params), '\Substrakt\Platypus\Comment');
    }

    /**
     * @param null
     * @return string User's description
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function description() {
        return $this->wp->description;
    }

    /**
     * @param null
     * @return string User's chosen display name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function display_name() {
        return $this->wp->display_name;
    }

    /**
     * @param null
     * @return string User's email address
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function email() {
        return $this->wp->user_email;
    }

    /**
     * @param null
     * @return string User's first name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function first_name() {
        return $this->wp->first_name;
    }

    /**
     * @param null
     * @return integer User's ID
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function ID() {
        return $this->wp->ID;
    }

    /**
     * @param null
     * @return string User's last name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function last_name() {
        return $this->wp->last_name;
    }

    /**
     * @param null
     * @return string User's username
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function username() {
        return $this->wp->user_login;
    }

    /**
     * @param null
     * @return string User's nicename
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function nicename() {
        return $this->wp->user_nicename;
    }

    /**
     * @param null
     * @return string User's nickname
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function nickname() {
        return $this->wp->nickname;
    }

    /**
     * @param null
     * @return string User's password
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function password() {
        return $this->wp->user_pass;
    }

    /**
     * @param array $params
     * @return
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function posts($params = []) {
        $params = array_merge($params, [
            'author' => $this->ID()
        ]);
        return $this->query_to_object($params, 'Substrakt\Platypus\Post');
    }

    /**
     * @param null
     * @return string Date user registered
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function registered() {
        return $this->wp->user_registered;
    }

    /**
     * @param null
     * @return boolean Does user have rich editing
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function rich_editing() {
        return !!$this->wp->rich_editing;
    }

    /**
     * @param null
     * @return string User's role
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function role() {
        return $this->wp->role;
    }

    /**
     * @param null
     * @return string User's website address
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function url() {
        return $this->wp->user_url;
    }

}
