<?php

class AdminLoginForm extends BaseForm {
	public function __construct() {
		// create the registration fieldset
		$form = \Fieldset::forge('loginform', array(
				'auto_id_prefix' => '',
				'error_class' => 'has-error',
				'field_template' => $this->field_template,
				'form_template' => '{fields}',
				));
		
		$form->add(
				'username', 'Логин',
				array('type' => 'text', 'class' => 'form-control')
		)->add_rule('required');
		
		$form->add(
				'password', 'Пароль',
				array('type' => 'password', 'class' => 'form-control')
		)->add_rule('required');
		
		$val = Validation::instance('loginform');
		$val->set_message('required', 'Поле :label пустое! Пожалуйста заполните его');
		
		$this->form = $form;
	}
}