<?php 
	# Disable caching
	header("Content-Type: text/html; charset=utf-8");
	header("Expires: Thu, 26 Feb 1998 06:24:20 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Cache-Control: post-check=0,pre-check=0");
	header("Cache-Control: max-age=0");
	header("Pragma: no-cache");
	
	# Enable the display of all errors in the browser
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	session_start();

	spl_autoload_register(function($class){
		$path_to_class = str_replace('\\', '/', $class.'.php');
		if (file_exists($path_to_class)) require_once $path_to_class;
	});

	/*
		If the route from URL is found in the config
		Router transfers the necessary parameters to the controller
	*/

	# In $parameters are storing parameters only for current route
	$parameters = [];

	# Absolutely all routes and their parameters from the config are stored in array $routes
	try {
		$route_config_path = '../config/routes.php';
		if (!file_exists($route_config_path))
			throw new Exception("Route configuration file not found.");
		$routes = require_once $route_config_path;
	} catch (Exception $e) {
		# Later I will make a beautiful error page and show errors there
		# for now...
    	die($e->getMessage());
	}
	
	/* 
		Check the route for availability. 
		If exists, save the route parameters to the $parameters
		If not, display page 404.
	*/
	function match_search(array $routes, array &$parameters)
	{
		$uri = trim($_SERVER['REQUEST_URI'], '/');
		foreach ($routes as $key => $value) {
			if ($key == $uri){
				$parameters = $value;
				return true;
			}
		}
		echo 'This route does not exist!';
	}

	# So far this function is not needed.
	/*
	function access_control()
	{
		if($this->parameters['template'] == 'admin' && !isset($_SESSION['user'])) return false;
		else return true;
	}
	*/

	/* 
		Create the object of template controller class 
		and call the method that refers to the model 
		for data and transfers it to the render class View
	*/
	if (match_search($routes, $parameters) /*&& access_control()*/){
		try {
			$path_to_controller = 'controllers\\'.ucfirst($parameters['template']).'Controller';
			if (!class_exists($path_to_controller))
				throw new Exception('Layout controller class not found!');
			$controller = new $path_to_controller($parameters);
			$controller->contentMethod($parameters['page']);
		} catch (Exception $e) {
			# Later I will make a beautiful error page and show errors there
			# for now...
			die($e->getMessage());
		}
	}
