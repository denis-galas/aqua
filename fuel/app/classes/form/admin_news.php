<?php

class AdminNewsForm extends BaseForm {
	public function __construct() {
		// create the registration fieldset
		$form = \Fieldset::forge('newsform', array(
				'error_class' => 'has-error',
				'field_template' => $this->field_template,
				'form_template' => '{fields}',
				));
		
		$form->add(
				'id', '',
				array('type' => 'hidden')
		);
		
		$form->add(
				'source', 'Слайд',
				array('type' => 'hidden')
		);
		
		$form->add(
				'title', 'Название',
				array('type' => 'text', 'class' => 'form-control')
		)->add_rule('required')
		->add_rule('max_length', 255);
		
		$form->add(
				'description', 'Описание',
				array('type' => 'textarea', 'class' => 'form-control', 'rows' => '6')
		)->add_rule('max_length', 5000);
		
		$form->add(
				'source_file', 'Слайд',
				array('type' => 'file')
		);
		
		$form->add(
				'on_main', 'Показывать на главной',
				array('type' => 'checkbox', 'value' => 1)
		)->set_template('<div class="form-group">{label} {field}</div>');
		
		$val = Validation::instance('newsform');
		$val->set_message('required', 'Поле :label пустое! Пожалуйста заполните его');
		$val->set_message('max_length', 'Максимально допустимая длина поля :label :param:1 символов!');
		
		$this->form = $form;
	}
}