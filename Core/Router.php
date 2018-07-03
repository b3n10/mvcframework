<?php
// the router takes the requested URL (or route) and decides what to do with it (Controller)

class Router
{
	/**
	 * Associative array of routes (the routing table)
	 * @var array
	 */
	protected $routes = [];

	/**
	 * Parameters from the matched route
	 * @var array
	 */
	protected $params = [];

	/**
	 * Add a route to the routing table
	 *
	 * @param string	$route	The Route URL
	 * @param array		$params	Parameters (controller, action, etc.))
	 *
	 * @return void
	 */
	public function add($route, $params = [])
	{
		// Escape forward slashes
		$route = preg_replace('/\//', '\\/', $route);

		// Convert variables (ex: controller)
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

		// Convert variables that only has custom regex
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

		// Add start, end delimiters, case insensitive flag
		$route = '/^' . $route . '$/i';

		$this->routes[$route] = $params;
	}

	/**
	 * Get routes from the routing table
	 *
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * Match the requested URL to the routes in the routing table ($routes), setting the $params property if a route is found
	 *
	 * @param string $url The route URL
	 *
	 * @return boolean true if a match is found, otherwise false
	 */
	public function match($url)
	{
		// get all regex from routing table
		foreach ($this->routes as $route => $params)
		{
			// check if url matches regex
			if (preg_match($route, $url, $matches))
			{
				// e.g. $matches:
				// [controller] => url1
				// [action] => url2
				foreach ($matches as $key => $value)
				{
					if (is_string($key))
					{
						$params[$key] = $value;
					}
				}
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	/**
	 * Get the currently matched params
	 *
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

	public function dispatch($url)
	{
		if ($this->match($url))
		{
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);

			if (class_exists($controller))
			{
				$controller_obj = new $controller();
				$action = $this->convertToCamelCase($this->params['action']);

				if (is_callable([$controller_obj, $action]))
				{
					$controller_obj->$action();
				}
				else
				{
					echo "Method $action not found in $controller class!";
				}
			}
			else
			{
				echo "$controller class doesn't exists";
			}
		}
		else
		{
			echo 'No route matched!';
		}
	}

	public function convertToStudlyCaps($class)
	{
		return str_replace('-', '', ucwords($class, '-'));
	}

	public function convertToCamelCase($action)
	{
		return str_replace('-', '', lcfirst($action));
	}
}
