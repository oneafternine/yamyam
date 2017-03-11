<?php

namespace Substrakt\Fakes;

/**
 * Fake user for running tests with
 * @author Stuart Maynes stu@substrakt.com
 */
class User extends Fake {

    public function save() {
        $attributes = $this->attributes();
        $this->ID = wp_insert_user($attributes);
        if ($this->ID && ($user = get_userdata($this->ID))) {
            $this->password = $this->user_pass = $user->user_pass;
        }
        return $this->ID;
    }

    public function map() {
        return [
            'email'        => 'user_email',
            'username'     => 'user_login',
            'nicename'     => 'user_nicename',
            'password'     => 'user_pass',
            'registered'   => 'user_registered',
            'url'          => 'user_url',
        ];
    }
}
