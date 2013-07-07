<?php
require("class/knoware-load.php");
$user = new UserState();
if( isset( $_POST['login'] ) && $_POST['login'] == 'login' ) {
	$var = $user->sign_in_user( $_POST['username'], $_POST['password']);
	if( $var ) {
		header("Location: ./");
	} else {
		header("Location: ./");
	}
}

if( isset($_GET['action']) && $_GET['action'] == 'logout' ) {
	if( $user->sign_out_user() ) {
		header("Location: ./");
	}
}

if( isset( $_POST['register'] ) && $_POST['register'] == "register" ) {

}
?>
