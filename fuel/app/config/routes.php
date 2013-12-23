<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'prices'   => 'welcome/prices',
	'contact'   => 'welcome/contact',
	'about'   => 'welcome/about',
	'admin'   => 'admin/login',
	'gallery/:category'   => 'welcome/gallery',		
		
);