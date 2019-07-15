<?php
	namespace controllers;

	use core\Controller;

	class AdminController extends Controller
	{
		# Array with data that will be sent to method
		# render of class View
		private $data = [];

		public function contentMethod(string $method_name)
		{
			$this->$method_name();
			$this->view->render($this->data);
		}

		private function profile()
		{
			$this->data = [
				'name' => 'valya',
				'birthday' => '14.02.2000'
			];
		}

	}
