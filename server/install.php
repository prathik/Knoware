<?php
require("config.php");
$mysql = new knoware_mysql();
$check = $mysql->mysql->query("SELECT 1 FROM thesis");
if($check === false) {
	echo 'Begin installation';
	$mysql->mysql->query("CREATE TABLE thesis (thesis_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, posted_on DATE NOT NULL, review_time DATE NOT NULL, title VARCHAR(200) NOT NULL, description TEXT, review_state VARCHAR(10) NOT NULL)");
} else {
	echo 'Looks like KnoWare is already installed';
}
$mysql->mysql->close();

?>
