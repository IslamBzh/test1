<?php

ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . "/errors.log");

error_reporting(E_ALL);


define('MAIN_DIR', __DIR__);

foreach (glob(__DIR__ ."/config/*.php") as $file)
	require_once $file;

require_once __DIR__ . '/components/session.php';

foreach (glob(__DIR__ ."/components/*.php") as $file)
	require_once $file;

new Router();