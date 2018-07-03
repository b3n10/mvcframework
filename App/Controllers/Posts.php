<?php

namespace App\Controllers;

class Posts extends \Core\Controller
{
	public function newAction()
	{
		echo 'Hi from new method of Posts<br>';
		echo 'QS: <br><pre>';
		echo htmlspecialchars(print_r($this->route_params, true));
	}

	public function before()
	{
		echo 'before code';
		return true;
	}
}

