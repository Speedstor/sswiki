<?php
session_start();
function kick(){
    header("Location: /feedbackPages/no-access.php?type=contributePrivilege");
    exit();
}

if(!isset($required_access_level)){
    header("Location: /feedbackPages/server-error.php?error=server_variable_missing");
    exit();
}

if(empty($_SESSION['userId']) || empty($_SESSION['user_name'])){
    kick();
}

//TODO: have to have a special login header;
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");
$result = mysqli_query($conn, "SELECT * FROM authority WHERE user_id=".$_SESSION['userId']);
if(!$result) kick();
$result = mysqli_fetch_array($result);

if($result < $required_access_level) kick();

