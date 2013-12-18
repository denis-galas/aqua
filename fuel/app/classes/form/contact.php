<?php

class ContactForm extends BaseForm {
	public function __construct() {
		// create the registration fieldset
		$form = \Fieldset::forge('contactform', array(
				'error_class' => 'has-error',
				'field_template' => $this->field_template,
				'form_template' => '{fields}',
				));
		
		$form->add(
				'subject', 'Тема',
				array('type' => 'text', 'class' => 'form-control')
		)->add_rule('required')
		->add_rule('max_length', 255);
		
		$form->add(
				'message', 'Сообщение',
				array('type' => 'textarea', 'class' => 'form-control', 'rows' => 5)
		)->add_rule('required')->add_rule('max_length', 5000);
		
		$form->add(
				'file', 'Файл',
				array('type' => 'file')
		);
		
		$val = Validation::instance('contactform');
		$val->set_message('required', 'Поле :label пустое! Пожалуйста заполните его');
		$val->set_message('max_length', 'Максимально допустимая длина поля :label :param:1 символов!');
		
		$this->form = $form;
	}
}