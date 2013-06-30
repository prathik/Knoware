<?php
abstract Class UserStateManager {
	abstract public function is_user_logged_in();
	abstract public function register_user($username, $email, $password);
	abstract public function is_username_used($username);
	abstract public function is_email_used($email);
	abstract public function change_password($oldpassword, $newpassword);
	abstract public function sign_in_user($username, $password);
	abstract public function delete_user($username);
}
?>
