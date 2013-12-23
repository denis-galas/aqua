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
		Model_Gallery::removeByCategory($id);
		$category = Model_Fcategory::find($id);
		$category->delete();
		
		Session::delete('category_sort');
		
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
					$old_source = $slide->source;
					if (Input::post('source') != $old_source || !Input::get('edit')) {
						Upload::save();
						
						$files = Upload::get_files();
						
						if (Input::post('source') != $slide->source && Input::get('edit')) {
							unlink(DOCROOT.'assets/img/slides/'.$slide->source);
						}
						
						$o_width = 160;
						$o_height = 120;
						//$t_width = 160;
						//$t_height = 120;
						$filepath = $files[0]['saved_to'].$files[0]['saved_as'];
						//$thumb_files = $files[0]['saved_to'].'thumbs/'.$files[0]['saved_as'];
						Image::load($filepath)->resize($o_width, $o_height, false)->save($filepath);
						//Image::load($filepath)->resize($t_width, $t_height, false)->save($thumb_files);
					}
				
					$fields = $form->validated();
					$slide->from_array($fields);
					if (Input::post('source') != $old_source || !Input::get('edit')) {
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
		//unlink(DOCROOT.'assets/img/slides/thumbs/'.$slide->source);

		$slide->delete();
	
		Response::redirect('admin/slides');
	}
	
	public function action_gallery()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
		
		if (!Session::get('category_sort')) {		
			Session::set('category_sort', 'all');
		}
		if (Input::get('category_sort')) {
			Session::set('category_sort', Input::get('category_sort'));
		}
		
		$this->template->title = 'Управление слайдшоу';
		
