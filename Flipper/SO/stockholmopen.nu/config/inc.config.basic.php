<?php
// contains some parameters that are likely to vary from server to server
// base dir
//define("BASE_DIR","/apache/SO/");
define("BASE_DIR","/home/so/public_html/");

// base url
//define("BASE_URL", "http://192.168.1.103/SO/");
define("BASE_URL", "http://www.stockholmopen.nu/");

//define("LOGIN_URL", BASE_URL . "login.php");
define("LOGIN_URL", preg_replace("/^http/","https",BASE_URL) . "login.php");

// log folder
define("LOG_FOLDER", "/home/so/logs/");

// database
define("DB_USER", "so");
define("DB_PASSWORD", "FrtxxJ4AuCxmAQ36");
define("DB_SERVER", "localhost");
define("DB_DATABASE", "so_main");
define("DB_PLATFORM", "mysql");

define("USE_HTTPS", true);
?>
