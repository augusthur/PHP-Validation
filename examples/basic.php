<?php echo '<pre>';

include '../autoload.php';

use Augusthur\Validation\Validator;
use Augusthur\Validation\QuickValidator;
use Augusthur\Validation\Rule;


$input = array(
	'name'      => 'LukéKer34',
	'email'     => array(),
	'password'  => 'password123',
	'password2' => 'password123',
    'array'     => json_decode('[{"usr":"2","pat":"1"},{"usr":"4","pat":"6"}]', true)
);

$validator = new Validator();


$validator
	->setLabel('name', 'your name')
	->setLabel('password2', 'password confirmation')

	//->addFilter('name', 'trim')
	//->addFilter('email', 'trim')
	//->addFilter('email', 'strtolower')
    ->addRule('name', new Rule\AlphaNumeric([' ']))
	->addRule('name', new Rule\MinLength(5))
	->addRule('name', new Rule\MaxLength(10))
	->addRule('email', new Rule\MinLength(5))
	->addRule('email', new Rule\Email())
    ->addRule('array', new Rule\Attributes(['usr' => 'ctype_digit', 'pat' => 'ctype_digit']))
	->addRule('password', new Rule\Matches('password2'))
    ->addOptional('name')
;


if($validator->validate($input)) {
	var_dump('success', $validator->getData());
} else {
	var_dump('error', $validator->getErrors(), $validator->getData());
}

$holis = null;
$vdt = new QuickValidator(function() {echo 'holis!!';});
$vdt->test('holis@gmail.com', new Rule\Email());
//$vdt->test('loca', new Rule\NumNatural());
$vdt->test($holis, new Rule\Alpha());
