<?php

require("../config.php");

$ideas = $db->getIdeas();

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
}
?>