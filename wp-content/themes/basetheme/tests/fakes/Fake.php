<?php

namespace Substrakt\Fakes;

abstract class Fake implements iFake {

    public static $mysqli = null;
    private static $tables = null;

    /**
     * Return an array of attributes to be passed to to WordPress
     * Converts shorthand keys to longer WordPress ones
     * @example title to post_title when inserting a post
     * @return array
     * @author Stuart Maynes stu@substrakt.com
    */
    public function attributes() {
        $attributes = [];
        foreach ($this->map() as $key => $value) {
            if (isset($this->$key)) {
                $attributes[$value] = $this->$value = $this->$key;
                unset($this->$key);
            }
        }
        return $attributes;
    }

    /**
     * Register a custom taxonomy
     * @param $taxonomy The name of the taxonomy
     * @param $type The post type to register the taxonomy to
     * @author Stuart Maynes stu@substrakt.com
    */
    public function create_taxonomy($taxonomy, $type = 'post') {
        return register_taxonomy($taxonomy, [$type], []);
    }

    /**
     * Save ACF meta data for the post
     * @return boolean Was the ACF data saved
     * @author Stuart Maynes stu@substrakt.com
    */
    public function save_acf() {
        if (class_exists('acf_json')) {
            $acf = new \acf_json();
            $acf->include_fields();

            if (isset($this->acf) && is_array($this->acf)) {
                foreach ($this->acf as $group => $values) {

                    $fields = $this->acf_fields_by_name($group);

                    foreach ($values as $key => $value) {
                        update_field($fields[$key]['key'], $value, $this->ID);
                    }
                }
                return true;
            }
        }

        return false;
    }

    /**
     * Truncate all tables in the database
     * Using mysqli rather than the WordPress ORM
     * because it wasn't fast enough and caused errors
     * @return null
     * @author Stuart Maynes stu@substrakt.com
    */
    static public function truncate() {
        $query = self::$mysqli->query("SHOW TABLES");

        while ($table = $query->fetch_assoc()) {
            $table = array_values($table)[0];
            if (strpos($table, 'options') === false) {
                self::$mysqli->query("TRUNCATE TABLE {$table}");
            }
        }
    }

    /**
     * Return an array of all the ACF fields within the given group
     * group by the field name
     * @param $group ACF group ID
     * @return array
     * @author Stuart Maynes stu@substrakt.com
    */
    private function acf_fields_by_name($group) {
        $fields = [];

        foreach (acf_get_local_fields($group) as $field) {
            $fields[$field['name']] = $field;
        }

        return $fields;
    }
}
