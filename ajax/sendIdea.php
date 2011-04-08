<?php

require("../config.php");

$name=$_POST["name"];
$description=$_POST["description"];
$cat=$_POST["category"];

if (isset($_SESSION['user']) && $_SESSION['user'] == $db->getUsername($_SESSION["userid"])) {

	$db->writeIdea($name, $description, $_SESSION['user'], $cat);
}
?>