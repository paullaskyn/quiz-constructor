<?php
	namespace controllers;

	use core\Controller;

	class AdminController extends Controller
	{
		# Array with data that will be sent to method
		# render of class View
		protected $data = ['controller' => 'Admin'];


		/**
		 * method of page, that generate data for rendering this page
		 *
		 * @method profile
		 */

		protected function profile() : void
		{
			$this->data = \array_merge($this->data,  ['page' => 'profile']);
		}
	}
