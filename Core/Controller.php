<?php

namespace Core;

abstract class Controller
{
	protected $route_params = [];

	public function __construct($params)
	{
		$this->route_params = $params;
	}
}
