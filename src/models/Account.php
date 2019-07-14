<?php
	namespace models;

	use core\Model;

	#-----------------------------------------
	#	Class for work with account.
	#	Signup, signin, recover methods,
	#	data change method and so on.
	#=========================================

	class Account extends Model
	{

		public function userSignUp(string $username, string $email, string $password) : void
		{

			$add_user = 'INSERT INTO users(username, email, password, reg_date) 
					VALUES(:username, :email, :password, :reg_date)';

			$select_userdata = 'SELECT email FROM users WHERE email = ?';
			$select_userid = 'SELECT id FROM users WHERE email = ?';

			$var_values = [
				'username' => $username,
				'email' => $email,
				'password' => $password,
				'reg_date' => date("Y-m-d H:i:s")
			];


			#	checking email for existence
			$query = $this->query($select_userdata, [$email]);
			if (!empty($query) && $query[0]['email'] == $email)
				die(json_encode(['error' => 'This email already exists.!'])); 


			#	If email does not exists, insert this user
			$this->query($add_user, $var_values);


			#	add user data to $_SESSION['user']
			$user_id = $this->query($select_userid, [$email])[0]['id'];

			$_SESSION['user'] = [
				'id' => $user_id,
				'username' => $username,
				'email' => $email
			];
		}

		public function userSignIn(string $email, string $password)
		{
			
		}

		public function recoverMailSend(string $email)
		{
			
		}

		public function recoverPasswordNew(string $password, string $password_repeat)
		{
			
		}
	}

