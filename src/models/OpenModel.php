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

				switch ($_POST['operation']){
					case 'signup': $this->account = new Account('userSignUp');
					break;
					case 'signin': $this->account = new Account('userSignIn');
					break;
					case 'recover': $this->account = new Account('recoverMailSend');
					break;
					case 'newpassword': $this->newpasswordOperation();
					break;
					default: exit(json_encode(['error' => 'Operation failed!']));
					break;
				}
			}
		}

		private function newpasswordOperation()
		{

		}
	}
