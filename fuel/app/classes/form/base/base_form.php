<?php

abstract class BaseForm {
	protected $form;
	protected $field_template = '<div class="form-group {error_class}">
									<label class="control-label">{label}</label>
									<div class="controls">
										{field}
										<div class="help-block"></div>
									</div>
								</div>';
	
	
	abstract public function __construct();
	
	public function getForm() {
		return $this->form;
	}
}