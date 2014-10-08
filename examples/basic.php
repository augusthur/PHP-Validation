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
	->set_label('name', 'your name')
	->set_label('password2', 'password confirmation')

	//->add_filter('name', 'trim')
	->add_filter('email', 'trim')
	->add_filter('email', 'strtolower')
    ->add_rule('name', new Rule\Alpha())
	->add_rule('name', new Rule\MinLength(5))
	->add_rule('name', new Rule\MaxLength(10))
	->add_rule('email', new Rule\MinLength(5))
	->add_rule('email', new Rule\Email())
	->add_rule('password', new Rule\Matches('password2'))
;


if($validator->is_valid($input)) {
	var_dump('success', $validator->get_data());
} else {
	var_dump('error', $validator->get_errors(), $validator->get_data());
}

var_dump($validator->quick_is_valid($input));
echo $input['email'];
