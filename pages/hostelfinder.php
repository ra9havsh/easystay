<!DOCTYPE HTML>
<html lang="en">

<head>
<?php include('../include/header.php'); ?>

<script>
    $( document ).ready(function(){
     $("#hostelfinder").addClass('active');
    });
</script>
</head>

<body>

<?php include('../include/navigation.php'); ?>

<div class="container" >
  
  <div class="row" style="margin:40px 0 0 0;">
    
        <div class="col-sm-4">
            <h2 class="midb" style="text-align: center;">The Better You Choose</h2>
            <h2 class="midb" style="text-align: center;">The Better You Get</h2>
            
            <div class="container-fluid" style="text-align: center; text-justify: auto; padding:0 5px 0 5px">
                The only place you will be able to find the satisfying result to choose where you stay.
                The only place you will be able to find the satisfying result to choose where you stay.
                The only place you will be able to find the satisfying result to choose where you stay.
                </div>           
        
             <h2 class="midb" style="text-align: center;">Choose Where You Stay</h2>
        </div>

        <div class="col-sm-4">
          <img src="../images/1.jpg" alt="1" style="width:100%; height=100%"/>
        </div>
    
        <div class="col-sm-4">
            <h1 class="mida">FIND</h1>
            <h1 class="mida">HOSTEL</h1>
            <h2 class="midb">Choose It &amp; Get It</h2>
            <h2 class="midb">Choice Is Yours</h2>
        </div>
    
    </div>

    <div class="jumbotron" style="clear:both; margin:50px 0 0 0 ">

        <div class="input-group">

            <input type="text" class="form-control input-lg" placeholder="Search If You Know Already(name, place)" id="getText" autofocus/>
    
            <div class="input-group-btn">
                <a href="#results">
                <button class="btn btn-default input-lg"  id="getResult">
                <i class="glyphicon glyphicon-search"></i>
                </button>
                </a>
            </div>
    
        </div>
    </div>
</div>

<div class="container-fluid" id="results" class="collapse"></div>
    

<script>
    $('#getText').keydown(function(event) {
        if(event.keyCode==13)
            $('#getResult').trigger('click');
     });
     
     $("#getResult").on('click', function(event) {
        sendtext(); 
     });
  
    function sendtext(){
        var search_text = document.getElementById("getText").value;
        
        if(search_text.trimLeft()==""){
            alert("Please provide the name or location");
            function_to_call_when_oked_or_closed($('#getText').focus());
        }
        else
        window.location.href = "../pages/findhostel.php?s_text="+search_text+"&caller_code=1";
    }
</script>

<?php include('../include/footer.php'); ?>

</body>
</html>