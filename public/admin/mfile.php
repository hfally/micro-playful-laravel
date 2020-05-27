<?php 
session_start();

include("connect.php");

if($_SESSION['myvendor']==""  && $_SESSION['mypasskey']==""){

	header("location:index.php");


}elseif($_SESSION['myvendor']!="" && $_SESSION['mypasskey']!="" && $mysession!=""){

 $sql_pp="select * from  wb_admin where   wa_email='".$_SESSION['myvendor']."' and wa_psd='".$_SESSION['mypasskey']."' and wa_status='Active' and wa_session='$mysession' ";
	$result_get_details=mysqli_query($conn,$sql_pp); 
	while($rows=mysqli_fetch_array($result_get_details)){extract($rows);}
$_SESSION['myname']=$wa_name;
$_SESSION['myaccess']=$_SESSION['myvendor'];

}


?>