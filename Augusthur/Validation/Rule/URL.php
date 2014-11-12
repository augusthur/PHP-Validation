<?php namespace Augusthur\Validation\Rule;

/**
 * Validate a URL
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class URL implements \Augusthur\Validation\Rule {

	protected $allowed_domains;
	protected $allowed_protocols = array('http', 'https');
    protected $message = 'No se cargó una dirección válida para el campo %s.';

	/**
	 * Constructor
	 *
	 * @param string Allowed domains
	 * @param string Allowed protocols
	 * @return void
	 **/
	public function __construct(array $allowed_domains = null, array $allowed_protocols = null) {
		if($allowed_domains !== null) $this->allowed_domains = $allowed_domains;
		if($allowed_protocols !== null) $this->allowed_protocols = $allowed_protocols;
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

		if(empty($value)) return true;
		if(!filter_var($value, FILTER_VALIDATE_URL)) return false;

		$url = parse_url($value);
		if(!in_array($url['scheme'], $this->allowed_protocols)) return false;

		if($this->allowed_domains === null) return true;

		return in_array($url['host'], $this->allowed_domains);

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
