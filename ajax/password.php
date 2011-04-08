<?php
require("../config.php");
?>
<h1><?php echo _('Change password') ?></h1>
<form id="passwordForm" onsubmit="return false;">
<label><?php echo _('New Password') ?></label><input id="passInput" type="password" required class="required password">
<div class="password-meter"><div class="password-meter-message"></div><div class="password-meter-bg"><div class="password-meter-bar"></div></div></div><br /><br />
<button onclick="changePassword()"><?php echo _('Change password') ?></button>
</form>