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
		$this->template->content = View::forge("welcome/index", array(), false);
	}
	
	public function action_prices()
	{
		$this->template->title = 'Прайсы';
		$prices = Model_Price::find('all');
		
		$this->template->content = View::forge("welcome/prices", array(
			'prices' => $prices,		
		), false);
	}
	
	public function action_contacts()
	{
		$this->template->title = 'Контакты';
		$this->template->content = View::forge("welcome/contacts", array(), false);
	}
	
	public function action_gallery()
	{
		$this->template->title = 'Галлерея';
		$photos = Model_Gallery::getBySort($this->param('category', 'all'));
		$category = '';
		if ($this->param('category', 'all') != 'all') {
			$category = Model_Fcategory::find($this->param('category'));
			$category = $category->title;
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