// 		$gallery = new Model_Gallery();
		if (Input::get('edit')) {
			$gallery = Model_Gallery::find(Input::get('id'));
		}
		if (!isset($gallery) || !$gallery) {
			$gallery = new Model_Gallery();
		}
		$form = new AdminGalleryForm();
		$form = $form->getForm();
		$form->populate($gallery, true);
		
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				$config = array(
						'path' => DOCROOT.'assets/img/gallery',
						'randomize' => true,
						'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
				);
		
				Upload::process($config);
		
				if (Upload::is_valid() || Input::post('source') == $gallery->source)
				{
					$old_source = $gallery->source;
					if (Input::post('source') != $old_source || !Input::get('edit')) {
						Upload::save();
					
						$files = Upload::get_files();
					
						if (Input::post('source') != $gallery->source && Input::get('edit')) {
							unlink(DOCROOT.'assets/img/gallery/'.$gallery->source);
							unlink(DOCROOT.'assets/img/gallery/thumbs/'.$gallery->source);
						}
					
						$o_width = 800;
						$o_height = 600;
						$t_width = 280;
						$t_height = 210;
						$filepath = $files[0]['saved_to'].$files[0]['saved_as'];
						$thumb_files = $files[0]['saved_to'].'thumbs/'.$files[0]['saved_as'];
						Image::load($filepath)->resize($o_width, $o_height, false)->save($filepath);
						Image::load($filepath)->resize($t_width, $t_height, false)->save($thumb_files);
					}
					
					$fields = $form->validated();
					$gallery->from_array($fields);
					if (Input::post('source') != $old_source || !Input::get('edit')) {
						$gallery->source = $files[0]['saved_as'];
					}
					$gallery->save();
		
					if (!Input::get('edit')) {
						Session::set_flash('success', 'Фото успешно добавлено!');
					} else {
						Session::set_flash('success', 'Фото изменено успешно!');
					}
					
					Response::redirect('admin/gallery');
				} else {
					foreach (Upload::get_errors() as $file)
					{
						$error = $file['errors'][0]['message'];
					}
					Session::set_flash('error', $error);
				}
			}
		}
		
		$photos = Model_Gallery::getBySort(Session::get('category_sort'));
		
		$this->template->content = View::forge("admin/gallery", array(
				'form' => $form,
				'photos' => $photos,
		), false);
	}
	
	public function action_photoDelete()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
	
		$id = Input::get('id');
		$slide = Model_Gallery::find($id);
		unlink(DOCROOT.'assets/img/gallery/'.$slide->source);
		unlink(DOCROOT.'assets/img/gallery/thumbs/'.$slide->source);
	
		$slide->delete();
	
		Response::redirect('admin/gallery');
	}
	
	public function action_prices()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
		$this->template->title = 'Управление прайсами';
	
		if (Input::get('edit')) {
			$price = Model_Price::find(Input::get('id'));
		}
		if (!isset($price) || !$price) {
			$price = new Model_Price();
		}
	
		$form = new AdminPriceForm();
		$form = $form->getForm();
		$form->populate($price, true);
	
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				$config = array(
						'path' => DOCROOT.'assets/prices',
						'randomize' => false
				);
	
				Upload::process($config);
	
				if (Upload::is_valid() || Input::post('source') == $price->source)
				{
					// save them according to the config
					$old_source = $price->source;
					$fields = $form->validated();
					if (Input::post('source') != $old_source || !Input::get('edit')) {
						Upload::save();
						$files = Upload::get_files();
						
						if (Input::post('source') != $price->source && Input::get('edit')) {
							unlink(DOCROOT.'assets/prices/'.$price->source);
						}
					}
					$price->from_array($fields);
					if (Input::post('source') != $old_source || !Input::get('edit')) {
						$price->source = $files[0]['saved_as'];
					}
					$price->save();
	
					if (!Input::get('edit')) {
						Session::set_flash('success', 'Прайс добавлен успешно!');
					} else {
						Session::set_flash('success', 'Прайс изменен успешно!');
					}
					Response::redirect('admin/prices');
				} else {
					foreach (Upload::get_errors() as $file)
					{
						$error = $file['errors'][0]['message'];
					}
					Session::set_flash('error', $error);
				}
			}
		}
	
		$prices = Model_Price::find('all');
		$this->template->content = View::forge("admin/prices", array(
				'form' => $form,
				'prices' => $prices,
		), false);
	}
	
	public function action_priceDelete()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
	
		$id = Input::get('id');
		$price = Model_Price::find($id);
		unlink(DOCROOT.'assets/prices/'.$price->source);
		$price->delete();
	
		Response::redirect('admin/prices');
	}
	
	public function action_news()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
		$this->template->title = 'Управление новостями';
	
		if (Input::get('edit')) {
			$news = Model_News::find(Input::get('id'));
		}
		if (!isset($news) || !$news) {
			$news = new Model_News();
		}
	
		$form = new AdminNewsForm();
		$form = $form->getForm();
		$form->populate($news, true);
	
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				$config = array(
						'path' => DOCROOT.'assets/img/news',
						'randomize' => true,
						'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
				);
	
				Upload::process($config);
	
	
				if (Upload::is_valid() || Input::post('source') == $news->source)
				{
					// save them according to the config
					$old_source = $news->source;
					if ($_FILES['source_file']['name'] && (Input::post('source') != $old_source || !Input::get('edit'))) {
						Upload::save();
	
						$files = Upload::get_files();
	
						if ($news->source && Input::post('source') != $news->source && Input::get('edit')) {
							unlink(DOCROOT.'assets/img/news/'.$news->source);
						}
	
						$o_width = 160;
						$o_height = 120;
						$filepath = $files[0]['saved_to'].$files[0]['saved_as'];
						Image::load($filepath)->resize($o_width, $o_height, false)->save($filepath);
					}
	
					$fields = $form->validated();
					$news->from_array($fields);
					if ($_FILES['source_file']['name'] && (Input::post('source') != $old_source || !Input::get('edit'))) {
						$news->source = $files[0]['saved_as'];
					}
					$news->save();
	
					if (!Input::get('edit')) {
						Session::set_flash('success', 'Новость добавлена успешно!');
					} else {
						Session::set_flash('success', 'Новость изменена успешно!');
					}
					Response::redirect('admin/news');
				} else {
					foreach (Upload::get_errors() as $file)
					{
						$error = $file['errors'][0]['message'];
					}
					Session::set_flash('error', $error);
				}
			}
		}
	
		$news = Model_News::find('all');
		$this->template->content = View::forge("admin/news", array(
				'form' => $form,
				'news' => $news,
		), false);
	}
	
	public function action_newsDelete()
	{
		if (!Auth::check()) {
			Response::redirect('');
		}
	
		$id = Input::get('id');
		$news = Model_News::find($id);
		if ($news->source) {
			unlink(DOCROOT.'assets/img/news/'.$news->source);
		}
	
		$news->delete();
	
		Response::redirect('admin/news');
	}
}