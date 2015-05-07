<?php namespace Augusthur\Validation\Rule;

/**
 * Input value cannot be unset
 *
 * @package Validation
 * @author Augusto Mathurin
 **/
class Required implements \Augusthur\Validation\Rule {

    protected $message = '%s debe completarse.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		return isset($value);
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
		return sprintf($this->message, $validator->getLabel($field));
	}

}
