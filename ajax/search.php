<!DOCTYPE html>
<html>
<head>

<?php
include('../include/header.php');
$i=array();
$c=0;
$count=0;
?>

</head>
<body>

<?php
include('../database/db.php');
$hostel_search =  $mysqli->real_escape_string($_POST['str']); 

$get_location = "Select location.l_id from location 
INNER JOIN l_city ON location.l_town=l_city.l_town
where l_city.l_city like '$hostel_search%' or location.l_town like '$hostel_search%' or location.l_street like '$hostel_search%'";

$lc=$mysqli->query($get_location);

if($row=$lc->num_rows>0)
{
while($row=$lc->fetch_assoc()){
 $l_id[$count++]=$row['l_id'];   
}
}
else{
$l_id=array(0);
}

$search = "Select * from hostel
where h_name like '$hostel_search%' or l_id IN (".implode(',',$l_id).")"; 
$result=$mysqli->query($search);

$limit=8;

if($total_records=$result->num_rows>0 )
{
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

$search = "Select * from hostel 
INNER JOIN location ON hostel.l_id=location.l_id
INNER JOIN l_city ON location.l_town=l_city.l_town
where h_name like '%$hostel_search%' or hostel.l_id IN (".implode(',',$l_id).")
Limit ".$limit." offset ".$current_page; 
            
$result=$mysqli->query($search);

if ($result->num_rows <= 0)
{
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
 echo " <a href='../pages/findhostel.php?page_search=".$left."&search_back_string=".$hostel_search."'>&laquo;</a>";   
    
 for($page=1;$page<=$total_page;$page++)
    {   
        if($page==$pager)
         echo "<a href='../pages/findhostel.php?page_search=".$page."&search_back_string=".$hostel_search."' class='active'>".$page."</a>"; 
        else
         echo "<a href='../pages/findhostel.php?page_search=".$page."&search_back_string=".$hostel_search."'>".$page."</a>"; 
    }
 echo " <a href='../pages/findhostel.php?page_search=".$right."&search_back_string=".$hostel_search."'>&raquo;</a>";   
    
 echo "</div>";
 }
 }
 else
 {
    echo "<h3>0 results Found......</h3>";
 }
?>  

  </body>
  </html>