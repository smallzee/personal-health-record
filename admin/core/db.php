<?php
session_start();
require_once 'config.php';
require_once 'func.php';

define("env","local");

if(env == "local") {
    define('DB_HOST', 'localhost');
    define('DB_TABLE', 'apps_lautech');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');

    //error_reporting("E_ALL");
}else{
    define('DB_HOST', 'localhost');
    define('DB_TABLE', 'onlinem1_mcq');
    define('DB_USER', 'onlinem1_yearapp');
    define('DB_PASSWORD', 'qvXT%vCU2+QG');

    error_reporting("E_FATAL");

}


try {
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_TABLE, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch (PDOException $e){
    die('<br/><center><font size="15">Could not connect with database</font></center>');
}



?>