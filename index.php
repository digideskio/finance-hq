<?php
/* SHS v0.4 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
header("Content-Type: text/html; charset=utf-8");
ini_set("session.gc_maxlifetime", 86400);

session_start();

define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
define('APP_DIR', ROOT_DIR.'applications/');

require(APP_DIR.'bootstrap.php');

global $config;
define('BASE_URL', $config['base_url']);

// Run base from bootstrap
bootstrap();
?>
