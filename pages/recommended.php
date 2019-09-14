<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
include('../include/header.php');
?>
<script>
  $(document).ready(function(ev){
    var items = $(".nav li").length;
    var leftRight=0;
    
    if(items>5){
        leftRight=(items-5)*50*-1;
    }
    
    $('#custom_carousel').on('slide.bs.carousel', function (evt) {
      $('#custom_carousel .controls li.active').removeClass('active');
      $('#custom_carousel .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
    })
    
    $('#custom_carousel1').on('slide.bs.carousel', function (evt) {
      $('#custom_carousel1 .controls li.active').removeClass('active');
      $('#custom_carousel1 .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
    })
    
    $('.nav').draggable({ 
        axis: "x",
         stop: function() {
            var ml = parseInt($(this).css('left'));
            if(ml>0)
            $(this).animate({left:"0px"});
                if(ml<leftRight)
                    $(this).animate({left:leftRight+"px"});          
        }
    });
});
  </script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      height: 400px;
      margin: auto;
  }
  
#custom_carousel .item  .top ,#custom_carousel1 .item  .top {
    overflow:hidden;
    max-height:300px;
    margin-bottom:15px;
}
#custom_carousel .item,#custom_carousel1 .item{

    color:#000;
    background-color:#efeded;
    padding:20px 0;
    overflow:hidden
}
#custom_carousel .item img, #custom_carousel1 .item img{
width:100%;
height:auto
}

#custom_carousel .izq ,#custom_carousel1 .izq 
{
    position:absolute;
  left: -25px;
  top:40%;
  background-image: none;
  background: none repeat scroll 0 0 #222222;
  border: 4px solid #FFFFFF;
  border-radius: 23px;
  height: 40px;
  width : 40px;
  margin-top: 30px;
}
/* Next button  */
#custom_carousel .der ,#custom_carousel1 .der 
{
  position:absolute;
  right: -25px !important;
  top:40%;
  left:inherit;
  background-image: none;
  background: none repeat scroll 0 0 #222222;
  border: 4px solid #FFFFFF;
  border-radius: 23px;
  height: 40px;
  width : 40px;
  margin-top: 30px;
}
#custom_carousel .controls, #custom_carousel1 .controls{

    overflow:hidden;
    padding:0;
    margin:0;
    white-space: nowrap;
    text-align: center;
    position: relative;
    background:#fff;
    border:0;
}
#custom_carousel .controls .nav,#custom_carousel1 .controls .nav{

    padding:0;
    margin:0;
    white-space: nowrap;
    text-align: center;
    position: relative;
    background:#fff;
    width: auto;
    border: 0;
}
#custom_carousel .controls li,#custom_carousel1 .controls li {
    transition: all .5s ease;
    display: inline-block;
    max-width: 100px;
    height: 90px;
    opacity:.5;
}
#custom_carousel .controls li a,#custom_carousel1 .controls li a{
    padding:0;
}
#custom_carousel .controls li img,#custom_carousel1 .controls li img{
width:100%;
height:auto
}

#custom_carousel .controls li.active,#custom_carousel1 .controls li.active {
    background-color:#fff;
    opacity:1;
}
#custom_carousel .controls a small,#custom_carousel1 .controls a small {
    overflow:hidden;
    display:block;
    font-size:10px;
    margin-top:5px;
    font-weight:bold
}
  footer {
            background-color: #b8b8b8;
            width: 100%;
            border-radius: 5px;
        }
        
#justpushtobottom {
    height: 60vh;
}
  </style>

<style>
.btn-default.find:hover{
    float:left;
    width:100%; 
    height:100%; 
    border-radius: 5px; 
    border: 1px solid white; 
    background-color: #00F443; 
    color:white;
    font-size: 30pt;
    font-weight:bold;
}
.btn-default.find{
    float:left;
    width:100%; 
    height:100%; 
    border-radius: 5px; 
    border: 1px solid #00F443; 
    color: #00F443; 
    background-color:white;
    font-size: 30pt;
    font-weight:bold;
}
</style>
	<title>HOSTELFINDER</title>
    
</head>

<body>

<?php
include('../include/navigation.php');
?>
<script>
     $("#recommended").addClass('active');
</script>

<h3 style='text-align: center;'>Boys Hostel</h3>

<div class="container" id="boysrecommended">
<?php
  $gender='boys';
  include('../include/recommended/recommended_scroll.php');
?>
</div>

<hr />

<h3 style='text-align: center;'>Girls Hostel</h3>

<div class="container" id="girlsrecommended">
<?php
  $gender='girls';
  include('../include/recommended/recommended_scroll.php');
?>
</div>

<?php
include('../include/footer.php');
  ?>
</div>
</body>
</html>