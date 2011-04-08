<?php

require("../config.php");

$user=$_POST["user"];
$email=$_POST["email"];
$name=$_POST["name"];
$info=$_POST["info"];
$photo=$_POST["photo"];

if (isset($_SESSION['user']) && $_SESSION['user'] == $db->getUsername($_SESSION["userid"])) {
	$db->updateUser($_SESSION["userid"], $user, $email, $name, $info, $photo);
	$_SESSION["userid"] = $db->getId($user);
	$_SESSION["user"] = $user;
	$_SESSION["email"] = $email;
	$_SESSION["name"] = $name;
	$_SESSION["info"] = $info;
	$_SESSION["photo"] = $photo;
}
?>