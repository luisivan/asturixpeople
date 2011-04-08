<?php
require("../config.php");

if (!isset($_SESSION['user']))
{
	echo '<script>loadHome()</script>';
	return false;
}
?>
<h1><?php echo _('Edit profile') ?></h1>
<form id="profileForm" onsubmit="return false;">
<label><?php echo _('Username') ?></label><input id="userInput" type="text" value="<?php echo $_SESSION["user"] ?>" required class="required"><br /><br />
<label><?php echo _('Email') ?></label><input id="emailInput" type="text" value="<?php echo $_SESSION["email"] ?>" required class="required email"><br /><br />
<label><?php echo _('Name') ?></label><input id="nameInput" type="text" value="<?php echo $_SESSION["name"] ?>" required class="required"><br /><br />
<label><?php echo _('Photo URL (70x70px)') ?></label><input id="photoInput" type="url" value="<?php echo $_SESSION["photo"] ?>" required onblur="previewPhoto()" class="required url"><div id="photoPreview"></div><br /><br />
<label><?php echo _('Something about you') ?></label><br /><br /><textarea id="infoInput" required class="required"><?php echo $_SESSION["info"] ?></textarea><br /><br />
<button onclick="onProfileUpdated()"><?php echo _('Update profile') ?></button>
<button id="changePasswordButton" onclick="onPasswordButton()"><?php echo _('Change password') ?></button>
<button id="deleteProfileButton" onclick="onProfileDeleted()"><?php echo _('Delete profile') ?></button>
</form>
