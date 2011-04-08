<?php

session_start();

// Enable debug
error_reporting(-1);

define("NAME", "Asturix People");
define("URL", "http://yestilo.serveftp.com/asturix/people");
define("HOST", "yestilo.serveftp.com");

define("DB", "people");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "desarrolloa5b6c5d6e5");

define("KARMA", 5);
define("ITEMS", 3);

define("LANG", "es_ES");

define("DISQUS", "peopletest");

require("libs/db.php");
require("libs/auth.php");
require("libs/ui.php");

$db = new Db();

$auth = new Auth($db);

$ui = new Ui($db);

mb_language('uni');
mb_internal_encoding('UTF-8');

putenv('LC_ALL='.LANG.".utf8");
putenv('LANGUAGE='.LANG.".utf8");
putenv('LANG='.LANG.".utf8");
putenv('LC_ALL='.LANG.".utf8");
putenv('LC_MESSAGES='.LANG.".utf8");
setlocale(LC_ALL, LANG.".utf8");

bindtextdomain("messages", "locale");
textdomain("messages");
bind_textdomain_codeset("messages", 'UTF-8'); 
?>