<?php


/**
 * Used to fetch URI details and set variable $_GET['url'],
 * if it is unset, fetch the $_SERVER['REQUIEST_URI'].
 * After that, further clean the string url.
 */
$_GET['url'] = $_GET['url'] ?? trim($_SERVER['REQUEST_URI'], '/');
$_GET['url'] = str_replace('STRING TO BE REPLACED', '', $_GET['url']);

/**
 * DB_TYPE is a constant. Used to define what database to use.
 */
define('DB_TYPE', 'MySQL');

/**
 * Initialize /core files
 */
require_once '../app/init.php';


/**
 * Instance of Application, Internal logic is inside of 
 * App object
 */
$app = new Application(dirname(__DIR__));