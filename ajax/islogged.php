<?php

require("../config.php");

echo $auth->loginBar($auth->isLogged());
?>