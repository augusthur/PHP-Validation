<?php namespace Augusthur\Validation;

/**
 * Validator
 *
 * A Validator contains a set of validation rules and
 * associated metadata for ensuring that a given dataset
 * is valid and returned correctly.
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Validator {

    protected $data;
    protected $labels = array();
    protected $filters = array();
    protected $rules = array();
    protected $extrachars = array('á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ');

    public function set_label($field, $label) {
        $this->labels[$field] = $label;
        return $this;
    }

    public function get_label($field) {
        return isset($this->labels[$field]) ? $this->labels[$field] : $this->humanize_field_name($field);
    }

    public function get_extrachars() {
        return $extra_chars;
    }

    public function add_filter($field, $filter) {
        if(!is_callable($filter)) return $this;

        if(!isset($this->filters[$field])) $this->filters[$field] = array();
        $this->filters[$field][] = $filter;

        return $this;
    }

    public function add_rule($field, $rule) {
        if(!$rule instanceof \Augusthur\Validation\Rule) return $this;

        if(!isset($this->labels[$field])) {
            $this->set_label($field, $this->humanize_field_name($field));
        }

        if(!isset($this->rules[$field])) $this->rules[$field] = array();
        $this->rules[$field][] = $rule;

        return $this;
    }

    public function get_rules() {
        return $this->rules;
    }

    public function is_valid(array $data) {
        $this->data = $this->apply_filters($data);
        $this->errors = $this->test_rules();
        return empty($this->errors);
    }

    public function quick_is_valid() {
        if(empty($this->rules)) return true;
        $errors = true;
        foreach($this->rules as $field => $rules) {
            $value = isset($this->data[$field]) ? $this->data[$field] : null;
            foreach($rules as $rule) {
                $errors = $errors && $rule->validate($field, $value, $this);
            }
        }
        return $errors;
    }

    public function get_data($field = null, $default = null) {
        if($field === null) return $this->data;
        return array_key_exists($field, $this->data) ? $this->data[$field] : $default;
    }

    public function get_errors() {
        return $this->errors;
    }

    protected function test_rules() {
        if(empty($this->rules)) return array();

        $errors = array();

        foreach($this->rules as $field => $rules) {
            $value = isset($this->data[$field]) ? $this->data[$field] : null;
            foreach($rules as $rule) {
                list($result, $error) = $this->test_rule($field, $value, $rule);
                if($result === false) $errors[] = $error;
            }
        }

        return $errors;
    }

    protected function test_rule($field, $value, $rule) {

        $result = $rule->validate($field, $value, $this);

        if($result) {
            return array(true, null);
        } else {
            return array(false, $rule->get_error_message($field, $value, $this));
        }

    }

    protected function apply_filters(array $data) {

        if(empty($this->filters)) return $data;

        foreach($this->filters as $field => $filters) {

            if(!isset($data[$field])) continue;

            $value = $data[$field];

            foreach($filters as $filter) {
                $value = call_user_func($filter, $value);
            }

            $data[$field] = $value;
        }

        return $data;
    }

    protected function humanize_field_name($field) {
        return str_replace(array('-', '_'), ' ', $field);
    }

}
