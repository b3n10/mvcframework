<?php

namespace Core;

use Exception;

abstract class Controller {

	protected $route_params = [];

	public function __construct($params) {
		$this->route_params = $params;
	}

	public function __call($name, $args) {
		$method = $name . 'Action';

		if (method_exists($this, $method)) {

			if ($this->before()) {
				call_user_func_array([$this, $method], $args);
				$this->after();
			}

		} else {
			throw new Exception("Method '$name' doesn't exists in '" . get_class($this) . "'");
		}
	}

	protected function before() {}

	protected function after() {}

}
