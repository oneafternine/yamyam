<?php

namespace Substrakt\Fakes;

/**
 * Fake term for running tests with
 * @author Stuart Maynes stu@substrakt.com
 */
class Term extends Fake {

    public function save() {
        $this->create_taxonomy($this->taxonomy);
        $term = wp_insert_term($this->name, $this->taxonomy, [
            'description' => $this->description,
            'slug'        => $this->slug,
            'parent'      => $this->parent
        ]);

        if (is_array($term) && isset($term['term_id'])) {
            $this->ID = $this->term_id = $term['term_id'];
            return !!$this->ID;
        }

        return false;
    }

    public function map() {
        return [
            'group'       => 'term_group',
            'taxonomy_id' => 'term_taxonomy_id'
        ];
    }

}
