<?php

require("../config.php");

$auth->logout();

echo $auth->loginBar(false);
?>