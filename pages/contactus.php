<!DOCTYPE HTML>
<html lang="en">
<head>

<?php
include('../include/header.php');

if(isset($_GET['error']))
$error=$_GET['error'];
else
$error=2;
?>
    
</head>

<body>
<?php
include('../include/navigation.php');
?>
<script>
     $("#contactus").addClass('active');
</script>

<style>
.jumbotron {
background: #00F443;
color: #FFF;
border-radius: 0px;
}
.jumbotron-sm { padding-top: 24px;
padding-bottom: 24px; }
.jumbotron small {
color: #FFF;
}
.h1 small {
font-size: 24px;
}
</style>
<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    Contact us <small>Feel free to contact us</small></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form method="post" action="../database/customer.php">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Subject</label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option selected="">Choose One:</option>
                                <option value="General Customer Service">General Customer Service</option>
                                <option value="Suggestions">Suggestions</option>
                                <option value="Product Support">Product Support</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                         <?php
                             if($error==0)
                             echo "<label style='color:green;'>Thank you! We will be in touch</label>";
                             else if($error==1)
                             echo "<label style='color:red;'>Sorry! Something went wrong</label>";
                             else
                             echo "<label>Please Fill Up Every Feild</label>";
                         ?>                       
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs" onclick="send_message();">
                            Send Message</button>
                    </div>
                </div>
                </form>
                <div style="text-align: justify; padding:5px 5px 5px 5px; margin: 5px 0 0 0; background-color:grey; color:white; opacity:0.8;">
                <p>
                For now we have only the hostels from kathmandu. But we are working futher to extend information and provide better services for the users.
                Hope, this website may ease your problem regarding finding the hostels or rooms. Please support us and let us be your helping hand. Thank You!
                </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-phone"></span> Call us</legend>
            <address>
                <strong>Stay Finder</strong><br>
                Phone: 999999999<br>
                Email: stayfindernp@gmail.com<br>
                <abbr title="Phone">
            </address>
            <address>
                <iframe width="250px" height="200px" frameborder="1" scrolling="yes" marginheight="0" marginwidth="0" 
                src="https://maps.google.co.uk/maps?f=q&source=s_q&hl=en&geocode=&q=15+Springfield+Way,+Hythe,+CT21+5SH&aq=t&sll=52.8382,-2.327815&sspn=8.047465,13.666992&ie=UTF8&hq=&hnear=15+Springfield+Way,+Hythe+CT21+5SH,+United+Kingdom&t=m&z=14&ll=51.077429,1.121722&output=embed"></iframe>
            </address>
            </form>
        </div>
    </div>
</div>

<?php
include('../include/footer.php');
  ?>
  
    
</div>
</body>
</html>