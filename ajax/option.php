<!DOCTYPE html>
<html>
<head>
</head>
<body>
<select id="city" style="border-radius: 5px !important; height:30px; width:100px;">
<?php
include('../database/db.php');

if(isset($_POST['selected_district'])){
    $s_dis=$_POST['selected_district'];
$city= "SSelect DISTINCT location.l_town from location 
INNER JOIN l_city ON location.l_town=l_city.l_town
where l_city='$s_dis'";
}
else
{
$city= "Select DISTINCT location.l_town from location
INNER JOIN l_city ON location.l_town=l_city.l_town
where l_city='Kathmandu'";
}

$result=$mysqli->query($city);
echo "<option value='See all'>See all</option>";
while($row = $result->fetch_assoc())
{  
   echo "<option value='".$row["l_town"]."'>".$row["l_town"]."</option>";   
}
?>
</select>
</body>
</html>