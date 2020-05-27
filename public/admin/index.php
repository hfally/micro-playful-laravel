<?php 
session_start();
include("connect.php"); 


if(isset($_POST['submit']) && $_POST['submit']=="submit"){
$eemail=mysqli_real_escape_string($conn,$_POST['eemail']);
$ppswd=mysqli_real_escape_string($conn,$_POST['ppswd']);


if($eemail==""){$error1="Provide Email Address";}
elseif($ppswd==""){$error1="Provide Password";}
elseif($eemail!="" || $ppswd!=""){
$_SESSION['myvendor']=$eemail;
$site_salt="subinsblogsalt";
$mypassword=hash('sha256', $ppswd.$site_salt.$p_salt);
$_SESSION['mypasskey']=$mypassword;



$sql_l="select wa_email from wb_admin where   wa_email='".$_SESSION['myvendor']."' and wa_psd='".$_SESSION['mypasskey']."' and wa_status='Active'";
$result_check_login=mysqli_query($conn,$sql_l); 
if(mysqli_num_rows($result_check_login)<1){$error1="Wrong Login Credentials";}elseif(mysqli_num_rows($result_check_login)>0){

mysqli_query($conn,"update wb_admin set wa_session='$mysession' where   wa_email='".$_SESSION['myvendor']."' and wa_psd='".$_SESSION['mypasskey']."' and wa_status='Active'");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Vendor','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Login','Vendor Login','$mydate','$mytime','$ip','$mycountry','$user_browser')");

$msg="Wait while dashboard is prepared...";

 echo "<script>setTimeout(function () {
   window.location.href='dashboard';},3000);</script>";
  

}}

}



 ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="msapplication-tap-highlight" content="no"/>
  <!-- Font & Icon -->
  <link rel="stylesheet" href="font/inter/inter.min.css">
  <link href="plugins/material-design-icons-iconfont/material-design-icons.min.css" rel="stylesheet">
  <!-- Plugins -->
  <!-- CSS plugins goes here -->
  <!-- Main Style -->
  <link rel="stylesheet" href="plugins/perfect-scrollbar/perfect-scrollbar.min.css">
  <link rel="stylesheet" href="css/style.min.css" id="main-css">
  <link rel="stylesheet" href="css/sidebar-gray.min.css" id="theme-css"> <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
  <title><?php echo $cp_ptitle; ?></title>
</head>

<body class="login-page">

  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-auto d-flex justify-content-center">
        <div class="card shadow">
          <div class="card-header  text-white flex-column" style="background-color:#FFF;">
            <img src="banner/<?php echo $cp_logo; ?>" style="width:200px; "><br>
              <h6 class="text-center mb-0" style="color:#FF6400;">Admin Sign In</h6>
          </div>
          <div class="card-body p-4">

            <!-- LOG IN FORM -->
     <div align="center"><?php if($msg!=""){ ?> <span style="color:blue; font-weight:bolder;"><?php echo $msg; ?></span><?php  } ?>
                  <?php if($error1!=""){ ?><span style="color:red; font-weight:bolder;"><?php echo $error1; ?></span><?php } ?></div>

            <form action="" method="post" name="form1" id="form1">
              <div class="form-group">
                <div class="floating-label input-icon">
                  <i class="material-icons">mail</i>
                  <input type="email" class="form-control" placeholder="Email Address" id="email" name="eemail">
                  <label for="email">Email Address</label>
                </div>
              </div>
              <div class="form-group">
                <div class="floating-label input-icon">
                  <i class="material-icons">lock_open</i>
                  <input type="password" class="form-control" placeholder="Password" id="password" name="ppswd">
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="form-group d-flex justify-content-between align-items-center">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="remember">
                  <label class="custom-control-label" for="remember">Remember me</label>
                </div>
                <a href="forgetpassword" class="text-primary text-decoration-underline small">Forgot password ?</a>
              </div>
              <button type="submit" value="submit" name="submit" class="btn btn-warning btn-block">LOG IN</button>
            
              <hr>
              <p style="font-size: 10px;" align="center">&copy <?php echo date('Y'); ?> <?php echo $cp_ftitle; ?></p>
            </form>
           
            <!-- /LOG IN FORM -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Plugins -->
  <!-- JS plugins goes here -->

</body>

</html>