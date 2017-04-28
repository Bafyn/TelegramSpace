<?php

// Front Controller
// 1. Common settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. System files connection
define('ROOT', dirname(__FILE__));
define('IMAGE_DEFAULT', 'noimage.png');
//require_once(ROOT.'/components/Router.php');
require_once(ROOT . '/components/Autoload.php');

// 3. Connection with DB
$params = include(ROOT . '/config/db_params.php');
$GLOBALS['DBH'] = DB::getConnection($params);
$GLOBALS['DBH']->exec("SET NAMES utf8");

// 4. Start session
session_start();

// 5. Router call
$router = new Router();
$router->run();
