<?php

require("../config.php");

$user=$_GET["user"];

$user = $db->getUser($db->getId($user));

$ui->user($user, false);

echo '<h1>'. _('Ideas') .'</h1>';

$ideas = $db->search($user, 1);

$numIdeas = 0;

while ($idea = $ideas->fetch_array(MYSQLI_ASSOC)) 
{
$ui->idea($idea, true);
$numIdeas = 1;
}
if ($numIdeas == 0) {
echo '<h2>'. _('This user has not sent ideas') .'</h2>';
} else {
echo '<script>$("#content").highlight("'.$user.'", "highlight");</script>';
}

$ideasNum = $db->getNumberOfSearchResults($user);
$pages = ceil($ideasNum/ITEMS);

echo '<div class="pagination">';

for ($i=1; $i<=$pages; $i++)
{
echo '<button onclick="search(\''.$user.'\','.$i.')"';
if ($i == $page) {
echo 'class="currentPage"';
}
echo '>'.$i.'</button>';
}

echo '</div>';
?>