<?php
	namespace controllers;

	use core\Controller;

	class OpenController extends Controller
	{
		# Array with data that will be sent to method
		# render of class View
		private $data = [];

		public function contentMethod(string $method_name)
		{
			$this->$method_name();
			$this->view->render($this->data);	
		}

		private function howtouse()
		{
			$this->data = [
				'name' => 'valya',
				'birthday' => '14.02.2000'
			];
		}

		private function mainpage()
		{
			$this->data = [
				'name' => 'paullaskyn',
				'birthday' => '26.02.2000'
			];
		}

	}
