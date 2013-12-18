<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
	'Orm\\Observer_GenerateSaltAndPassword' => APPPATH.'classes/observer/Observer_GenerateSaltAndPassword.php',
	'BaseForm' => APPPATH.'classes/form/base/base_form.php',
	'AdminRegisterForm' => APPPATH.'classes/form/admin_register.php',
	'AdminLoginForm' => APPPATH.'classes/form/admin_login.php',
	'AdminCategoryForm' => APPPATH.'classes/form/admin_category.php',
	'AdminSlideForm' => APPPATH.'classes/form/admin_slide.php',
	'AdminGalleryForm' => APPPATH.'classes/form/admin_gallery.php',
	'AdminPriceForm' => APPPATH.'classes/form/admin_price.php',
	'ContactForm' => APPPATH.'classes/form/contact.php',
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
