<!DOCTYPE html>
<html>

<head>
<?php
include('../include/header.php');
?>
</head>

<body>
<?php

include('../database/db.php');

$hostel_type=$_POST['hostel_type'];
$location=$_POST['location'];
$city=$_POST['city'];
$i=array();
$count=0;
$c=0;

if($hostel_type=='boys_hostel')
$h_type=1;
else
$h_type=0;

if($city == 'See all')
$get_location = "Select l_id from location 
 INNER JOIN l_city ON location.l_town=l_city.l_town
 where l_city='$location'";
else
$get_location = "Select l_id from location 
 INNER JOIN l_city ON location.l_town=l_city.l_town
where l_city='$location' and l_city.l_town='$city'";

$lc=$mysqli->query($get_location);

while($row=$lc->fetch_assoc()){
 $l_id[$count++]=$row['l_id'];   
}

if($hostel_type=='both')
$search = "Select * from hostel where l_id IN (".implode(',',$l_id).") ";
else
$search = "Select * from hostel where h_type='$h_type' and l_id IN (".implode(',',$l_id).")";


$result=$mysqli->query($search);

$limit=8;


   
$total_records=$result->num_rows;
$total_page=ceil($total_records/$limit);


$pager=$_POST['page'];

if($pager==$total_page && $pager==1){
    $left=$pager;
 $right=$pager;   
}
else if($pager==1){
    $left=$pager;
    $right=$pager+1;
}
else if($pager==$total_page){
    $left=$pager-1;
 $right=$pager;   
}
else{
$left=$pager-1;
$right=$pager+1;
}

$current_page = ($pager-1)*$limit;

if($hostel_type=='both')
$search = "Select * from hostel INNER JOIN location ON hostel.l_id=location.l_id
INNER JOIN l_city ON location.l_town=l_city.l_town
where hostel.l_id IN (".implode(',',$l_id).") 
Limit ".$limit." offset ".$current_page;
else
$search = "Select * from hostel INNER JOIN location ON hostel.l_id=location.l_id
INNER JOIN l_city ON location.l_town=l_city.l_town
where h_type='$h_type' and hostel.l_id IN (".implode(',',$l_id).") 
Limit ".$limit." offset ".$current_page;

$result=$mysqli->query($search);

if ($result->num_rows <= 0) {
    echo "<h3>0 results Found......</h3>";
}
else
{
echo "<div id='find'>";
echo "<div class='container-fluid'>";
   while($row = $result->fetch_assoc()) {    
        $i[$c++] = $row['h_id'];
        echo "<a href='#' data-toggle='modal' data-target='#myModal".$row['h_id']."'>";
        echo "<div id='box' class='box col-sm-3' style='margin: 10px 0px 25px 0'>";
        echo "<img src='../hostel_board/" . $row["h_image"]. "' width='225px' height='150px' style='padding:0px 0 0 0'/>";
        echo "<div class='ribbon'> <span>".$row["l_city"]."</span></div>";
        echo "<div class='text-block'><span>".$row["l_street"].", ".$row["l_town"]."</span>";
        echo "</div>";
        echo "<h6 style='text-align:center; font-weight:bold; width:200px;'>".$row["h_name"]."</h6>";
        echo "</div></a>";  
   }  
   
echo "</div>";    
include('../include/findhostel/popup.php'); 
echo "<div class='pagination'>";
echo " <a href='../pages/findhostel.php?page_find=".$left."'>&laquo;</a>";   
    
    for($page=1;$page<=$total_page;$page++)
    {   if($page==$pager)
         echo "<a href='../pages/findhostel.php?page_find=".$page."' class='active'>".$page."</a>"; 
        else
         echo "<a href='../pages/findhostel.php?page_find=".$page."'>".$page."</a>"; 
    }

echo " <a href='../pages/findhostel.php?page_find=".$right."'>&raquo;</a>";
echo "</div></div>";
}
?>

</body>
</html>