<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
// 	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'prices'   => array('welcome/prices', 'name' => 'prices'),
	'news'   => array('welcome/news', 'name' => 'news'),
	'contact'   => array('welcome/contact', 'name' => 'contact'),
	'about'   => array('welcome/about', 'name' => 'about'),
	'admin'   => array('admin/login', 'name' => 'admin'),
	'gallery/:category'   => array('welcome/gallery', 'name' => 'gallery'),		
		
);