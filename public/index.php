<?php
// main entry point of app

require '../Core/Router.php';

$router = new Router();

$router->add('', [
	'controller'	=>	'Home',
	'action'			=>	'index'
]);
$router->add('posts', [
	'controller'	=>	'Posts',
	'action'			=>	'index'
]);
$router->add('posts/new', [
	'controller'	=>	'Posts',
	'action'			=>	'new'
]);

$url = $_SERVER['QUERY_STRING'];

$router->match($url);
var_dump($router->getParams());
