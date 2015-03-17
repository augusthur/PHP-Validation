<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure one string exactly matches another
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Unique implements \Augusthur\Validation\Rule {

    protected $table;
    protected $message = '%s %s ya se encuentra registrado.';

	/**
	 * Constructor
	 *
	 * @param string Field to compare against
	 * @return void
	 **/
	public function __construct($table) {
		$this->table = $table;
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
        $instance = \Illuminate\Database\Capsule\Manager::table($this->table)->where($field, $value)->first();
        return is_null($instance);
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
		return sprintf($this->message, $validator->getLabel($field), $value);
	}

}
