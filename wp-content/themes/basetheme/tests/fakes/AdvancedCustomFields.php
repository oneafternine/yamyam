<?php

namespace Substrakt\Fakes;

class AdvancedCustomFields {

    public function __construct($postID, $data) {
        $this->postID = $postID;
        $this->data = $data;
        $this->process();
    }

    public function process() {
        $acf = new \acf_json();
        $acf->include_fields();
        // ACF()->init();
        foreach ($this->data as $group => $values) {

            # $group  = group_57aa445697fe7
            # $values = 'child' => ['grandchild' => 'foobar']
            # $fields = group_57aa445697fe7.json fields section

            $fields = acf_get_local_fields($group);

            $acf = [];
            foreach ($fields as $field) {
                $acf[$field['name']] = $field;
            }


            foreach ($values as $key => $value) {
                $field = $acf[$key];

                if (in_array($field['type'], ['repeater'])) {
                    update_field($field['key'], $value, $this->postID);
                } else {
                    update_field($field['key'], $value, $this->postID);
                }
            }
        }
    }

    public function save($field = false, $value = false) {
        return true;
    }

}
