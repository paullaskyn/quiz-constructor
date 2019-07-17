<?php

	namespace models;

	#----------------------------------
	#	Class of open layout model.
	#	Includes sign up, sign in,
	#	recover password methods
	#==================================

	class OpenModel
	{
		private $validation;
		private $account;

		public function __construct()
		{
			
			if (isset($_POST['operation'])){

				$this->validation = new DataValidation($_POST);

				$this->account = new Account($_POST['operation'] . 'Operation');
				if (!\method_exists($this->account->$_POST['operation'] . 'Operation'))
					die(\json_encode(['error' => 'Operation failed!']));

			}
		}
	}
