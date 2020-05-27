<?php include("header.inc.php");
$mydate=date('Y-m-d');


$webinar=mysqli_real_escape_string($conn,$_GET['webinar']);

if(isset($_POST['register']) && $_POST['register']=="register"){

$ffname=mysqli_real_escape_string($conn,$_POST['ffname']);
$llname=mysqli_real_escape_string($conn,$_POST['llname']);
$eemail=mysqli_real_escape_string($conn,$_POST['eemail']);
$ttelephone=mysqli_real_escape_string($conn,$_POST['ttelephone']);
$weblink=mysqli_real_escape_string($conn,$_POST['weblink']);

if($ffname==""){$error1="Provide First Name";}
elseif($llname==""){$error2="Provide Last Name";}
elseif($eemail==""){$error3="Provide an email";}
elseif($ttelephone==""){$error4="Provide Telephone Number";}
elseif($ffname!="" || $llname!="" || $eemail!="" || $ttelephone!=""){
$sql="select wwr_email from wb_webinar_register where wwr_email='$eemail' and wwr_webinar='$webinar'";
$result_check_email=mysqli_query($conn,$sql); 
if(mysqli_num_rows($result_check_email)>0){$error3="Email already registered for this webinar";}else{



$sql="select * from oc_webinar where    ocw_id='$webinar'";
$result_gt_details=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_gt_details)) {extract($rows);
}


 $sql="select ocs_fullname from oc_speaer where ocs_id='$ocw_speaker'"; $result_speaker=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_speaker)) {extract($rows);}

mysqli_query($conn,"insert into wb_webinar_register (wwr_webinar,wwr_lname,wwr_fname,wwr_email,wwr_telephone,wwr_date,wwr_ip,wwr_location) values('$webinar','$llname','$ffname','$eemail','234".substr($ttelephone,1,10)."','$mydate','$ip','$mycountry')");


$actuallink=$base_url="https://".$_SERVER['SERVER_NAME'].'/webinar/admin/banner/'.$cp_logo;

$clientname=$llname.' '.$ffname;


 $message = '<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td height="777" align="center" bgcolor="#eeeeee" style="background-color: #eeeeee;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td height="107" align="center" valign="top" bgcolor="#f59306;" style="font-size:0; padding: 35px;">
                            <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                            <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;"><img src="'.$actuallink.'" /></h1>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                            <table cellspacing="0" cellpadding="0" border="0" align="right">
                                                <tr>
                                                    <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
                                                    
                                                    </td>
                                                    <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;"> <a href="#" target="_blank" style="color: #ffffff; text-decoration: none;"> </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div></td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"><h2>WEBINAR REGISTRATION SUCCESSFUL</h2></td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #000;">Hi '.$clientname.' your registration for the WEBINAR was successfully.</p></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"><h3> '.$ocw_title.'</h3></td>
                                            </tr>
                                            <tr>
                                              <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"><p>Speaker<br><strong> '.$ocs_fullname.'</strong></p></td>
                                            </tr>
                                            <tr>
                                              <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"><p>Date and Time: <br><strong>'.$ocw_date.' '.$ocw_time.'</strong></p> </td>
                                            </tr>
                                           
                                            <tr>
                                              <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"><a href="'.$ocw_link.'">Webinar Access Link</a></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">Thank you.</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                                        <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">'.$cp_addres.'<br>'.$cp_tel.' <br>'.$cp_email.'</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                        <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #000;">&nbsp;</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
      </tr>
    </table>
</body>
';
$rgp_email=$cp_email;
$to       = $eemail;
$subject  = "WEBINAR REGISTRATION SUCCESSFUL";
$headers  = 'From: '.$cp_dpname.' <'.$rgp_email.'>' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\r\n";

$sent   = @mail($to,$subject,$message,$headers); 


$msg="You have successfully registered for the WEBINAR, an Email with the link has been sent to $eemail";




}



}


}




if($webinar!=""){

$sql="select * from oc_webinar where    ocw_id='$webinar'";
$result_gt_details=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_gt_details)) {extract($rows);
}


