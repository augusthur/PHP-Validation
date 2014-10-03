<?php namespace Augusthur\Validation\Rule;

/**
 * Validate an email address
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Email implements \Augusthur\Validation\Rule {

    protected $message = '%s no es una dirección de email válida.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
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
        return sprintf($message, $value);
	}

}
