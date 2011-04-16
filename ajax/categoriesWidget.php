<?php
require("../config.php");
$cats = $db->getCategories();
while ($cat = $cats->fetch_array(MYSQLI_ASSOC)) 
{
	$ideas = $db->getNumberOfIdeasByCat($cat["id"]);
	echo '<button onclick="viewCategory(' . $cat["id"] . ')"  style="font-size:'. ($ideas+1)*10 . 'px" >' . $cat["name"] .'<span class="num">'. $ideas .'</span></button><br />';
}
?>