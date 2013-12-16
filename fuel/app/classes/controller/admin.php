<?php

use Fuel\Core\Input;

class Controller_Admin extends Controller_Template
{
	/**
	 * signup page
	 */
// 	public function action_register()
// 	{
// 		/**
// 		 * if user already logged in then we found
// 		 * onboarding and redirect to step where user finished
// 		 */
// 		if (!Auth::check()) {
// 			Response::redirect('login');
// 		}
	
// 		$this->template->title = 'New admin registration';
	
// 		$form = new AdminRegisterForm();
// 		$form = $form->getForm();
	
// 		if (Input::method() == 'POST') {
// 			$form->validation()->run();
// 			// if validated, create the user
// 			if (!$form->validation()->error())
// 			{
// 				$user = Model_Hbadmin::register();
// 				Response::redirect('login');
// 			}
	
// 			$form->repopulate();
// 		}
	
// 		// pass the fieldset to the form, and display the new user registration view
// 		$this->template->content = View::forge("auth/register", array(
// 				'form' => $form,
// 		), false);
// 	}
	
	/**
	 * login page
	 */
	public function action_login()
	{
		if (Auth::check()) {
			Response::redirect('');
		}
		
		$this->template->title = 'Вход администратора';
		
		$form = new AdminLoginForm();
		$form = $form->getForm();
	
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				$login = Model_Admin::checkIfLoginValid(Input::post('username'),Input::post('password'));
	
				if (gettype($login) == 'object' && get_class($login) == 'Model_Admin') {
					Auth::force_login($login->id);
	
					Response::redirect('');
				}
	
				Session::set_flash('error', $login);
			}
	
			$form->repopulate();
		}
	
		$this->template->content = View::forge("auth/login", array(
				'form' => $form,
		), false);
	}
	
	/**
	 * login page
	 */
	public function action_logout()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
	
		\Auth::logout();
	
		Response::redirect('');
	}	
	
	public function action_categories()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
		
		$this->template->title = 'Управление категориями рыб';
		
		if (Input::get('edit')) {
			$category = Model_Fcategory::find(Input::get('id'));
		}
		if (!isset($category) || !$category) {
			$category = new Model_Fcategory();
		}
		
		$form = new AdminCategoryForm();
		$form = $form->getForm();
		$form->populate($category, true);
		
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				if (!Input::get('edit')) {
					$cat_exists = Model_Fcategory::getRecord('title', Input::post('title'));
				}
				
				if (Input::get('edit') || !$cat_exists) {
					$fields = $form->validated();
					$category->from_array($fields);
					$category->save();
					
					if (!Input::get('edit')) {
						Session::set_flash('success', 'Категория добавлена успешно!');
					} else {
						Session::set_flash('success', 'Категория изменена успешно!');
					}
					Response::redirect('admin/categories');
				} else {
					Session::set_flash('error', 'Такая категоря уже существует!');
				}
				
			}
		
			//$form->repopulate();
		}
		$categories = Model_Fcategory::find('all');
		
		$this->template->content = View::forge("admin/categories", array(
				'form' => $form,
				'categories' => $categories,
		), false);
	}
	
	public function action_categoryDelete()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
		
		$id = Input::get('id');
		$category = Model_Fcategory::find($id);
		$category->delete();
		
		Response::redirect('admin/categories');
	}
	
	public function action_slides()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
		$this->template->title = 'Управление слайдшоу';
		
		if (Input::get('edit')) {
			$slide = Model_Slide::find(Input::get('id'));
		}
		if (!isset($slide) || !$slide) {
			$slide = new Model_Slide();
		}
		
		$form = new AdminSlideForm();
		$form = $form->getForm();
		$form->populate($slide, true);
	
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				$config = array(
					'path' => DOCROOT.'assets/img/slides',
					'randomize' => true,
					'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
				);
				
				Upload::process($config);
				
				
				if (Upload::is_valid() || Input::post('source') == $slide->source)
				{
					// save them according to the config
					if (Input::post('source') != $slide->source || !Input::get('edit')) {
						Upload::save();
						
						$files = Upload::get_files();
						
						$o_width = 1170;
						$o_height = 450;
						$t_width = 234;
						$t_height = 90;
						$filepath = $files[0]['saved_to'].$files[0]['saved_as'];
						$thumb_files = $files[0]['saved_to'].'thumbs/'.$files[0]['saved_as'];
						Image::load($filepath)->resize($o_width, $o_height, false)->save($filepath);
						Image::load($filepath)->resize($t_width, $t_height, false)->save($thumb_files);
					}
				
					$fields = $form->validated();
					$slide->from_array($fields);
					if (Input::post('source') != $slide->source || !Input::get('edit')) {
						$slide->source = $files[0]['saved_as'];
					}
					$slide->save();

					if (!Input::get('edit')) {
						Session::set_flash('success', 'Слайд добавлен успешно!');
					} else {
						Session::set_flash('success', 'Слайд изменен успешно!');
					}
					Response::redirect('admin/slides');
				} else {
					foreach (Upload::get_errors() as $file)
					{
						$error = $file['errors'][0]['message'];
					}
					Session::set_flash('error', $error);
				}
			}
		}
		
		$slides = Model_Slide::find('all');
		$this->template->content = View::forge("admin/slides", array(
				'form' => $form,
				'slides' => $slides,
		), false);
	}
	
	public function action_slideDelete()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
	
		$id = Input::get('id');
		$slide = Model_Slide::find($id);
		unlink(DOCROOT.'assets/img/slides/'.$slide->source);
		unlink(DOCROOT.'assets/img/slides/thumbs/'.$slide->source);

		$slide->delete();
	
		Response::redirect('admin/slides');
	}
}