<?php
// the router takes the requested URL (or route) and decides what to do with it (Controller)

namespace Core;

use Exception;

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
		$url = $this->removeQSVar($url);

		if ($this->match($url))
		{
			// include the namespace of the class
			$controller = $this->getNamespace() . $this->convertToStudlyCaps($this->params['controller']);

			// if class is already required
			if (class_exists($controller))
			{
				$controller_obj = new $controller($this->params);
				$action = $this->convertToCamelCase($this->params['action']);

				if (is_callable([$controller_obj, $action]))
				{
					$controller_obj->$action();
				}
				else
				{
					throw new Exception("Method $action not found in $controller class!");
				}
			}
			else
			{
				throw new Exception("$controller class doesn't exists");
			}
		}
		else
		{
			throw new Exception('No route matched!', 404);
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

	protected function removeQSVar($url)
	{
		if ($url != '')
		{
			$parts = explode('&', $url, 2);

			if (!strpos($parts[0], '='))
			{
				$url = $parts[0];
			}
			else
			{
				$url = '';
			}
		}

		return $url;
	}

	protected function getNamespace()
	{
		$namespace = 'App\Controllers\\';

		// if 'namespace' key is in params array
		if (array_key_exists('namespace', $this->params))
		{
			$namespace .= $this->params['namespace'] . '\\';
		}
		return $namespace;
	}

}
