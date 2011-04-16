<?php
require("../config.php");

if (!isset($_SESSION['user']))
{
	echo '<script>loadHome()</script>';
	return false;
}
?>
<h1><?php echo _('New idea') ?></h1>
<form id="newIdea" onsubmit="return false;">
<label><?php echo _('Title') ?></label><input id="nameInput" type="text" required><br /><br />
<label><?php echo _('Category') ?></label><select id="categoryInput" required class="required">
<!--<option value="" disabled><?php _('Choose category') ?></option>-->
<?php $cats = $db->getCategories();
while ($cat = $cats->fetch_array(MYSQLI_ASSOC)) 
{
	echo '<option value="' . $cat["id"] . '">' . $cat["name"] . '</option>';
} ?>
</select><br /><br />
<label><?php echo _('Description') ?></label><br /><br /><textarea id="descInput" class="required"></textarea><br />
<button onclick="onNewIdea()"><?php echo _('Send idea!') ?></button>
<!--<input class="submit" type="submit" value="<?php echo _('Send idea!') ?>"/>-->
</form>
<!--<script>
$(document).ready(function () {
	loadEditor("descInput");
});
</script>-->