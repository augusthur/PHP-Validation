<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure characters are a-z or 0-9
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class AlphaNumeric implements \Augusthur\Validation\Rule {

    protected $message = '%s debe estar compuesto únicamente de letras o números.';
    protected $extrachars;

    public function __construct($extrachars = array()) {
		$this->extrachars = $extrachars;
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
        return preg_match("/[^[:alnum:]]/ui", str_replace($this->extrachars, '', $value)) == 0;
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
