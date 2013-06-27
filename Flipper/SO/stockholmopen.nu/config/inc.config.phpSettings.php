<?php
// these settings doesn't seem to work for any other file than just this file?!?!?
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
ini_set('error_log', LOG_FOLDER . "php_error.log");
ini_set('log_errors', true);
ini_set('open_basedir', BASE_DIR);
ini_set('disable_functions', 'phpinfo,dir,shell_exec,exec,virtual,passthru,proc_close,proc_get_status,proc_open,proc_terminate,system');
// disable the magic quotes
set_magic_quotes_runtime(0);
?>
