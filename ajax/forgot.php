<?php

require("../config.php");

$email=$_POST["email"];

$auth->forgotPassword($email);
?>