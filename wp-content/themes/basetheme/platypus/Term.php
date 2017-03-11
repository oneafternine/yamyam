<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class Term extends Platypus {

    public $wp;

    /**
     *
     * @param $term WordPress term object
    */
    public function __construct($term) {
        $this->wp = $term;
    }

    /**
     * Return the number of posts the term has been assigned to
     * @return integer
    */
    public function count() {
        return $this->wp->count;
    }

    /**
     * Return the description of the term
     * @return string Term description
    */
    public function description() {
        return $this->wp->description;
    }

    /**
     * Return the ID number of the term
     * @return string Term ID
    */
    public function ID() {
        return $this->wp->term_id;
    }

    /**
     * Return the term name
     * @return string Term name
    */
    public function name() {
        return $this->wp->name;
    }

    /**
     * Return the permalink for the term
     * @return object Term parent
    */
    public function parent() {
        if ($this->wp->parent) {
            return new Term(get_term($this->wp->parent, $this->wp->taxonomy));
        }
        return new NullObject();
    }

    /**
     * Return the permalink for the term
     * @return string Term permalink
    */
    public function permalink() {
        return get_term_link($this->wp);
    }

    /**
     * Return slug for term
     * @return string Term slug
    */
    public function slug() {
        return $this->wp->slug;
    }

    /**
     * An alias to name method
     * @uses name
     * @return string Term name
    */
    public function taxonomy() {
        return new Taxonomy(get_taxonomy($this->wp->taxonomy));
    }

    /**
     * An alias to name method
     * @uses name
     * @return string Term name
    */
    public function title() {
        return $this->name();
    }
}
