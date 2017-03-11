<?php

namespace Substrakt\Platypus;

/**
 * A NullObject is very predictable
 * and has no side effects: it does nothing.
 * @link <https://en.wikipedia.org/wiki/Null_Object_pattern#php>
 * @author Stuart Maynes <stu@substrakt.com>
*/
class NullObject extends Platypus {

    public function __get($key) {
        return '';
    }

    public function __call($a, $b) {
        return '';
    }

}
