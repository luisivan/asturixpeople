<?php

require("../config.php");

$pass=$_POST["pass"];

if (isset($_SESSION['user'])) {
	$db->updatePassword($_SESSION["userid"], $pass);
	$_SESSION["pass"] = $pass;
}

?>