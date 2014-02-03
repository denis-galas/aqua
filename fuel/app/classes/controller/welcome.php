<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller_Template
{

	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		$this->template->title = 'Главная';
		$news = Model_News::find('all', array('order_by' => array('id' => 'desc')));
		$this->template->content = View::forge("welcome/index", array(
			'news' => $news,		
		), false);
	}
	
	public function action_prices()
	{
		$this->template->title = 'Прайсы';
		$prices = Model_Price::find('all');
		
		$this->template->content = View::forge("welcome/prices", array(
			'prices' => $prices,		
		), false);
	}
	
	public function action_about()
	{
		$this->template->title = 'О нас';
		
		$this->template->content = View::forge("welcome/about", array(), false);
	}
	
	public function action_contact()
	{
		$this->template->title = 'Сделать заказ';
		$form = new ContactForm();
		$form = $form->getForm();
		if (Input::method() == 'POST') {
			$form->validation()->run();
			// if validated, login the user
			if (!$form->validation()->error())
			{
				$subject = Input::post('subject');
				$message = Input::post('message');
	
				$config = array(
						'path' => DOCROOT.'assets/attaches',
						'randomize' => true
				);
	
				Upload::process($config);
	
				Upload::save();
				$files = Upload::get_files();
				$email = Email::forge();
				$email->from('noreply@mail.labeo.com.ua', 'labeo.com.ua');
				$email->to(array('galas2008@gmail.com', 'jefff77@rambler.ru'));
				$email->subject($subject);
				$email->html_body($message);
				if (!empty($files)) {
					$file = $files[0];
					$email->attach($file['saved_to'].$file['saved_as'], false, null, null, $file['name']);
					unlink($file['saved_to'].$file['saved_as']);
				}
				if ($email->send()) {
					Session::set_flash('success', 'Ваш заказ был успешно отправлен!');
				} else {
					Session::set_flash('error', 'Ваш заказ не был отправлен, произошла какая-то ошибка!');
				}
	
				Response::redirect('contact');
			}
				
			$form->repopulate();
		}
	
		$this->template->content = View::forge("welcome/contact", array(
				'form' => $form,
		), false);
	}
	
	public function action_gallery()
	{
		$this->template->title = 'Галлерея';
		$photos = Model_Gallery::getBySort($this->param('category', 'all'));
		$category = '';
		if ($this->param('category', 'all') != 'all') {
			$category = Model_Fcategory::find($this->param('category'));
		}
		
		$this->template->content = View::forge("welcome/gallery", array(
			'photos' => $photos,
			'category' => $category,		
		), false);
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		$this->template->title = '';
		$this->template->content = View::forge("welcome/404", array(), false);
// 		return Response::forge(ViewModel::forge('welcome/404'), 404);
	}
}
