<?php

require("../config.php");

$page=$_GET["page"];

echo '<h1>'. _('Hot ideas') .'</h1>';

$ideas = $db->getHotIdeas($page);

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
}

$ideasNum = $db->getNumberOfHotIdeas();
$pages = ceil($ideasNum/ITEMS);

echo '<div class="pagination">';

for ($i=1; $i<=$pages; $i++)
{
echo '<button onclick="viewHotIdeas('.$i.')"';
if ($i == $page) {
echo 'class="currentPage"';
}
echo '>'.$i.'</button>';
}

echo '</div>';

?>