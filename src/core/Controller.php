<?php
	namespace core;

	/*
		Base class Controller, that loading model of necessary page,
		creates an object of class View(rendering of pages) and storing parameters of route
	*/

	class Controller
	{

		/**
		 * Stores an instance of the model class
		 */
		public $model;


		/**
		 * Stores data that will be used to render the page
		 */

		protected $data = [];


		/**
		 * Object of class View, which is used for rendering
		 *
		 * @var [View]
		 */

		private $view;


		/**
		 * loading model class of current layout,
		 * creating an instance of the class View
		 *
		 * @method __construct
		 *
		 * @param  array       $params [array with config of current route]
		 */

		public function __construct(array $params)
		{
			if (isset($_POST['logout'])){
				unset($_SESSION['user']);
				die(\json_encode('User logout'));
			}

			$this->loadModel($params['template']);
			$this->view = new View($params);
			$this->contentMethod($params['page']);
		}


		/**
		 * If we find a method for the current page,
		 * launch it, and then render the page
		 *
		 * @method contentMethod
		 *
		 * @param  string        $method_name  [name of page]
		 */

		private function contentMethod(string $method_name) : void
		{
			if (\method_exists($this, $method_name))
				$this->$method_name();
			$this->view->render($this->data);
		}


		/**
		 * Method that loading model class of current layout
		 *
		 * @method loadModel
		 *
		 * @param  string    $model [name of layout]
		 */

		private function loadModel(string $model) : void
		{
			try {
				$path_to_model = 'models\\'.ucfirst($model).'Model';
				if (!\class_exists($path_to_model))
					throw new \Exception('Layout model class not found!');
				$this->model = new $path_to_model;
			} catch (\Exception $e) {
				# Later I will make a beautiful error page and show errors there
				# for now...
				die($e->getMessage());
			}
		}
	}
