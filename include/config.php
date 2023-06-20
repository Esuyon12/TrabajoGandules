<?php

$debug = false;

defined('server') ? null : define("server", "localhost");
if ($debug) {
    defined('user') ? null : define("user", "root");
    defined('pass') ? null : define("pass", "");
    defined('database_name') ? null : define("database_name", "gandules");
} else {
    defined('user') ? null : define("user", "u292896214_gals");
    defined('pass') ? null : define("pass", "W2u0$52qUz/$");
    defined('database_name') ? null : define("database_name", "u292896214_gals");
}


$this_file = str_replace('\\', '/', __File__);
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$web_root =  str_replace(array($doc_root, "include/config.php"), '', $this_file);
$server_root = str_replace('config/config.php', '', $this_file);

// echo $web_root;
define('web_root', $web_root);
define('server_root', $server_root);
