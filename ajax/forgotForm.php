<?php
require("../config.php");
?>
<h1><?php echo _('Recover password') ?></h1>
<form id="recoverForm" onsubmit="return false;">
<label>Email</label><input id="emailInput" type="text" required class="required email"><br /><br />
<button onclick="lostPasswordMail()"><?php echo _('Recover password') ?></button>
</form>