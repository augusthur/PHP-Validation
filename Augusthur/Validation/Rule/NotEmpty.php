<?php namespace Augusthur\Validation\Rule;

/**
 * Input value cannot be empty
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class NotEmpty implements \Augusthur\Validation\Rule {

    protected $message = '%s no puede dejarse vacío.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		return !empty($value);
	}

	/**
	 * Return error message for this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return string Error message
	 **/
	public function getError($field, $value, $validator) {
		return sprintf($this->message, $value);
	}

}
