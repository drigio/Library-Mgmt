<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'librarymgmt';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
date_default_timezone_set('Asia/Kolkata');