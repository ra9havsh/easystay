<?php
include('../database/db.php');
$full_name =  $mysqli->real_escape_string($_POST['full_name']); 
$email =  $mysqli->real_escape_string($_POST['email']); 
$subject =  $mysqli->real_escape_string($_POST['subject']); 
$message =  $mysqli->real_escape_string($_POST['message']); 
$error=1;

if(isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && strlen($message)<=150){
    $insert = "insert into customer (full_name,email,subject,message) values ('$full_name','$email','$subject','$message')";
    $result = $mysqli->query($insert);
    $error  = 0;
}
header("location:../pages/contactus.php?error=".$error);
?>