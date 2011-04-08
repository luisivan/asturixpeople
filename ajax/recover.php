<?php

require("../config.php");

$email=$_POST["email"];
$hash=$_POST["hash"];

$auth->recoverPassword($email, $hash);
?>