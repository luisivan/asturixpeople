<?php

require("../config.php");

$id=$_GET["id"];

$idea = $db->getIdea($id);
$ui->idea($idea, false);
?>