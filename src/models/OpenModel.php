<?php
	namespace models;

	use core\Model;

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

				$this->account = new Account();

				switch ($_POST['operation']){
					case 'signup': $this->signupOperation();
					break;
					case 'signin': $this->signinOperation();
					break;
					case 'recover': $this->recoverOperation();
					break;
					case 'newpassword': $this->newpasswordOperation();
					break;
					default: exit(json_encode(['error' => 'Operation failed!']));
					break;
				}
				
			}
		}

		private function signupOperation()
		{
			$this->account->userSignUp($_POST['username'], $_POST['email'], $_POST['password']);
			exit(json_encode('User successfully registered'));
		}

		private function signinOperation()
		{
			
		}

		private function recoverOperation()
		{
			
		}

		private function newpasswordOperation()
		{
			
		}
	}