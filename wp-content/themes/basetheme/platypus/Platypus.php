<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
abstract class Platypus {


    public function date($format = false) {
        $format = $format ? $format : get_option('date_format');
        $date = new \DateTime($this->wp->post_date);
        return $date->format($format);
    }

    public function date_gmt() {

    }

    /**
	 * Return the value from an ACF field
	 * @param string $name Field name
	 * @param boolean $format Format the value loaded from the db
	 * @return mixed Dependant on the ACF field type
	*/
	public function field($name, $format = true) {
        if (function_exists('get_field')) {
            return get_field($name, $this->ID(), $format);
        }
	}

    public function time($format = false) {
        $format = $format ? $format : get_option('time_format');
        return $this->date($format);
    }

    public function time_gmt() {

    }

    /**
     * Return the name of a class
     * Default returns the name of the current class
     * Passing a parameter will cause the parameter to returned instead
     * if the class does exist
     * @param $class Optional name of a class
     * @return String The name of a class
     * @author Stuart Maynes <stu@substrakt.com>
    */
    protected function get_class($class = false) {
        return ($class) ? $class : get_class($this);
    }

    /**
     * @param $params Array to pass to the instatiated class
     * @param $class Optional name of a class
     * @return Array Of objects
     * @author Stuart Maynes <stu@substrakt.com>
    */
    protected function to_object($params = [], $class = false) {
        $class = $this->get_class($class);
        if (!is_array($params)) return [];
        return array_map(function($args) use ($class) {
            return new $class($args);
        }, $params);
    }

    /**
     * @param $params Array to pass to the WP_Query
     * @param $class mixed Optional class name or array map of post types to class names
     * @return Array Of objects
     * @author Stuart Maynes <stu@substrakt.com>
    */
    protected function query_to_object($params, $class = false) {
        $query = new \WP_Query($params);

        if (is_string($class) || $class === false) {
            return $this->to_object($query->posts, $class);
        }

        if (is_array($query->posts) && is_array($class)) {
            return array_map(function($post) use ($class) {
                $class = $this->query_to_object_class($post, $class);
                return new $class($post);
            }, $query->posts);
        }

        return [];
    }

    /**
     * @param $post Object responds to post_type attribute
     * @param $class Array Map of post types to class names
     * @return string Class name
     * @author Stuart Maynes <stu@substrakt.com>
    */
    private function query_to_object_class($post, $class) {
        if (isset($class[$post->post_type])) {
            return $class[$post->post_type];
        }
        return $this->get_class(false);
    }



}
