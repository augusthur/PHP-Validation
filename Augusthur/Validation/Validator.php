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

    public function setLabel($field, $label) {
        $this->labels[$field] = $label;
        return $this;
    }

    public function getLabel($field) {
        return isset($this->labels[$field]) ? $this->labels[$field] : $this->humanizeFieldName($field);
    }

    public function getExtrachars() {
        return $this->extrachars;
    }

    public function addFilter($field, $filter) {
        if(!is_callable($filter)) return $this;
        if(!isset($this->filters[$field])) $this->filters[$field] = array();
        $this->filters[$field][] = $filter;
        return $this;
    }

    public function addRule($field, $rule) {
        if(!$rule instanceof \Augusthur\Validation\Rule) return $this;
        if(!isset($this->labels[$field])) {
            $this->setLabel($field, $this->humanizeFieldName($field));
        }
        if(!isset($this->rules[$field])) $this->rules[$field] = array();
        $this->rules[$field][] = $rule;
        return $this;
    }

    public function getRules() {
        return $this->rules;
    }

    public function validate(array $data) {
        $this->data = $this->applyFilters($data);
        $this->errors = $this->testRules();
        return empty($this->errors);
    }

    public function getData($field = null, $default = null) {
        if($field === null) return $this->data;
        return array_key_exists($field, $this->data) ? $this->data[$field] : $default;
    }

    public function getErrors() {
        return $this->errors;
    }

    protected function testRules() {
        if(empty($this->rules)) return array();
        $errors = array();
        foreach($this->rules as $field => $rules) {
            $value = isset($this->data[$field]) ? $this->data[$field] : null;
            foreach($rules as $rule) {
                list($result, $error) = $this->testRule($field, $value, $rule);
                if($result === false) $errors[] = $error;
            }
        }
        return $errors;
    }

    protected function testRule($field, $value, $rule) {
        $result = $rule->validate($field, $value, $this);
        if($result) {
            return array(true, null);
        } else {
            return array(false, $rule->getError($field, $value, $this));
        }

    }

    protected function applyFilters(array $data) {
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

    protected function humanizeFieldName($field) {
        return str_replace(array('-', '_'), ' ', $field);
    }

}
