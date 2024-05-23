<?php

$dbServername = "localhost";
$dbUsername= "main";
$dbPassword= "livingonarazorsedge";
$dbName= $_REQUEST['username'];

$con = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$con){
    echo "Connection Failed";
    exit();

}
?>