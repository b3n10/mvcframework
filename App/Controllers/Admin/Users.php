<?php

namespace App\Controllers\Admin;

class Users extends \Core\Controller
{
	public function indexAction()
	{
		echo 'This is index from Users';
	}

	protected function before()
	{
		echo 'this is before <br>';
		return true;
	}
}
