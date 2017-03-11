<?php

namespace Substrakt\Fakes;

/**
 * Fake attachment for running tests with
 * @author Stuart Maynes stu@substrakt.com
 */
class Attachment extends Fake {

    public function save() {
        return true;
    }

}
