

<?php
session_start();
ini_set("display_errors","off");
include("mfile.php");
$mydate=date('Y-m-d');
$mytime=date('Y-m-d H:i:s');

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Log Out','Admin Successfully Logged Out','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  $result_log=mysqli_query($conn,$sql_allinsert);
  
unset($_SESSION['myvendor']);
session_destroy();
 echo "<script>setTimeout(function () {
   window.location.href='index.php';},100);</script>";exit;
?>

