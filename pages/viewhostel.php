<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
include('../include/header.php');
include('../database/db.php');

if(isset($_GET['id']))
{
    $id=$_GET['id'];

            $query= "Select * from hostel INNER JOIN location ON hostel.l_id=location.l_id 
            INNER JOIN l_city ON location.l_town=l_city.l_town
            where hostel.h_id=".$id;
            
            $r=$mysqli->query($query);
            $row = $r->fetch_assoc();
            
            if($row['h_type']==0)
                $hostel_type='Girls Hostel';
            else
                $hostel_type='Boys Hostel';
?>

<style>
p {outline-color:Green;}
p.outset {outline-style: outset;}

.boxx {
background: #00F443;
color: #FFF;
border-radius: 5px;
}

</style>

	<title>HOSTELFINDER</title>
    
</head>

<body>
<?php
include('../include/navigation.php');
?>
<body>

<div class="container-fluid">

<center><h1><p class="outset"><?php echo $row['h_name']; ?></p></h1></center>

<div class="col-sm-3">
<img src="../hostel_board/<?php echo $row['h_image'];?>" class="img-responsive" width="304" height="236"> 
 
  <h3><u>Call Now for Booking</u></h3>
  <h4>
  <span class="glyphicon glyphicon-earphone"> 
  <span class="glyphicon glyphicon-phone">
  <?php echo $row['h_contact'];?>
  </h4>  
  <br />
<div class="container-fliud">
<h2>Additional Features</h2>
   <ul>
                      <?php 
                            $text=$row["h_facilities"];
                            $count = strlen($text);
                            $l=0;
                            for( $l = 0; $l <= $count; $l++ ) {
                             $char = substr( $text, $l, 1 );
                             if(strstr($char, "\n")) { echo "<br><li>"; }
                             if($l==0){ echo "<li>"; }
                             echo $char;
                            }  
                            echo "</li>";                       
                      ?>
   </ul>
</div> 
</div>

<div class="col-sm-8">
<table class="table table-hover">
    <!--Table head-->
    <thead>
        <tr class="text-white">
            <th><h3>Location <span class="glyphicon glyphicon-map-marker"></h3></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Location :</td>
            <td><?php echo $row["l_street"].", ".$row["l_town"].", ".$row["l_city"]; ?></td>
        </tr>
        <tr>
            <td>View in Google Map :</td>
            <td>[<a href="#">
          <span class="glyphicon glyphicon-map-marker"></span>
        </a>ClickHere]</td>
        </tr>
        
    </tbody>
     <thead>
        <tr class="text-white">
            <th><h3>Pricing Details <span class="glyphicon glyphicon-usd"></span><span class="glyphicon glyphicon-usd"></span></h3></th>
        </tr>
    </thead>
    <tbody>
    <?php
            $r_query= "Select Distinct * from hostel INNER JOIN location ON hostel.l_id=location.l_id 
            INNER JOIN room ON hostel.h_id=room.h_id
            where hostel.h_id=".$id;
            
            $get_room=$mysqli->query($r_query);
            
        while ($room = $get_room->fetch_assoc())
        {
            if($room['r_attached']==1)
            $r_type="Attached";
            else
            $r_type="Unattached";
            
        echo "<tr>";
            echo "<td>For ".$room['r_seater']." seater:</td>";
              echo "<td>".$r_type."</td>";
            echo "<td >Rs.".$room['r_price']."</td>";   
        echo "</tr>";
        }
     ?>   
         <thead>
        <tr class="text-white">
            <th><h3>Total Room Details <span class="glyphicon glyphicon-th-large"></span></h3></th>
        </tr>
    </thead>
    
    <tbody>
          <?php
            $d_query= "Select count(r_id) as total_room 
            from hostel INNER JOIN location ON hostel.l_id=location.l_id 
            INNER JOIN room ON hostel.h_id=room.h_id
            where hostel.h_id=".$id;
            
            $get_details=$mysqli->query($d_query);
            
        $detail = $get_details->fetch_assoc();
        
           /* if($room['r_attached']==1)
            $r_type="Attached";
            else
            $r_type="Unattached";
            */
        echo "<tr>";
            echo "<td>Total Number of Room:</td>";
              echo "<td>".$detail['total_room']."</td>"; 
        echo "</tr>";
        
     ?> 
    </tbody>
</table>
<!--Table-->
</div>
</div>
</div>
</div> 
<?php
include('../include/footer.php');
}
  ?>
  
</body>
</html>