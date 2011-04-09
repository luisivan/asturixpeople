<?php
require("../config.php");
?>
<h1><?php echo _('Sign up') ?></h1>
<form id="signUp" onsubmit="return false;">
<label><?php echo _('Username') ?></label><input id="userInput" type="text" required class="required"><br /><br />
<label><?php echo _('Password') ?></label><input id="passInput" type="password" required class="required password">
<div class="password-meter"><div class="password-meter-message"></div><div class="password-meter-bg"><div class="password-meter-bar"></div></div></div><br /><br />
<label><?php echo _('Email') ?></label><input id="emailInput" type="email" required class="required"><br /><br />
<label><?php echo _('Name') ?></label><input id="nameInput" type="text" required class="required"><br /><br />
<label><?php echo _('Photo URL (70x70px)') ?></label><input id="photoInput" type="url" onblur="previewPhoto()" required class="required" value="http://"><div id="photoPreview"></div><br /><br />
<label><?php echo _('Something about you') ?></label><br /><br /><textarea id="infoInput" class="required"></textarea><br /><br />
<button onclick="onSignupSubmit()"><?php echo _('Sign up') ?></button>
</form>