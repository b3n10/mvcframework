<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller {
	protected function before() {
		return true;
	}

	public function indexAction() {
		View::render('Home/index.php');
	}
}
