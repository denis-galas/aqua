<?php

class AdminRegisterForm extends BaseForm {
	public function __construct() {
		// create the registration fieldset
		$form = \Fieldset::forge('registerform', array(
				'error_class' => 'error',
				'field_template' => $this->field_template,
				'form_template' => '{fields}',
				));
		// add a csrf token to prevent CSRF attacks
// 		$form->form()->add_csrf();
		
		$form->add(
				'firstname', 'Firstname',
				array('type' => 'text')
		)->add_rule('required');
		
		$form->add(
				'lastname', 'Lastname',
				array('type' => 'text')
		)->add_rule('required');
		
		$form->add(
				'email', 'Email',
				array('type' => 'text')
		)->add_rule('required');
		
		$form->add(
				'password', 'Password',
				array('type' => 'password')
		)->add_rule('required');
		
		$form->add(
				'confirm', 'Password confirmation',
				array('type' => 'password')
		)->add_rule('match_field', 'password');
		
		$options = array(
				'-10' => 'Hawaii-Aleutian Standard Time (-10h)',
				'-9' => 'Alaska Time (-9h)',
				'-8' => 'Pacific Standard Time (-8h)',
				'-7' => 'Mountain Standard Time (-7h)',
				'-6' => 'Central Standard Time (-6h)',
				'-5' => 'Eastern Standard Time (-5h)',
				'-4' => 'Atlantic Standard Time (-4h)');
		
		$form->add(
				'offset', 'Timezone',
				array('options' => $options, 'type' => 'select', 'value' => '-8')
		)->add_rule('required');
		
		$this->form = $form;
	}
}