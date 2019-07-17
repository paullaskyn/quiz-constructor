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

	$parameters = [];

	try {
		$route_config_path = '../config/routes.php';
		if (!file_exists($route_config_path))
			throw new Exception("Route configuration file not found.");
		$routes = require_once $route_config_path;
	} catch (Exception $e) {

    	die($e->getMessage());
	}

	function matchSearch(array $routes, array &$parameters)
	{
		$uri = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
		foreach ($routes as $key => $value) {
			if ($key == $uri[0]){
				$parameters = $value;
				return true;
			}
		}
		echo 'This route does not exist!';
	}

	function accessControl($parameters)
	{
		if ($parameters['template'] == 'admin' && !isset($_SESSION['user']))
			header('Location: /');
		else return true;
	}

	if (matchSearch($routes, $parameters) && accessControl($parameters)){
		try {
			$path_to_controller = 'controllers\\'.ucfirst($parameters['template']).'Controller';
			if (!class_exists($path_to_controller))
				throw new Exception('Layout controller class not found!');
			$controller = new $path_to_controller($parameters);
		} catch (Exception $e) {

			die($e->getMessage());
		}
	}
