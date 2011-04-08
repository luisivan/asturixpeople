<?php

require("../config.php");

$user=$_GET["user"];

$user = $db->getUser($db->getId($user));

$ui->user($user, false);
?>