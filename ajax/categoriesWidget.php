<?php
require("../config.php");
$cats = $db->getCategories();
while ($cat = $cats->fetch_array(MYSQLI_ASSOC)) 
{
	echo '<button onclick="viewCategory(' . $cat["id"] . ')" >' . $cat["name"] .'<span class="num">'. $db->getNumberOfIdeasByCat($cat["id"]) .  '</span></button><br />';
}
?>