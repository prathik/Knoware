<?php
require("class/knoware-load.php");
$user = new UserState();
if($user->is_user_logged_in()) {
	require("template/index.php");
} else {
	require("template/login.php");
}
?>
