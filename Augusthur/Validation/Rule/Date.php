<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure one string exactly matches another
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Date implements \Augusthur\Validation\Rule {

    protected $format;
    protected $message = '%s no es una fecha válida.';

	/**
	 * Constructor
	 *
	 * @param string Field to compare against
	 * @return void
	 **/
	public function __construct($format = 'Y-m-d') {
		$this->format = $format;
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
        $d = \DateTime::createFromFormat($this->format, $value);
        return $d && $d->format($this->format) == $value;
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
