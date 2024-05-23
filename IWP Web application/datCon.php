<?php

$dbServername = "localhost";
$dbUsername= "main";
$dbPassword= "livingonarazorsedge";
$dbName= "bpd app";

$con = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$con){
    echo "Connection Failed";
    exit();

}
?>
