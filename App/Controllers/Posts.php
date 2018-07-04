<?php

namespace App\Controllers;

use \Core\View;

class Posts extends \Core\Controller {

	public function indexAction() {
		View::renderTemplate('Posts/index.html', [
			'username'	=>	'Ben Lleve',
			'posts'			=>	[]
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

