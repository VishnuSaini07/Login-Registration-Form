<?php

$hostName= "localhost";
$uName= "root";
$hPassword = "";
$dbName = "test";

$conn = mysqli_connect($hostName, $uName, $hPassword, $dbName);

if (!$conn) {
	die("Connection failed!");
}