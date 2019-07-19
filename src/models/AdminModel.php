<?php

	namespace models;

	class AdminModel
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

				userdata\DataValidation::startValidate();

				$account = new userdata\Account($_POST['operation'] . 'Operation');
			}
		}

	}