$sql="select wwct_wid from web_webinar_count where  wwct_wid='$webinar' and wwct_session='$mysession'";
$result_count_webinar_views=mysqli_query($conn,$sql); 
if(mysqli_num_rows($result_count_webinar_views)<1){

  mysqli_query($conn,"insert into web_webinar_count(wwct_wid,wwct_session,wwct_date,wwct_browser,wwct_ip,wwct_location) values('$webinar','$mysession','$mydate','$user_browser','$ip','$mycountry') ");
}

}


 ?>

  <!-- Hero Section-->
  <section class="inner-hero inner-hero3">
    <div class="container">
      <div class="ih-content">
        <h1 class="wow fadeInUp" data-wow-delay=".4s"><?php echo $ocw_title; ?></h1>
      <?php if($msg!=""){ ?><span style="color: yellow; font-weight: bolder; font-size: 20px;"><?php echo $msg; ?></span><?php } ?>
      </div>
    </div>
  </section>
  <!-- /Hero Section-->
  <!-- Blog Section-->
  <section class="blog blog-3 inner-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-md-1 order-2">
          <div class="row">
            <div class="col-md-12">
              <div class="single-blog">
                <a href="">
                  <div class="sb-img">
                    <img src="admin/banner/<?php echo $ocw_image; ?>" alt="">
                  </div>
                </a>
                <div class="sb-content sbc-details">
                  <span><?php echo $newDate = date("M d, Y", strtotime($ocw_date)); ?> | <?php  $sql="select wc_category from wb_category where wc_id='$ocw_category'";
$result_category=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_category)) {extract($rows); 

  echo $wc_category; } ?> |  Speaker: <?php $sql="select ocs_fullname from oc_speaer where ocs_id='$ocw_speaker'"; $result_speaker=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_speaker)) {extract($rows); echo $ocs_fullname; } ?></span>
                  <a href="#">
                    <h2><?php echo $ocw_title; ?> </h2>
                  </a><br><?php if($ocw_register=="No")  { ?><a href="<?php echo $ocw_link; ?>" class="button" target="_blank">Click to Access Webinar</a><?php } ?><?php if($ocw_register=="Yes")  { ?><a href="#register" class="button" target="_blank">Register to Access Webinar</a><?php } ?>
           <span style="text-align: justify-all;"><?php echo $ocw_brief; ?></span>

                </div>
               
              </div>

           
            <?php if($ocw_register=="Yes")  { ?>
          

              <div class="get-a-comment" id="register">
                <!--Get a comment section-->
                <h3>Register for webinar</h3>
                <form action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
                  <div class="form-group cfdb1"><span style="color: red;"><?php echo $error1; ?></span>
                    <input type="text" class="form-control cp1" name="ffname"  placeholder="Last Name">
                  </div>
                   <div class="form-group cfdb1"><span style="color: red;"><?php echo $error2; ?></span>
                    <input type="text" class="form-control cp1" name="llname"placeholder="First Name">
                  </div>
                  <div class="form-group cfdb1"><span style="color: red;"><?php echo $error3; ?></span>
                    <input type="email" class="form-control cp1" name="eemail" placeholder="Email"
                      onfocus="this.placeholder = ''" onblur="this.placeholder ='Email'">
                  </div>
                  <div class="form-group cfdb1"><span style="color: red;"><?php echo $error4; ?></span>
                    <input type="text" class="form-control cp1" name="ttelephone" placeholder="Telephone Number (08012345678)">
                  </div>
                  <input type="hidden" name="weblink" value="<?php echo $ocw_link; ?>">
                 
                 
              <button type="submit" id="submit" class="btn  botton btn-primary" name="register" value="register">Register</button>
                </form>


              </div><?php } ?>
              <!--End get a comment section-->
            </div>
          </div>
        </div>
        <div class="col-md-4 order-md-2 order-1">
          <div class="blog-sideber">
            
            <div class="recent-post">
              <h4>Upcoming Webinars</h4>
           <?php $sql="select * from oc_webinar where   ocw_date>'$mydate' ORDER BY ocw_date DESC LIMIT 5";
           $result_recent=mysqli_query($conn,$sql);
           while($rows=mysqli_fetch_array($result_recent)) {extract($rows);

            ?>   <div class="single-recent-blog">
                <div class="srb-img">
                  <a href="viewebinar?webinar=<?php echo $ocw_id; ?>"><img src="admin/banner/<?php echo $ocw_image; ?>" alt=""></a>
                </div>
                <div class="srb-text">
                  <a href="viewebinar?webinar=<?php echo $ocw_id; ?>">
                    <h5><?php echo $ocw_title; ?></h5>
                  </a>
                  <span><?php echo $newDate = date("M d, Y", strtotime($ocw_date)); ?></span>
                </div>
              </div><?php } ?>
              
            </div>
            <div class="catagory">
              <h4>Categories</h4>

              <ul>
            <?php $sql="select * from wb_category"; 
            $result_cat=mysqli_query($conn,$sql); 
            while($rows=mysqli_fetch_array($result_cat))  {extract($rows) ?><li><a href="webinarcategory?category=<?php echo $wc_id; ?>"><?php echo $wc_category; ?></a></li><?php } ?>
               
              </ul>
            </div>
           
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /Blog Section-->
 <?php include("footer.php"); ?>


  
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