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

		public function __construct(string $method_name)
		{
			$this->username 		= $_POST['username'] ?? false;
			$this->email 			= $_POST['email'] ?? false;
			$this->password 		= $_POST['password'] ?? false;
			$this->password_repeat  = $_POST['password_repeat'] ?? false;

			parent::__construct();
			$this->$method_name();
		}


		public function signupOperation() : void
		{
			$add_user = 'INSERT INTO users(username, email, password, reg_date) VALUES(:username, :email, :password, :reg_date)';

			$var_values = [
				'username' => $this->username,
				'email' => $this->email,
				'password' => crypt($this->password, password_hash($this->password, PASSWORD_DEFAULT)),
				'reg_date' => date("Y-m-d H:i:s")
			];

			if ($this->checkEmail($this->email) == false)
				die(json_encode(['error' => 'This email already exists!']));

			#	If email does not exists, insert this user
			$this->query($add_user, $var_values);

			$this->addUserToSession($this->email);

			die(json_encode('User successfully registered'));
		}


		public function signinOperation() : void
		{
			if ($this->checkEmail($this->email) != false)
				die(json_encode(['error' => 'Email not found!']));

			$query = $this->query('SELECT password FROM users WHERE email = ?', [$this->email]);
			if (password_verify($this->password, $query[0]['password']))
				$this->addUserToSession($this->email);
			else die(json_encode(['error' => 'Password error']));

			die(json_encode('User logged in'));
		}


		public function recoverOperation() : void
		{
			if ($this->checkEmail($this->email) != false)
				die(json_encode(['error' => 'Email not found!']));

			$hash = \password_hash($this->email, PASSWORD_DEFAULT);
			$user_id = $this->query('SELECT id FROM users WHERE email = ?', [$this->email])[0]['id'];

			$restore_query = 'INSERT INTO restore(user_id, hash, datetime_restore) VALUES(:user_id, :hash, :datetime_restore)';

			$restore_arr = [
				'user_id' => $user_id,
				'hash' => $hash,
				'datetime_restore' => date("Y-m-d H:i:s")
			];

			$query = $this->query($restore_query, $restore_arr);

			if ($query == false)
				die(\json_encode(['error' => 'Database write error!']));

			$message  = "Use the following link to reset your password: <br>";
			$message .= "http://quiz-constructor/?recovery=$hash <br>";
			$message .= "If you don’t use this link within 3 hours, it will expire. <br>";

			SendingMail::SendMail($this->email, 'Password recovery', $message);

			die(json_encode('Mail sent'));
		}


		public function newpasswordOperation() : void
		{
			if ($this->password !== $this->password_repeat)
				die(\json_encode(['error' => 'Passwords do not match!']));

			$user_id = $this->query('SELECT user_id FROM restore WHERE hash = ? ', [$_POST['restore_hash']]);
			if ($user_id == false)
				die(\json_encode(['error' => 'Wrong link!']));

			$new_password = crypt($this->password_repeat, password_hash($this->password_repeat, PASSWORD_DEFAULT));

			$this->query('UPDATE users SET password = ? WHERE id = ? ', [$new_password, $user_id[0]['user_id']]);
			
			$this->query('DELETE FROM restore WHERE user_id = ?', [$user_id[0]['user_id']]);

			die(\json_encode('Password successfully changed'));
		}

		#	checking email for existence
		private function checkEmail() : bool
		{
			$query = $this->query('SELECT email FROM users WHERE email = ?', [$this->email]);
			if (!empty($query) && $query[0]['email'] == $this->email)
				return false;
			else return true;
		}


		#	add user data to $_SESSION['user']
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
