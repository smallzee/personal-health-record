<?php
session_start();
require_once 'func.php';
define('DB_HOST', 'localhost');
define('DB_TABLE', 'apps_lautech');
define('DB_USER', 'root');
define('DB_PASSWORD', '');


/*
define('DB_HOST', 'localhost');
define('DB_TABLE', 'designge_main');
define('DB_USER', 'designge_main');
define('DB_PASSWORD', 'Pass123word4');
*/
	try {
			$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_TABLE, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		}
		catch (PDOException $e){
		   	die('<br/><center><font size="15">Could not connect with database</font></center>');
		}

?>