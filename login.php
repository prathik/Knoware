<?php
require("class/knoware-load.php");
$user = new UserState();
if( isset( $_POST['login'] ) && $_POST['login'] == 'login' ) {
	$var = $user->sign_in_user( $_POST['username'], $_POST['password']);
	if( $var ) {
		header("Location: ./");
	} else {
		echo "Invalid username or password";
		echo "<br />Sorry about the design of this page - its being built.";
	}
}

if( isset($_GET['action']) && $_GET['action'] == 'logout' ) {
	if( $user->sign_out_user() ) {
		header("Location: ./");
	} 
}

if( isset( $_POST['register'] ) && $_POST['register'] == "register" ) {
	if( $user->register_user( $_POST['username'], $_POST['email'], $_POST['password'], $_POST['fullname'] ) ) {
		echo "You have been successfully registerd.";
		echo "<br />Page under construction.";
	}
}
?>
