<?php namespace Augusthur\Validation\Rule;



/**
 * Field value must not match Equal value
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class NotEqual implements \Augusthur\Validation\Rule {


	/**
	 * @var string Value to compare against
	 **/
	protected $value;


	/**
	 * Constructor
	 *
	 * @param string Value to compare against
	 * @return void
	 **/
	public function __construct($value) {
		$this->value = $value;
	} // end func: __construct



	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		return $value !== $this->value;
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
		return $validator->getLabel($field) . ' can not be the provided value';
	} // end func: getError



	/**
	 * jQuery Validation rule name
	 *
	 * @return string Rule name
	 **/
	public function jquery__get_rule_name() {
		return 'php_notequal';
	} // end func: jquery__get_rule_name



	/**
	 * jQuery Validation rule definition
	 *
	 * @return array Rule
	 **/
	public function jquery__get_rule_definition() {
		return array(
			'php_notequal' => $this->value,
		);
	} // end func: jquery__get_rule_definition



	/**
	 * jQuery Validation method
	 *
	 * @return string JavaScript function
	 **/
	public function jquery__get_method_definition() {
		return 'function(value, element, expected){
			return this.optional(element) || (value !== expected);
		}';
	} // end func: jquery__get_method_definition



} // end class: NotEqual
