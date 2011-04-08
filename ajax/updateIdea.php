<?php

require("../config.php");

$id=$_POST["id"];
$name=$_POST["name"];
$description=$_POST["description"];
$open=$_POST["open"];
$cat=$_POST["category"];

//if (isset($_SESSION['user']) && $_SESSION['user'] == $db->getUsername($_SESSION["userid"])) {
if ($db->isIdeaCreator($_SESSION['user'], $id))
{
	$db->updateIdea($id, $name, $description, $open, $cat);
}
?>