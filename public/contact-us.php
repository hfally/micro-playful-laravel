<?php include("header.inc.php"); 
$mydate=date('Y-m-d');

if(isset($_POST['sendmessage']) && $_POST['sendmessage']=="sendmessage"){
$myname=mysqli_real_escape_string($conn,$_POST['myname']);
$myemail=mysqli_real_escape_string($conn,$_POST['myemail']);
$mytelephone=mysqli_real_escape_string($conn,$_POST['mytelephone']);
$mymsg=mysqli_real_escape_string($conn,$_POST['mymsg']);

if($myname==""){$error1="Provide your name";}
elseif($myemail==""){$error2="Provide Email Address";}
elseif($mytelephone==""){$error3="Provide Telephone Number";}
elseif($mymsg==""){$error4="Cannot be empty";}
elseif($myname!="" || $myemail!="" || $mytelephone!="" || $mymsg!=""){


mysqli_query($conn,"insert into wb_contact_us(wcu_name,wcu_email,wcu_tel,wcu_message,wcu_date,wcu_ip,wcu_location) values('$myname','$myemail','234".substr($mytelephone,1,10)."','$mymsg','$mydate','$ip','$mycountry')");
$msg="Thank you for contact us, we will get back to you soon.";

}


}



?>
  <!-- Hero Section-->
  <section class="inner-hero inner-hero3">
    <div class="container">
      <div class="ih-content">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">Contact us</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb wow fadeInUp" data-wow-delay=".8s">
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li><br>
                  <?php if($msg!=""){ ?><span style="color: yellow; font-weight: bolder;  font-size: 20px;"><?php echo $msg; ?></span><?php } ?>

          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- /Hero Section-->
  <!--contact Us Section-->
  <section class="contact-us">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="contact-details">
            <h2>Contact us</h2>
           
            <div class="single-contact-details">
              <h5>Phone:</h5>
              <p><?php echo $cp_tel; ?></p>
              <p><?php echo $cp_phone; ?></p>
            </div>
            <div class="single-contact-details">
              <h5>Send Email:</h5>
              <p><?php echo $cp_email; ?></p>
            </div>
            <div class="single-contact-details">
              <h5>Address:</h5>
              <p><?php echo $cp_addres; ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="contact-information">
                <form action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
              <div class="form-group cfdb1"><span style="color: red;"><?php echo $error1; ?></span>
                <input type="text" class="form-control cp1" name="myname"placeholder="Name">
              </div>
              <div class="form-group cfdb1"><span style="color: red;"><?php echo $error2; ?></span>
                <input type="email" class="form-control cp1" name="myemail"placeholder="Email">
              </div>
              <div class="form-group cfdb1"><span style="color: red;"><?php echo $error3; ?></span>
                <input type="text" class="form-control cp1" name="mytelephone"  placeholder="Telephone (08012345678)">
              </div>
              <div class="form-group cfdb1"><span style="color: red;"><?php echo $error4; ?></span>
                <textarea rows="8" class="form-control cp1" name="mymsg" id="msg" placeholder="Comment"></textarea>
              </div>
              <button type="submit" name="sendmessage" value="sendmessage"  class="btn btn-primary">Send Message</button>
              <div class="col-md-12 text-center">
                <div class="cf-msg"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/contact Us Section-->
  <!-- Footer Section-->
 <?php include("footer.php"); ?>

  <!-- Scripts -->


  
  <!-- jQuery Plugin -->
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- Jquery ui JS-->
  <script src="assets/js/jquery-ui.js"></script>
  <!--  Nav  -->
  <script src="assets/js/jquery.smartmenus.js"></script>
  <!-- Slick Slider -->
  <script src="assets/slick/slick.min.js"></script>
  <!-- Main Counterup Plugin-->
  <script src="assets/js/jquery.counterup.min.js"></script>
  <!-- Main Counterdown Plugin-->
  <script src="assets/js/countdown.js"></script>
  <!-- Waypoint Js-->
  <script src="assets/js/waypoints.min.js"></script>
  <!-- Fancybox Js-->
  <script src="assets/js/jquery.fancybox.min.js"></script>
  <!-- Ticker Js Plugin-->
  <script src="assets/js/ticker.min.js"></script>
  <!-- WOW JS Plugin-->
  <script src="assets/js/wow.min.js"></script>
  <!-- Main Script -->
  <script src="assets/js/theme.js"></script>

</body>

</html>