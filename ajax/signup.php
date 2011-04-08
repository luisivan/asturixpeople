<?php

require("../config.php");

$user=$_POST["user"];
$pass=$_POST["pass"];
$email=$_POST["email"];
$name=$_POST["name"];
$info=$_POST["info"];
$photo=$_POST["photo"];

$auth->signUp($db->writeUser($user, $pass, $email, $name, $info, $photo));
?>