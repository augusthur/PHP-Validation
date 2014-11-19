<?php namespace Augusthur\Validation;

/**
 * QuickValidator
 *
 * A Validator contains a set of validation rules and
 * associated metadata for ensuring that a given dataset
 * is valid and returned correctly.
 *
 * @package Validation
 * @author Augusto Mathurin
 **/
class QuickValidator {

    protected $data;
    protected $extrachars = array('á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ');
    protected $errorCallable;

    public function __construct($errorCallable = null) {
        if (is_null($errorCallable)) {
            $this->errorCallable = function() {throw new \Exception('Datos invalidos');};
        } else {
            $this->errorCallable = $errorCallable;
        }
	}

    public function getExtrachars() {
        return $this->extrachars;
    }

    public function getData($field = null, $default = null) {
        if($field === null) return $this->data;
        return array_key_exists($field, $this->data) ? $this->data[$field] : $default;
    }

    public function test($value, $rule) {
        $data[] = $value;
        if (!$rule->validate(count($data)-1, $value, $this)) {
            call_user_func($this->errorCallable);
        }
    }

}
