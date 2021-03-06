<?php
// main entry point of app

// require_once dirname(__DIR__) . '/vendor/twig/twig/lib/Twig/Autoloader.php';

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

/*
	spl_autoload_register(function($class){
		// parent dir
		$root = dirname(__DIR__);
		// full path + filename
		$file = $root . '/' . str_replace('\\', '/', $class) . '.php';

		if (is_readable($file)) {
			require_once $file;

		}
	});
 */

// override PHP error and exception handlers
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();

$router->add('', [
	'controller'	=>	'Home',
	'action'			=>	'index'
]);
$router->add('posts', [
	'controller'	=>	'Posts',
	'action'			=>	'index'
]);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', [
	'namespace'	=>	'Admin'
]);

$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);
