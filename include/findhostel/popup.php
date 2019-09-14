  <!-- Modal -->
<?php
for($j=0;$j<count($i);$j++)
{
    ?>

  <div class="modal fade" id='<?php echo "myModal".$i[$j]; ?>' role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
      <?php
         
            
            $popup= "Select * from hostel INNER JOIN location ON hostel.l_id=location.l_id 
            INNER JOIN l_city ON location.l_town=l_city.l_town
            where h_id=".$i[$j];
            
            $r=$mysqli->query($popup);
            $get = $r->fetch_assoc();
            
            if($get['h_type']==0)
                $hostel_type='Girls Hostel';
            else
                $hostel_type='Boys Hostel';
                
      ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $get["h_name"]; ?></h4>
        </div>
        <div class="modal-body">
         <img src="../hostel_board/<?php echo $get["h_image"]?>" height="80%" width="90%">
        </div>
        <div class="modal-footer" style="text-align: left;">
                <div class="col-sm-7">
                    <p style="font-weight: bold;">Location&emsp;&emsp;: &ensp;<?php echo $get["l_street"].",".$get["l_town"]; ?></p>
                    <p style="font-weight: bold;">&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&emsp;&emsp;<?php echo $get["l_city"]; ?></p>
                    <p style="font-weight: bold;">Hostel Type&ensp;: &ensp;<?php echo $hostel_type;?></p>
                    <p style="font-weight: bold;">Contact no&ensp; : &ensp;<?php echo $get["h_contact"]?></p>
                </div>
                <div class="col-sm-5">
                     <p style="font-weight: bold;">Features</p>
                     <ul>
                      <?php $text=$get["h_facilities"];
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
                     <center><a href="../pages/viewhostel.php?id=<?php echo $get["h_id"]?>">view full page</a></center>
                </div>
        </div>
      </div>
      
    </div>
  </div>
  <?php
  }
  ?>