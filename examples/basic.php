<?php echo '<pre>';

include '../autoload.php';

use Augusthur\Validation\Validator;
use Augusthur\Validation\Rule;


$input = array(
	'name'      => 'Luké Ker',
	'email'     => ' L@l ',
	'password'  => 'password123',
	'password2' => 'password456',
);

$validator = new Validator();


$validator
	->setLabel('name', 'your name')
	->setLabel('password2', 'password confirmation')

	//->addFilter('name', 'trim')
	->addFilter('email', 'trim')
	->addFilter('email', 'strtolower')
    ->addRule('name', new Rule\Alpha())
	->addRule('name', new Rule\MinLength(5))
	->addRule('name', new Rule\MaxLength(10))
	->addRule('email', new Rule\MinLength(5))
	->addRule('email', new Rule\Email())
	->addRule('password', new Rule\Matches('password2'))
;


if($validator->validate($input)) {
	var_dump('success', $validator->getData());
} else {
	var_dump('error', $validator->getErrors(), $validator->getData());
}

var_dump($validator->quickValidate($input));
echo $input['email'];
