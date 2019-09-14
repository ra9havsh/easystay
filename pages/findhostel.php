<!DOCTYPE HTML>
<html lang="en">

<head>

 <?php
 $caller_code=0;
 
 if(isset($_GET['caller_code']))
 $caller_code=$_GET['caller_code'];
 
 if(isset($_GET['s_text']))
 $str=$_GET['s_text'];
 else
 $str='Kathmandu';
 
 if(isset($_GET['page_search'])){
 $page=$_GET['page_search'];
 $caller_code=1;
 }
 else if(isset($_GET['page_find'])){
 $page=$_GET['page_find'];
 }
 else{
 $page=1;
 }
 
 if(isset($_GET['search_back_string']))
 $str=$_GET['search_back_string'];
?>

<?php
    include('../include/header.php');
    include('../database/db.php');
    $i=0;
?>


<style>
.page{
    text-align:center;
}
.btn-default.find:hover{
    width:50%; 
    height:80%; 
    border-radius: 5px; 
    border: 1px solid white; 
    background-color: #00F443; 
    color:white;
    font-size: 20pt;
    font-weight:bold;
    clear: both;
    float: left;
}
.btn-default.find{
    width:50%; 
    height:80%; 
    border-radius: 5px; 
    border: 1px solid #00F443; 
    color: #00F443; 
    background-color:white;
    font-size: 20pt;
    font-weight:bold;
    clear:both;
    margin: auto;
}
</style>
<style>
.text-block {
    position: absolute;
    bottom: -1px;
    right: 0px;
    opacity: 0.9;
    background-color: #7dab0a;
    font-weight: bold;
    color: white;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    padding-left: 10px;
}
.box {
  width:auto; height:150px;
  position: relative;
  border: 1px solid #BBB;
  background: #EEE;
}
.ribbon {
  position: absolute;
  right: -5px; top: -5px;
  z-index: 1;
  overflow: hidden;
  width: 75px; height: 75px;
  text-align: right;
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  width: 100px;
  display: block;
  background: #79A70A;
  background: linear-gradient(#9BC90D 0%, #79A70A 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; right: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #79A70A;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79A70A;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #79A70A;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79A70A;
}
</style>

<script>
    $( document ).ready(function(){
        $("#findhostel").addClass('active');
    });
</script>    
</head>

<body>

<?php
include('../include/navigation.php');
?>

<div class="container-fluid">
  
 <div class="col-sm-2" style="border-radius:25px !important; border:1px solid black !important; text-align:left; padding:0 0 20px 10px">
 
 <h1 style="margin:20px 0 0 -10px; padding:0 0 0px 60px; background-color: silver !important; color:white;">Filters</h1>
 
<form method="post" id="filter" onsubmit="return false;">
  <h3>Hostel Type:</h3>
     <div class="radio">
      <label><input type="radio" name="hostel_type" id="hostel_type" value="boys_hostel"/>Boys Hostel</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="hostel_type" id="hostel_type" value="girls_hostel"/>Girls Hostel</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="hostel_type" id="hostel_type" value="both" checked />Both</label>
    </div>
    <br />
    <label>District |</label>
    <label>City:</label>
      <br />
  <select id="location" name="location" style="border-radius: 5px !important; height:30px; width:100px;">
  <?php
    $district= "Select DISTINCT l_city from l_city";
    
    $result=$mysqli->query($district);
    
       while($row = $result->fetch_assoc()) {  
        echo "<option value='".$row["l_city"]."'>".$row["l_city"]."</option>";   
        }
  ?>
  </select>
  <script>    
  $("#location").on("change",function() {
    var district = this.value;
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("option").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "../ajax/option.php?", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("selected_district="+district);
  
  });   
  </script>
  
<div id="option" style="float: right; margin: 0 5px 0 0;">
<?php include('../ajax/option.php'); ?>
</div>
<br />
<br />

<button id="find" class="btn btn-default find" style="margin:0 0 0 40px" onclick="loadFind();">FIND</button>
</form>
</div>

<div class="col-sm-10">
<div class="input-group">

<input type="text" class="form-control input-sm" placeholder="Search If You Know Already(name, place)" name="location" id="location"/>
    
    <div class="input-group-btn">
      <button class="btn btn-default input-sm"  id="getResult">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
    
</div>
</div>

<div class="col-sm-10 page" id="results">

</div>

</div>


<script type="text/javascript"> 

  var caller_code= "<?php echo $caller_code;?>";
  var str = "<?php echo $str;?>"; 
  var page = "<?php echo $page;?>"; 
     
 function loadSearch(){    
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "../ajax/search.php?", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("str="+ str+"&page="+page);
        
        $('input[name="location"]').val(str);
  }
  
  if(caller_code==1)
  loadSearch();
  
  $('input[name="location"]').keydown(function(event) {
        if(event.keyCode==13)
   $('#getResult').trigger('click');
  });
     
  $("#getResult").on('click', function(event) {
    str= $('input[name="location"]').val();
    loadSearch();
  });
  
  </script>
  
  <script>
  var caller_code= "<?php echo $caller_code;?>"; 
  var page = "<?php echo $page;?>"; 
  
    function loadFind(){
        page=1;
        loadResult();
    }
        
    
     function loadResult(){        
    
    var radios = document.getElementsByName('hostel_type');
    var h_type;
    for (var i = 0, length = radios.length; i < length; i++)
    {
         if (radios[i].checked)
            {
                h_type=radios[i].value; 
                 break;
            }
    }
    
    var location= document.getElementById('location').value;
    var city= document.getElementById('city').value;
    
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "../ajax/find.php?", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("hostel_type="+h_type+"&location="+location+"&city="+city+"&page="+page);
  
        $('input[name="location"]').val(location);
  }
  
  
 if(caller_code==0)
 loadResult();       
</script>

<?php include('../include/footer.php'); ?>
  
</body>
</html>