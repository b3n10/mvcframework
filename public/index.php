<?php
// main entry point of app

require '../Core/Router.php';
require '../App/Controllers/Posts.php';

$router = new Router();

$router->add('', [
	'controller'	=>	'Home',
	'action'			=>	'index'
]);
$router->add('posts', [
	'controller'	=>	'Posts',
	'action'			=>	'index'
]);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');

$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);
