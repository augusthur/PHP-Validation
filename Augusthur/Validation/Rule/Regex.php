<?php namespace Augusthur\Validation\Rule;

/**
 * Regex
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Regex implements \Augusthur\Validation\Rule {

	protected $regex;
    protected $message = '%s no es un valor válido para $s.';

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct($regex) {
		$this->regex = $regex;
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
	public function get_error_message($field, $value, $validator) {
        return sprintf($this->message, $value, $validator->get_label($field));
	}

}
