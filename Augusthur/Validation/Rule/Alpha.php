<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure all characters are in a-z
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Alpha implements \Augusthur\Validation\Rule {

    protected $message = '%s debe estar compuesto únicamente de letras.';

	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		if(empty($value)) return true;
        return ctype_alpha(str_replace($validator->get_extrachars(), '', $value));
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
		return sprintf($this->message, $validator->get_label($field));
	}

}
