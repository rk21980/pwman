<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 19:16
 */

ini_set("display_errors",1);
error_reporting(E_ALL);

define("PW_DEBUG", true);

require_once ('connection.php');
// core pieces
require_once ('models/pwman.php'); // global helper / self-introducer

$package = new stdClass();
$package->msg = "Started at ".microtime();
$PWGround->pwlog($package);

if( isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'pages';
    $action = 'home';
}

require_once('views/layout.php');