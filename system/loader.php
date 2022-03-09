<?php

//var_dump($_SESSION);

//require_once getcwd().'/system/sms/nusoap/nusoap.php' ;

require_once getcwd().'/config.php';
require_once getcwd().'/system/core.php';
// require_once getcwd().'/system/simplexlsx.class.php';
require_once getcwd().'/system/db.php';
require_once getcwd().'/system/function.php';
require_once getcwd().'/system/jdf.php';
require_once getcwd().'/system/view.php';
require_once (getcwd().'/vendor/autoload.php');



date_default_timezone_set('Asia/Tehran');
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

$db = Db::getInstance();

ini_set( 'session.cookie_httponly', 1 );
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);

session_start();





//if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
//    // request 30 minates ago
//    session_destroy();
//    session_unset();
//}
//
//
//$_SESSION['LAST_ACTIVITY'] = time();

?>