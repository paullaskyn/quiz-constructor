<?php

	namespace models;

	use core\Db;

	#-----------------------------------------
	#	Class for work with account.
	#	Signup, signin, recover methods,
	#	data change method and so on.
	#=========================================

	class Account extends Db
	{

		private $username;
		private $email;
		private $password;
		private $password_repeat;


		/**
		 * Assigning data from $_POST to private properties,
		 * running Db constructor and operation method
		 *
		 * @method __construct
		 *
		 * @param  string      $method_name [name of operation (signup , signin, recover, newpassword)]
		 */

		public function __construct(string $method_name)
		{
			$this->username 		= $_POST['username'] ?? false;
			$this->email 			= $_POST['email'] ?? false;
			$this->password 		= $_POST['password'] ?? false;
			$this->password_repeat  = $_POST['password_repeat'] ?? false;

			parent::__construct();
			$this->$method_name();
		}


		/**
		 * Adding user to database and $_SESSION if entered email does not exists.
		 *
		 * @method signupOperation
		 */

		public function signupOperation() : void
		{
			if ($this->checkEmail($this->email) == false)
				die(\json_encode(['error' => 'This email already exists!']));

			$add_user_query = 'INSERT INTO users(username, email, password, reg_date) VALUES(?, ?, ?, ?)';

			$values = [$this->username, $this->email,
				\crypt($this->password, \password_hash($this->password, PASSWORD_DEFAULT)),
				\date("Y-m-d H:i:s")
			];

			$this->query($add_user, $values);

			$this->addUserToSession($this->email);

			die(\json_encode('User successfully registered'));
		}


		/**
		 * Adding user to $_SESSION if entered email is exists
		 * and password_verify return true
		 *
		 * @method signinOperation
		 */

		public function signinOperation() : void
		{
			if ($this->checkEmail($this->email) != false)
				die(\json_encode(['error' => 'Email not found!']));

			$query = $this->query('SELECT password FROM users WHERE email = ?', [$this->email]);
			if (\password_verify($this->password, $query[0]['password']))
				$this->addUserToSession($this->email);
			else die(\json_encode(['error' => 'Password error']));

			die(\json_encode('User logged in'));
		}


		/**
		 * Sending recovery link if entered email is exists
		 *
		 * @method recoverOperation
		 */

		public function recoverOperation() : void
		{
			if ($this->checkEmail($this->email) != false)
				die(json_encode(['error' => 'Email not found!']));

			$hash = \password_hash($this->email, PASSWORD_DEFAULT);
			$user_id = $this->query('SELECT id FROM users WHERE email = ?', [$this->email])[0]['id'];

			$recovery_query = 'INSERT INTO restore(user_id, hash, datetime_restore) VALUES(?, ?, ?)';

			$values = [$user_id, $hash, \date("Y-m-d H:i:s")];

			$this->query($recovery_query, $values);

			$message  = "Use the following link to reset your password: <br>";
			$message .= "http://quiz-constructor/?recovery=$hash <br>";
			$message .= "If you don’t use this link within 3 hours, it will expire. <br>";

			#	We return the answer to the client before the completion
			#	of all operations to reduce the waiting time
			if (explode('/', $_SERVER['SERVER_SOFTWARE'])[0] == 'nginx'){

				# Some response to the client
				echo \json_encode('Mail sent');

				#	Save session data and close it
				\session_write_close();

				#	We send all the requested data to the client
				\fastcgi_finish_request();
			}

			#	Sending letter
			SendingMail::SendMail($this->email, 'Password recovery', $message);

			die(\json_encode('Mail sent'));
		}


		/**
		 * If the passwords match, check the presence of links in the database.
		 * If link is exists, write the hash of the new password to the database
		 *
		 * @method newpasswordOperation
		 */

		public function newpasswordOperation() : void
		{
			if ($this->password !== $this->password_repeat)
				die(\json_encode(['error' => 'Passwords do not match!']));

			$user_id = $this->query('SELECT user_id FROM restore WHERE hash = ? ', [$_POST['restore_hash']]);
			if ($user_id == false)
				die(\json_encode(['error' => 'Wrong link!']));

			$new_password = \crypt($this->password_repeat, \password_hash($this->password_repeat, PASSWORD_DEFAULT));

			$this->query('UPDATE users SET password = ? WHERE id = ? ', [$new_password, $user_id[0]['user_id']]);

			$this->query('DELETE FROM restore WHERE user_id = ?', [$user_id[0]['user_id']]);

			die(\json_encode('Password successfully changed'));
		}


		/**
		 * Checking email for existence
		 *
		 * @method checkEmail
		 *
		 * @return bool
		 */

		private function checkEmail() : bool
		{
			$query = $this->query('SELECT email FROM users WHERE email = ?', [$this->email]);
			if (!empty($query) && $query[0]['email'] == $this->email)
				return false;
			else return true;
		}


		/**
		 * Add user data to $_SESSION['user']
		 *
		 * @method addUserToSession
		 */

		private function addUserToSession() : void
		{
			$query = $this->query('SELECT * FROM users WHERE email = ?', [$this->email])[0];
			$_SESSION['user'] = [
				'id' => $query['id'],
				'username' => $query['username'],
				'email' => $this->email
			];
		}
	}
