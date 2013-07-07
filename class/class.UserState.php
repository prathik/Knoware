<?php
class UserState extends UserStateManager {	
	public function is_user_logged_in() {
		return true;
	}

	public function register_user($username, $email, $password, $fullname) {
		if(!$this->is_username_used($username) && !$this->is_email_used($email)) {
			$mysql = new knoware_mysql();
			$password_hash = crypt($password);
			$mysql->insert_user( $username, $email, $password_hash, $fullname);
			$mysql->close();
			return true;
		} else {
			return false;
		}	
	}

	public function is_username_used($username) {
		$mysql = new knoware_mysql();
		$var = $mysql->query("SELECT username FROM users WHERE username = '{$username}'");
		if($var->num_rows == 0) {
			return false;
		} else {
			return true;
		}
		$mysql->close();
	}

	public function is_email_used($email) {
		$mysql = new knoware_mysql();
		$var = $mysql->query( "SELECT email FROM users WHERE email = '{$email}'");
		if($var->num_rows == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function change_password($oldpassword, $newpassword){ 
		return true;
	}

	public function sign_in_user($username, $password) {
		if( $this->is_username_used( $username ) ) {
			$mysql = new knoware_mysql();
			$var = $mysql->query( "SELECT password FROM users WHERE username = '{$username}'");
			$passwordObject = $var->fetch_row();
			if( crypt( $password, $passwordObject[0] ) == $passwordObject[0] ) {
				return true;
			}
		}
		return false;
	}

	public function delete_user($username) {
		return true;
	}
}
?>
