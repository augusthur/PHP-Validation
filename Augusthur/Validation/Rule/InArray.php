<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure input value is in supplied array
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class InArray implements \Augusthur\Validation\Rule {

	protected $array;
	protected $match_keys;

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct(array $array, $match_keys = false) {
		$this->array = $array;
		$this->match_keys = (bool) $match_keys;
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
		if($this->match_keys === true) {
			return array_key_exists($value, $this->array);
		} else {
			return in_array($value, $this->array);
		}
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
		return $validator->getLabel($field) . ' must be in the available list of options';
	}

}
