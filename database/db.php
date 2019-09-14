<?php
$user ='root';
$pass ='';
$db = 'hostelfinder1-1';

$mysqli = new mysqli('localhost',$user,$pass,$db);

//check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

?>