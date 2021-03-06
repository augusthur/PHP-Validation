<?php namespace Augusthur\Validation\Rule;



/**
 * Value must evaulate to truth
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class True implements \Augusthur\Validation\Rule {


	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		return (bool) $value;
	} // end func: validate



	/**
	 * Return error message for this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return string Error message
	 **/
	public function getError($field, $value, $validator) {
		return $validator->getLabel($field) . ' must be checked';
	} // end func: getError



	/**
	 * jQuery Validation rule name
	 *
	 * @return string Rule name
	 **/
	public function jquery__get_rule_name() {
		return 'required';
	} // end func: jquery__get_rule_name



	/**
	 * jQuery Validation rule definition
	 *
	 * @return array Rule
	 **/
	public function jquery__get_rule_definition() {
		return 'required';
	} // end func: jquery__get_rule_definition



} // end class: True
