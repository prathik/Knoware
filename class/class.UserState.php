<?php
class UserState extends UserStateManager {	
	public function is_user_logged_in() {
		if(isset($_COOKIE['auth']) && isset($_COOKIE['user_id'])) {
			$auth_hash = $_COOKIE['auth'];
			$user_id = $_COOKIE['user_id'];	
			$mysql = new knoware_mysql();
			$var = $mysql->query( "SELECT username, email FROM users WHERE user_id = {$user_id}" );
			if( $var->num_rows == 1 ) {
				$result = $var->fetch_row();
				if( crypt( $result[1].$result[0].SALT.$user_id, $auth_hash ) == $auth_hash ) {
					return true;
				}
			}
			$mysql->close();
		}
 
		return false;
		
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
		$mysql->close();
	}

	public function change_password($oldpassword, $newpassword){ 
		return true;
	}

	public function sign_in_user($username, $password) {
		if( $this->is_username_used( $username ) ) {
			$mysql = new knoware_mysql();
			$var = $mysql->query( "SELECT password, email, user_id FROM users WHERE username = '{$username}'");
			$userMysqlObject = $var->fetch_row();
			if( crypt( $password, $userMysqlObject[0] ) == $userMysqlObject[0] ) {
				setcookie( 'auth', crypt ( $userMysqlObject[1].$username.SALT.$userMysqlObject[2] ), time() + 604800, '/');
				setcookie( 'user_id', $userMysqlObject[2], time() + 604800, '/' ); 
				return true;
			}
			$mysql->close();
		}
		return false;
	}

	public function delete_user($username) {
		return true;
	}

	public function sign_out_user() {
		if( isset( $_COOKIE['auth'] ) ) {
			setcookie( 'auth', '', time() - 3600, '/' );
		}
		if( isset( $_COOKIE[ 'user_id' ] ) ) {
			setcookie( 'user_id', '', time() -3600, '/' );
		}
		return true;
	}
}
?>
