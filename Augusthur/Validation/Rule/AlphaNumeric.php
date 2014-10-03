<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure characters are a-z or 0-9
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class AlphaNumeric implements \Augusthur\Validation\Rule {

    protected $message = '%s debe estar compuesto únicamente de letras o números.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		if(empty($value)) return true;
		return ctype_alnum($value);
	}

	/**
	 * Return error message for this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return string Error message
	 **/
	public function get_error_message($field, $value, $validator) {
        return sprintf($this->message, $validator->get_label($field));
	}

}
