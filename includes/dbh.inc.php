<?php

require_once($_SERVER['DOCUMENT_ROOT']."/includes/credential.php");

$servername = DB_HOST;
$dBUsername = DB_USER;
$dBPassword = DB_PASSWORD;
$dBName = DB_NAME;


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}