<?php namespace Augusthur\Validation\Rule;

/**
 * Only characters a-z, 0-9, - and _
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class AlphaSlug implements \Augusthur\Validation\Rule {


	/**
	 * @var string Pattern to allow
	 **/
	protected $regex = '/^[a-z0-9-_]*$/i';


	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		if(!isset($value)) return true;
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
		return $validator->getLabel($field) . ' can contain all letters, numbers, hyphens and underscores';
	}

}
