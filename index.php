<?php

define('MAIN_DIR', __DIR__);

foreach (glob(__DIR__ ."/config/*.php") as $file)
	require_once $file;

require_once __DIR__ . '/components/session.php';

foreach (glob(__DIR__ ."/components/*.php") as $file)
	require_once $file;

new Router();