<?php

class AdminGalleryForm extends BaseForm {
	public function __construct() {
		// create the registration fieldset
		$form = \Fieldset::forge('galleryform', array(
				'error_class' => 'has-error',
				'field_template' => $this->field_template,
				'form_template' => '{fields}',
				));
		
		$form->add(
				'id', '',
				array('type' => 'hidden')
		);
		
		$form->add(
				'source', 'Фото',
				array('type' => 'hidden')
		)->add_rule('required');
		
		$form->add(
				'title', 'Название',
				array('type' => 'text', 'class' => 'form-control')
		)->add_rule('max_length', 255);
		
		$options = Model_Fcategory::returnArray();
		
		$form->add(
				'category', 'Категория',
				array('options' => $options, 'type' => 'select', 'class' => 'form-control')
		)->add_rule('required');
		
		$form->add(
				'source_file', 'Фото',
				array('type' => 'file')
		);
		
		$val = Validation::instance('galleryform');
		$val->set_message('required', 'Поле :label пустое! Пожалуйста заполните его');
		$val->set_message('max_length', 'Максимально допустимая длина поля :label :param:1 символов!');
		
		$this->form = $form;
	}
}