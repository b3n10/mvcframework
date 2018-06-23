<?php
// the router takes the requested URL (or route) and decides what to do with it

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
	public function add($route, $params)
	{
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
		foreach ($this->routes as $route => $params)
		{
			if ($url === $route)
			{
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
}
