<?php

namespace Substrakt\Platypus;

/**
 * This class is for comment authors
 * For post authors use Substrakt\Platypus\User
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class Author extends Platypus {

    public $wp;

    public function __construct($author) {
        $this->wp = (object) $author;
    }

    /**
     * @param null
     * @return string Comment author User Agent
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function agent() {
        return $this->wp->comment_agent;
    }

    /**
     * @param null
     * @return string Comment author email address
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function email() {
        return $this->wp->comment_author_email;
    }

    /**
     * @param null
     * @return string Comment author IP addrress
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function IP() {
        return $this->wp->comment_author_IP;
    }

    /**
     * @param null
     * @return string Comment author name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function name() {
        return $this->wp->comment_author;
    }

    /**
     * @param null
     * @return string Comment author website URL
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function url() {
        return $this->wp->comment_author_url;
    }

    /**
     * Alias for the URL method
     * @param null
     * @return string Comment author website URL
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function website() {
        return $this->URL();
    }

}
