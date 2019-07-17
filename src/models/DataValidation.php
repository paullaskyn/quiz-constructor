<?php

	namespace models;

	#------------------------------------------------
	#	Class for data validation coming from
	#	forms sign up, sign in, recover and
	#	from profile page
	#================================================

	class DataValidation
	{

		const USERNAME_ERROR = "Only letters are available! From 2 to 32 characters.\n";
		const EMAIL_ERROR = "Enter your email in the correct format!\n";
		const PASSWORD_ERROR = "Minimum password length 8 characters, maximum - 64!\n";
		const PASS_COMP_ERROR = "Passwords don't coincide!\n";


		public static function startValidate()
		{
			foreach ($_POST as $key => $value){
				if ($key == 'username')
					self::usernameValidation($value);
				elseif ($key == 'email')
					self::emailValidation($value);
				elseif ($key == 'password' || $key == 'password_repeat')
					self::passwordValidation($value);
			}
		}

		private static function usernameValidation(string $username)
		{
			if( preg_match('/^[a-zA-Zа-яА-Я]+$/ui', $username) == 0 ||
				mb_strlen($username) > 32 ||
				mb_strlen($username) < 2)
				exit(json_encode(['error' => self::USERNAME_ERROR]));
		}

		private static function emailValidation(string $email)
		{
			if ( preg_match('/[A-z_\-0-9]+@[A-z_\-0-9]+\.[A-z_\-0-9]+/', $email) == 0)
				exit(json_encode(['error' => self::EMAIL_ERROR]));
		}

		private static function passwordValidation(string $password){
			if( mb_strlen($password) > 64 || mb_strlen($password) < 8 )
				exit(json_encode(['error' => self::PASSWORD_ERROR]));
		}
	}
