<?php

require("../config.php");

if (isset($_SESSION['user']) && $_SESSION['user'] == $db->getUsername($_SESSION["userid"])) {

$db->deleteUserById($_SESSION["userid"]);

}
?>