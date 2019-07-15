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

		/**
		 * @method userSignUp
		 *
		 * @param  string     $this->username [description]
		 * @param  string     $this->email    [description]
		 * @param  string     $password [description]
		 */

		public function userSignUp() : void
		{
			$add_user = 'INSERT INTO users(username, email, password, reg_date)
					VALUES(:username, :email, :password, :reg_date)';

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


		public function userSignIn() : void
		{
			if ($this->checkEmail($this->email) != false)
				die(json_encode(['error' => 'Email not found!']));

			$query = $this->query('SELECT password FROM users WHERE email = ?', [$this->email]);
			if (password_verify($this->password, $query[0]['password']))
				$this->addUserToSession($this->email);
			else die(json_encode(['error' => 'Password error']));

			die(json_encode('User logged in'));
		}

		public function recoverMailSend()
		{
			/*if ($this->checkEmail($this->email) != false)
				die(json_encode(['error' => 'Email not found!']));*/
			die('mail sent');
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


		public function recoverPasswordNew()
		{

		}
	}
