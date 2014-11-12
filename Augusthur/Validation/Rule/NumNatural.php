<?php namespace Augusthur\Validation\Rule;

/**
 * Input must be an integer zero or above
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class NumNatural implements \Augusthur\Validation\Rule {

    protected $message = '%s debe ser un número mayor o igual a cero.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		if(!ctype_digit($value)) return false;
		return $value >= 0;
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
