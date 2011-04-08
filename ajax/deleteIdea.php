<?php

require("../config.php");

$id=$_GET["id"];

if (isset($_SESSION['user']) && $_SESSION['user'] == $db->getUsername($_SESSION["userid"])) {

$db->deleteIdea($id);

}
?>