<html>
<head>
</head>
<body>
<?php
 include('../database/db.php');
 
 $count=0;
 $count1=0;
 
 if($gender=='boys')
 $ktm = "Select * from hostel INNER JOIN location ON hostel.l_id=location.l_id 
 INNER JOIN l_city ON location.l_town=l_city.l_town where h_type=1 and l_city='Kathmandu'";
 else
 $ktm = "Select * from hostel INNER JOIN location ON hostel.l_id=location.l_id
 INNER JOIN l_city ON location.l_town=l_city.l_town where h_type=0 and l_city='Kathmandu'";
 
 $result=$mysqli->query($ktm);

?>
  <div id="custom_carousel" class="carousel slide" data-ride="carousel" data-interval="4000">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <?php
          while($row = $result->fetch_assoc()) {  
            
                if($row["h_type"]==1)
                $hostel_type='Boys Hostel';
                else
                $hostel_type='Girls Hostel';
                
               if($count==0){
                $count++;
        ?>       
            <div class="item active">
                <div class="container-fluid">
                    <div class="row">
                        <div class="top col-md-6 col-xs-11"><img src="../hostel_board/<?php echo $row["h_image"];?>" class="img-responsive"></div>
                            <div class="content col-md-6 col-xs-11">
                            <h2 style="border-bottom: 2px grey solid !important;"><?php echo $row["h_name"]?></h2>
                            <p style="font-weight: bold;">
                            Location&emsp;&emsp;&emsp;: &ensp;<?php echo $row["l_town"].", ".$row["l_city"];?>
                            <?php
                                if(!empty($row["l_street"]))
                                echo "(".$row["l_street"].")";
                            ?>
                            </p>
                            <p style="font-weight: bold;">Hostel Type&emsp;&ensp;: &ensp;<?php echo $hostel_type;?></p>
                            <p style="font-weight: bold;">Contact no&emsp;&ensp; : &ensp;<?php echo $row["h_contact"]?></p>
                            <p style="font-weight: bold;">Facilities</p>
                            <ul type="circle">
                            <?php $text=$row["h_facilities"];
                            $count = strlen($text);
                            $i=0;
                            for( $i = 0; $i <= $count; $i++ ) {
                             $char = substr( $text, $i, 1 );
                             if(strstr($char, "\n")) { echo "<br><li>"; }
                             if($i==0){ echo "<li>"; }
                             echo $char;
                            }  
                            echo "</li>";                       
                            ?>
                            </ul>
                            <center><p><a href="../pages/viewhostel.php?id=<?php echo $row["h_id"]?>">view full page</a></p></center>
                        </div>
                    </div>
                </div>            
            </div> 
        <!-- End Item -->
          <?php
          }else{
          ?>
                <div class="item">
                <div class="container-fluid">
                    <div class="row">
                          <div class="top col-md-6 col-xs-11"><img src="../hostel_board/<?php echo $row["h_image"];?>" class="img-responsive"></div>
                            <div class="content col-md-6 col-xs-11">
                            <h2 style="border-bottom: 2px grey solid !important;"><?php echo $row["h_name"]?></h2>
                            <p style="font-weight: bold;">
                            Location&emsp;&emsp;&emsp;: &ensp;<?php echo $row["l_town"].", ".$row["l_city"];?>
                            <?php
                                if(!empty($row["l_street"]))
                                echo "(".$row["l_street"].")";
                            ?>
                            </p><p style="font-weight: bold;">Hostel Type&emsp;&ensp;: &ensp;<?php echo $hostel_type;?></p>
                            <p style="font-weight: bold;">Contact no&emsp;&ensp; : &ensp;<?php echo $row["h_contact"]?></p>
                            <p style="font-weight: bold;">Features</p>
                            <ul type="circle" style="float: left; ">
                            <?php $text=$row["h_facilities"];
                            $count = strlen($text);
                            $i=0;
                            for( $i = 0; $i <= $count; $i++ ) {
                             $char = substr( $text, $i, 1 );
                             if(strstr($char, "\n")) { echo "<br><li>"; }
                             if($i==0){ echo "<li>"; }
                             echo $char;
                            }  
                            echo "</li>";                       
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>            
            </div> 
            <!-- End Item -->
            <?php
          }
             }
             ?>
        </div>
        <a data-slide="prev" href="#custom_carousel" class="izq carousel-control"><</a>
        <a data-slide="next" href="#custom_carousel" class="der carousel-control">></a>
        <!-- End Carousel Inner -->
                <div class="controls draggable ui-widget-content col-md-12 col-xs-12">
            <ul class="nav ui-widget-header">
               <?php
               $result=$mysqli->query($ktm);
               while($row = $result->fetch_assoc()) {  
               if($count1==0){
                ?>  
                <li data-target="#custom_carousel" data-slide-to="<?php echo $count1; ?>" class="active"><a href="#"><img src="../hostel_board/<?php echo $row["h_image"]; ?>"><small><?php echo $row["h_name"]; ?></small></a></li>
              <?php
                }
                else{
                    ?>
                 <li data-target="#custom_carousel" data-slide-to="<?php echo $count1; ?>"><a href="#"><img src="../hostel_board/<?php echo $row["h_image"]; ?>"><small><?php echo $row["h_name"]; ?></small></a></li>
              <?php
                }
                 $count1++;
                }
              ?>
            </ul>
        </div>
    </div>
    <!-- End Carousel -->
</body>
</html>