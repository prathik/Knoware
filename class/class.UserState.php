<?php
class UserState extends UserStateManager {
	public function is_user_logged_in() {
		return true;
	}

	public function register_user($username, $email, $password, $fullname) {
		if(!$this->is_username_used($username) && !$this->is_email_used($email)) {
			$mysql = new knoware_mysql();
			$password_hash = crypt($password);
			$mysql->query("INSERT INTO users VALUES (NULL, '{$username}', '{$email}', '{$password_hash}', '{$fullname}')");
			$mysql->close();
			return true;
		} else {
			return false;
		}	
	}

	public function is_username_used($username) {
		return false;
	}

	public function is_email_used($email) {
		return false;
	}

	public function change_password($oldpassword, $newpassword){ 
		return true;
	}

	public function sign_in_user($username, $password) {
		return true;
	}

	public function delete_user($username) {
		return true;
	}
}
?>
