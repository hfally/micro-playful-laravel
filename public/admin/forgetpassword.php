<?php 
session_start();
include("connect.php"); 


if(isset($_POST['submit']) && $_POST['submit']=="submit"){
$eemail=mysqli_real_escape_string($conn,$_POST['eemail']);
$ppswd=mysqli_real_escape_string($conn,$_POST['ppswd']);


if($eemail==""){$error1="Cannot be empty";}
elseif($eemail!="" ){
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$userpassword= randomPassword();
$site_salt="subinsblogsalt";
$mypassword=hash('sha256', $userpassword.$site_salt.$p_salt);


$sql_l="select * from oc_vendor where   ocv_id='$eemail' or ocv_email='$eemail'";
$result_check_login=mysqli_query($conn,$sql_l); 
if(mysqli_num_rows($result_check_login)<1){$error1="Wrong Information";}elseif(mysqli_num_rows($result_check_login)>0){

mysqli_query($conn,"update oc_vendor set ocv_pswd='$mypassword' where     ocv_id='$eemail' or ocv_email='$eemail'"); 

while($rows=mysqli_fetch_array($result_check_login)) {extract($rows);}

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Vendor','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Login','Vendor Login','$mydate','$mytime','$ip','$mycountry','$user_browser')");



$startm='Dear '.$ocv_bname.', This is your temporary password, please change after login UBC: '.$ocv_id.' Password: '.$userpassword.'.  OCTRAMARKET Thank you.';

   $message = urlencode($startm.  "\r\n"."");
$mobile=$ocv_tel;



$sql="select * from oc_sms_setup";
$result_email=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_email)) {extract($rows);}

$url = $oss_sms_url;

//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = array(
    'messagecontent' => $startm,
        'sender' => $oss_sms_id,
    'mobile' => $mobile,
    'userid'=>$oss_sms_user,
    'mypassword'=>$oss_sms_psw
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
$result = curl_exec($ch);






 $message = '<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#F44336">
                            <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                            <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;"><img src="https://octramarket.com/admin/banner/whiteandlack.png" style="width:300px;" /></h1>
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
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"><h2>PASSWORD RESET SUCCESSFUL</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                  <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #000;">Hello, below is your temporary password, kindly change immediately after login.</p></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="47%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">UBC</td>
                                                <td width="53%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">: '.$ocv_id.'</td>
                                            </tr>
                                            <tr>
                                                <td width="47%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">Password:</td>
                                                <td width="53%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">: '.$userpassword.' </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">&nbsp;</td>
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
                                    <td align="center"> <img src="logo-footer.png" width="37" height="37" style="display: block; border: 0px;" /> </td>
                                </tr>
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                                        <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">'.$cp_addres.'<br>'.$cp_tel.' <br>'.$cp_email.'</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                        <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #000;">'.$oss_email_disclaimer.' </p>
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

$rgp_email=$oss_email_sender;
$to       = $ocv_email;
$subject  = "PROFILE PASSWORD RESET";
$headers  = 'From: '.$orgname.' <'.$rgp_email.'>' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\r\n";

$sent   = @mail($to,$subject,$message,$headers); 

$msg="A password reset instruction has been sent to $ocv_email";



 echo "<script>setTimeout(function () {
   window.location.href='index';},3000);</script>";
  

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
          <div class="card-header  text-white flex-column" style="background-color:#FF6400;">
            <img src="banner/octra market logo black.png" style="width:200px; "><br>
              <h6 class="text-center mb-0">Vendors Sign In</h6>
          </div>
          <div class="card-body p-4">

            <!-- LOG IN FORM -->
     <div align="center"><?php if($msg!=""){ ?> <span style="color:blue; font-weight:bolder;"><?php echo $msg; ?></span><?php  } ?>
                  <?php if($error1!=""){ ?><span style="color:red; font-weight:bolder;"><?php echo $error1; ?></span><?php } ?></div>

            <form action="" method="post" name="form1" id="form1">
              <div class="form-group">
                <div class="floating-label input-icon">
                  <i class="material-icons">person</i>
                  <input type="text" class="form-control" placeholder="Vendor UBC" id="email" name="eemail">
                  <label for="email">Vendor UBC</label>
                </div>
              </div>
              
              <div class="form-group d-flex justify-content-between align-items-center">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="remember">
                  <label class="custom-control-label" for="remember">Remember me</label>
                </div>
                <a href="forgetpassword" class="text-primary text-decoration-underline small">Forgot password ?</a>
              </div>
              <button type="submit" value="submit" name="submit" class="btn btn-warning btn-block">Reset Password</button>
              <div class="text-center opacity-50 font-italic"><a href="../seller"  class="text-primary text-decoration-underline small">Create a  Vendor Account</a> </div>
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