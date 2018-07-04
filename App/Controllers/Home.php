<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller {
	protected function before() {
		return true;
	}

	public function indexAction() {
		View::renderTemplate('Home/index.html', [
			'username'		=>	'Ben Lleve',
			'faithgoals'	=>	[
				'php dev',
				'family car',
				'new disciple'
			]
		]);
	}
}
