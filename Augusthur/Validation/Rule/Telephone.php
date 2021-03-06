<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure one string exactly matches another
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Telephone implements \Augusthur\Validation\Rule {

    protected $regex = '/^[0-9 \(\)\+\-]*$/';
    protected $message = '%s no es un número de teléfono válido.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
    public function validate($field, $value, $validator) {
        return (bool) preg_match($this->regex, $value);
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
