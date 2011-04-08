<?php

require("../config.php");

$id=$_GET["id"];
$page=$_GET["page"];

$name = $db->getCategory($id);

echo '<h1>'.$name.'</h1>';

$ideas = $db->getCategoryIdeas($id, $page);

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
}

$ideasNum = $db->getNumberOfIdeasByCat($id);
$pages = ceil($ideasNum/ITEMS);

echo '<div class="pagination">';

for ($i=1; $i<=$pages; $i++)
{
echo '<button onclick="viewCategory('.$id.', '.$i.')"';
if ($i == $page) {
echo 'class="currentPage"';
}
echo '>'.$i.'</button>';
}

echo '</div>';

?>