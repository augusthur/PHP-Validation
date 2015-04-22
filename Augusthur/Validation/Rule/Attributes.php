<?php namespace Augusthur\Validation\Rule;

/**
 * Ensure input value is in supplied array
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class Attributes implements \Augusthur\Validation\Rule {

	protected $attributes;

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct(array $attributes) {
		$this->attributes = $attributes;
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
        $success = true;
        foreach ($this->attributes as $attr => $vdt) {
            $success = $success && isset($value[$attr]) && call_user_func($vdt, $value[$attr]);
        }
        return $success;
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
		return $validator->getLabel($field) . ' no posee los atributos válidos.';
	}

}
