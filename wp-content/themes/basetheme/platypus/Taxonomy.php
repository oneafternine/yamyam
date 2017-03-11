<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class Taxonomy extends Platypus {

    public $wp;

    public function __construct($taxonomy) {
        $this->wp = (object) $taxonomy;
    }

}
