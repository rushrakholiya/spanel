<?php
include_once 'psl-config.php';   // As functions.php is not included
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
error_reporting(E_ALL);
ini_set('display_errors', 0);
?>