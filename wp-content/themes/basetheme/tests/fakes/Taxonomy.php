<?php

namespace Substrakt\Fakes;

/**
 * Fake taxonomy for running tests with
 * @author Stuart Maynes stu@substrakt.com
 */
class Taxonomy extends Fake {

    public function save() {
        return true;
    }

    public function map() {
        return [];
    }

}
