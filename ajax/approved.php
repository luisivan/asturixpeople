<?php

require("../config.php");

$page=$_GET["page"];

echo '<h1>'. _('Approved ideas') .'</h1>';

$ideas = $db->getApprovedIdeas($page);

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
}

$ideasNum = $db->getNumberOfApprovedIdeas();
$pages = ceil($ideasNum/ITEMS);

echo '<div class="pagination">';

for ($i=1; $i<=$pages; $i++)
{
echo '<button onclick="viewApprovedIdeas('.$i.')"';
if ($i == $page) {
echo 'class="currentPage"';
}
echo '>'.$i.'</button>';
}

echo '</div>';

?>