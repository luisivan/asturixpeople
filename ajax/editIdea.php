<?php
require("../config.php");

$id=$_GET["id"];
$idea = $db->getIdea($id);
$name=$idea["name"];
$description=$idea["description"];
$link=$idea["link"];
$open=$idea["open"];

if ($db->isIdeaCreator($_SESSION['user'], $id) == false)
{
	echo '<script>loadHome()</script>';
	return false;
}
?>
<h1><?php echo _('Edit idea') ?></h1>
<form id="editIdea" onsubmit="return false;">
<label><?php echo _('Title') ?></label><input id="nameInput" type="text" value="<?php echo $name ?>" required><br /><br />
<label><?php echo _('Category') ?></label><select id="categoryInput">
<?php $cats = $db->getCategories();
while ($cat = $cats->fetch_array(MYSQLI_ASSOC)) 
{
	echo '<option value="' . $cat["id"] . '" ';
	if ($db->getIdeaCategory($id) == $cat["id"])
	{
		echo 'selected';
	}
	echo '>' . $cat["name"] . '</option>';
} ?>
</select><br />
<br /><br />
<label><?php echo _('Description') ?></label><br /><br /><textarea id="descInput" required><?php echo $description ?></textarea><br />
<?php
echo '<input type="radio" id="open" name="open" value="0" ';
if ($open == 0){ echo "checked"; }
echo ' />'. _('Open');
echo '<input type="radio" id="closed" name="open" value="1" ';
if ($open == 1){ echo "checked"; }
echo ' />'. _('Closed');
?>
<button onclick="onIdeaUpdated(<?php echo $id ?>)"><?php echo _('Update idea!') ?></button>
</form>
<!--<script>
$(document).ready(function () {
	loadEditor("descInput");
});
</script>-->