<?php

require("../config.php");

$user=$_GET["user"];
$pass=$_GET["pass"];

if($auth->login($user, $pass))
{
    echo $auth->loginBar(true);
}
else
{
    echo $auth->loginBar(false);
}
?>