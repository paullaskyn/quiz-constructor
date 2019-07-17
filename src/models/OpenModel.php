<?php

	namespace models;

	#----------------------------------
	#	Class of open layout model.
	#	Includes sign up, sign in,
	#	recover password methods
	#==================================

	class OpenModel
	{


		/**
		 * If the user performed the operation(signup, signin, recover, newpassword),
		 * we start data checking and running operation method from class Account
		 *
		 * @method __construct
		 */

		public function __construct()
		{
			if (isset($_POST['operation'])){

				DataValidation::startValidate();

				$account = new Account($_POST['operation'] . 'Operation');
				if (!\method_exists($account->$_POST['operation'] . 'Operation'))
					die(\json_encode(['error' => 'Operation failed!']));

			}
		}
	}
