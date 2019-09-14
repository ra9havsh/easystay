<?php

$user ='root';
$pass ='';
$db = 'hostelfinder';

$mysqli = new mysqli('localhost',$user,$pass,$db);

//check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
echo "Connected to database";

?>
<!DOCTYPE HTML>
<html lang="en">
<head>

 <meta charset="utf-8"/>
 
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  -moz-appearance: none;
    appearance: none;
  margin: 0; 
}
</style>
	<title>HOSTELFINDER</title>
    
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-size">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="hostelfinder.php">HOSTEL FINDER</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="form.php">Refresh</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
 <form class="form-horizontal col-sm-4" action="monitor.php" method="post" enctype="multipart/form-data">
  
 <div class="form-group">
    <label for="hostel_name">Hostel Name:</label>
    <input type="text" class="form-control" name="hostel_name"/>
  </div>
  <div class="form-group">
    <label for="hostel_name">Contact No:</label>
    <input type="number" class="form-control" name="contact_no"/>
  </div>
   <div class="form-group">
   <label for="hostel_type">Hostel Type:</h3>
     <div class="radio-inline">
      <label><input type="radio" name="hostel_type" value="boys_hostel"/>Boys Hostel</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="hostel_type" value="girls_hostel"/>Girls Hostel</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="hostel_type" value="both"/>Both</label>
    </div>
    </div>    
  
   <div class="form-group">
    <label>Location:</label>
  <select name="location" style="border-radius: 5px !important; height:30px; width:100px;">
    <option value="kathmandu">Kathmandu</option>
    <option value="lalitpur">Lalitpur</option>
    <option value="bhaktapur">Bhaktapur</option>
    <option value="pokhara">Pokhara</option>
    <option value="chitwan">Chitwan</option>
    <option value="dharan">Dharan</option>
    <option value="butwal">Butwal</option>
  </select>
   </div>
  
  <div class="form-group">
  <label>Room Type:</label>
  <div class="checkbox-inline">
  <label><input type="checkbox" value="shared" name="room_type[]"/>Shared</label>
</div>
<div class="checkbox-inline">
  <label><input type="checkbox" value="alone" name="room_type[]"/>Alone</label>
</div>  
</div>

<div class="form-group">
  <label>Budget Range:</label>
  <input type="number" class="form-control" name="budget"/>
  </div>
  <div class="form-group">
      <label for="fileToUpload">Upload hostel Images:</label>
      <input type="file" name="Upload"/>
      </div>  
  <div class="form-group">
  <button type="submit" class="btn btn-default" name="submit" value="submit">SUBMIT</button>
  </div>
  </form>
</div>

</body>
</html>