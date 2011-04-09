<?php

session_start();

// Enable debug
error_reporting(-1);

define("NAME", "Asturix People"); //Name of your community
define("URL", "http://domain.com/people"); //URL of your community
define("HOST", "domain.com"); //Host of your community

define("DB", "people"); //DB
define("DB_HOST", "localhost"); //DB host
define("DB_USER", "user"); //DB user
define("DB_PASS", "password"); //Password of the DB user

define("KARMA", 5); //Min karma of an idea to be approved
define("ITEMS", 3); //Items per page

define("LANG", "es_ES"); //Lang

define("DISQUS", "peopletest"); //DISQUS id

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