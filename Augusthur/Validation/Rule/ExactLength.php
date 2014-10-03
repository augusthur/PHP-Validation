<?php namespace Augusthur\Validation\Rule;

/**
 * String must be exact length
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class ExactLength implements \Augusthur\Validation\Rule {

	protected $length = 0;
    protected $message = '%s debe tener exactamente %d caracteres de longitud.';

	/**
	 * Constructor
	 *
	 * @param int Length
	 * @return void
	 **/
	public function __construct($length) {
		$this->length = (int) $length;
	}

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		return strlen($value) === $this->length;
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
		return sprintf($message, $validator->get_label($field), $this->length);
	}

}
