<?php namespace Augusthur\Validation\Rule;

/**
 * Input can be a maximum of length
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class MaxLength implements \Augusthur\Validation\Rule {

	protected $length = 0;
    protected $message = '%s debe tener a lo sumo %d caracteres de longitud.';

	/**
	 * Constructor
	 *
	 * @param int Max length
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
		return strlen($value) <= $this->length;
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
		return sprintf($this->message, $validator->getLabel($field), $this->length);
	}

}
