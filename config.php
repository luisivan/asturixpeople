<?php

session_start();

// Enable debug
//error_reporting(-1);
error_reporting(0);

define("NAME", "Asturix People");
define("URL", "http://domain.com/people");
define("HOST", "domain.com");

define("DB", "peopledb");
define("DB_HOST", "localhost");
define("DB_USER", "peopleuser");
define("DB_PASS", "password");

define("KARMA", 50);
define("ITEMS", 5);

define("LANG", "en_US");

define("DISQUS", "people");

require("libs/db.php");
require("libs/auth.php");
require("libs/ui.php");

$db = new Db();

$auth = new Auth($db);

$ui = new Ui($db);

mb_language('uni');
mb_internal_encoding('UTF-8');

$domain = 'locale';

putenv('LANGUAGE='.LANG.".utf8");
putenv('LANG='.LANG.".utf8");
putenv('LC_ALL='.LANG.".utf8");
putenv('LC_MESSAGES='.LANG.".utf8");
setlocale(LC_ALL, LANG.".utf8");

define('PROJECT_DIR', realpath('./'));
if (strpos(PROJECT_DIR, 'ajax')) {
define('LOCALE_DIR', '../locale');
} else {
define('LOCALE_DIR', 'locale');
}
bindtextdomain($domain, LOCALE_DIR);
textdomain($domain);
bind_textdomain_codeset($domain, 'UTF-8');
?>
