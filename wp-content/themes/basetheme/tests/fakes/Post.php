<?php

namespace Substrakt\Fakes;

/**
 * Fake post for running tests with
 * @author Stuart Maynes stu@substrakt.com
 */
class Post extends Fake {

    public function save() {
        $this->overloading();
        $this->ID = wp_insert_post($this->attributes());

        if ($this->ID) {
            $this->set_sticky();
            $this->set_terms();
            $this->save_acf();
        }

        return $this->ID;
    }

    public function map() {
        return [
            'author'     => 'post_author',
            'categories' => 'post_category',
            'content'    => 'post_content',
            'date'       => 'post_date',
            'date_gmt'   => 'post_date_gmt',
            'excerpt'    => 'post_excerpt',
            'name'       => 'post_name',
            'parent'     => 'post_parent',
            'status'     => 'post_status',
            'title'      => 'post_title',
            'type'       => 'post_type',
            'meta'       => 'meta_input'
        ];
    }

    private function set_sticky() {
        return $this->sticky ? stick_post($this->ID) : false;
    }

    private function set_terms() {
        foreach ($this->taxonomies as $taxonomy => $terms) {
            $this->create_taxonomy($taxonomy, $this->post_type);
            wp_set_object_terms($this->ID, $terms, $taxonomy, false);
        }
        return true;
    }

    private function meta() {
        $meta = [];
        $excluded = $this->excluded_from_meta();

        foreach (get_object_vars($this) as $property => $value) {
            if (! in_array($property, $excluded)) {
                $meta[$property] = $value;
            }
        }
        return $meta;
    }

    private function excluded_from_meta() {
        $map = $this->map();

        return array_merge(
            ['acf', 'sticky', 'taxonomies'],
            array_values($map),
            array_keys($map)
        );
    }

    private function overloading() {
        if (is_object($this->parent)) {
            $this->parent = $this->parent->ID();
        }

        if (is_object($this->author)) {
            $this->author = $this->author->ID();
        }

        if (!isset($this->taxonomies) || !is_array($this->taxonomies)) {
            $this->taxonomies = [];
        }

        if (isset($this->categories)) {
            if (is_string($this->categories)) {
                $this->categories = [$this->categories];
            }

            if (isset($this->taxonomies['category'])) {
                $this->taxonomies['category'] = array_merge($this->categories, $this->taxonomies['category']);
            } else {
                $this->taxonomies['category'] = $this->categories;
            }

            unset($this->categories);
        }

        if (isset($this->meta)) {
            $this->meta = array_merge($this->meta(), $this->meta);
        } else {
            $this->meta = $this->meta();
        }

    }

}
