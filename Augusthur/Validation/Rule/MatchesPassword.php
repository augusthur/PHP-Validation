<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure one string matches a given hash
 *
 * @package Validation
 * @author Augusto Mathurin
 **/
class MatchesPassword implements \Augusthur\Validation\Rule {

	protected $hash;
    protected $message = '%s no es correcta.';


	/**
	 * Constructor
	 *
	 * @param string Field to compare against
	 * @return void
	 **/
	public function __construct($hash) {
		$this->hash = $hash;
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
		return password_verify($value, $this->hash);
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
		return sprintf($this->message, $field);
	}

}
