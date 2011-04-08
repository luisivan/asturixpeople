<?php

require("../config.php");

$page=$_GET["page"];

echo '<h1>'. _('Last ideas') .'</h1>';

$ideas = $db->getNewIdeas($page);

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
}

$ideasNum = $db->getNumberOfIdeas();
$pages = ceil($ideasNum/ITEMS);

echo '<div class="pagination">';

for ($i=1; $i<=$pages; $i++)
{
echo '<button onclick="viewLastIdeas('.$i.')"';
if ($i == $page) {
echo 'class="currentPage"';
}
echo '>'.$i.'</button>';
}

echo '</div>';

?>