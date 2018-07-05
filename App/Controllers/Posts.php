<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Post;

class Posts extends \Core\Controller {

	public function indexAction() {
		$posts = Post::getAll();

		View::renderTemplate('Posts/index.html', [
			'username'	=>	'Ben Lleve',
			'posts'			=>	$posts
		]);
	}

	public function newAction() {
		echo 'Hi from new method of Posts<br>';
		echo 'QS: <br><pre>';
		echo htmlspecialchars(print_r($this->route_params, true));
	}

	public function before() {
		return true;
	}

}

