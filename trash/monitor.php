<?php

include('db.php');
$message1="";
$message2="";
$message3="";
$target_dir = "images/";
$target_file = $target_dir.basename($_FILES["Upload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) )
{
     $check = getimagesize($_FILES["Upload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $message= $message." File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
       $message=$message." File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $message=$message." Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["Upload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $message=$message." Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $message = $message." Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    $message= $message." Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["Upload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["Upload"]["name"]). " has been uploaded.";
             $message= $message." The file ". basename( $_FILES["Upload"]["name"]). " has been uploaded.";       
    } else {
        echo "Sorry, there was an error uploading your file.";
        $message =$message." Sorry, there was an error uploading your file.";
    }
}


if(isset($_POST['hostel_name']) && isset($_POST['hostel_type']) && isset($_POST['location']) && isset($_POST['budget']) 
&& isset($_POST['room_type']) 
&& isset($_POST['contact_no'])
&& $uploadOk == 1
)
{
    $type=$_POST['room_type'];
    $room_type=implode(", ",$type);
       $result = "INSERT INTO hostels (hostel_name,hostel_type,location,budget,room_type,image,contact_no) 
       VALUES (
       '{$mysqli->real_escape_string($_POST['hostel_name'])}',
       '{$mysqli->real_escape_string($_POST['hostel_type'])}',
       '{$mysqli->real_escape_string($_POST['location'])}',
       '{$mysqli->real_escape_string($_POST['budget'])}',
       '{$mysqli->real_escape_string($room_type)}',
       '{$mysqli->real_escape_string(basename($_FILES["Upload"]["name"]))}',
       '{$mysqli->real_escape_string($_POST['contact_no'])}')";
         
       $insert= $mysqli->query($result);

       if($insert){
        echo "\nTOTAL DATA ADDED: {$mysqli->insert_id}";   
        $message3= $message3."TOTAL DATA ADDED: {$mysqli->insert_id}";
        
       }else{
        die("\nERROR: {$mysqli->errno} : {$mysqli->error}");
       }
    }   
    else
    {
        echo "\nfill up every data";
         $message2=$message2." fill up every data";
    }
}

header( "Location:land.php?message1=$message1&message2=$message2&message3=$message3");

?>