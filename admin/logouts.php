<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-08-22
 * Time: 12:12
 */

session_start();
unset($_SESSION['transferred_name']);
unset($_SESSION['transferred']);
header("location:../transferred.php");
exit();