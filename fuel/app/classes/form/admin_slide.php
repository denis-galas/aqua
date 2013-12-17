<?php

class AdminSlideForm extends BaseForm {
	public function __construct() {
		// create the registration fieldset
		$form = \Fieldset::forge('slideform', array(
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
		)->add_rule('required');
		
		$form->add(
				'title', 'Название',
				array('type' => 'text', 'class' => 'form-control')
		)->add_rule('required')
		->add_rule('max_length', 255);
		
		$form->add(
				'description', 'Описание',
				array('type' => 'textarea', 'class' => 'form-control')
		)->add_rule('max_length', 5000);
		
		$form->add(
				'source_file', 'Слайд',
				array('type' => 'file')
		);
		
		$val = Validation::instance('slideform');
		$val->set_message('required', 'Поле :label пустое! Пожалуйста заполните его');
		
		$this->form = $form;
	}
}