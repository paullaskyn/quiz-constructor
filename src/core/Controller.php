<?php
	namespace core;

	/*
		Base class Controller, that loading model of necessary page,
		creates an object of class View(rendering of pages) and storing parameters of route
	*/

	class Controller 
	{
		public $parameters;
		public $view;
		public $model;

		public function __construct(array $params)
		{
			$this->loadModel($params['template']);
			$this->parameters = $params;
			$this->view = new View($params);
		}

		final private function loadModel(string $model)
		{
			try {
				$path_to_model = 'models\\'.ucfirst($model).'Model';
				if (!class_exists($path_to_model))
					throw new \Exception('Layout model class not found!');
				$this->model = new $path_to_model;
			} catch (\Exception $e) {
				# Later I will make a beautiful error page and show errors there
				# for now...
				die($e->getMessage());
			}
		}
	}