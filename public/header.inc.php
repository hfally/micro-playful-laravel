<?php include("connect.php");
$mydate=date('Y-m-d');

$sql="select wwc_session from wb_web_count where wwc_session='$mysession' and wwc_date='$mydate' ";
$result_count_view=mysqli_query($conn,$sql); 
if(mysqli_num_rows($result_count_view)<1){
mysqli_query($conn,"insert into  wb_web_count(wwc_session,wwc_date,wwc_browser,wwc_ip,wwc_location) values('$mysession','$mydate','$user_browser','$ip','$mycountry')");

}



$sql="select * from oc_profile";
$result_biz_profile=mysqli_query($conn,$sql);
while($rows=mysqli_fetch_array($result_biz_profile)) {extract($rows);
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $cp_ptitle ; ?></title>
  <!-- Mobile Specific Meta  -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!--- Font-->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&display=swap" rel="stylesheet">
  <!-- CSS -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Jquery ui CSS -->
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <!-- Fancybox CSS -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="assets/css/font-awosome.css">
  <!-- Flaticon CSS -->
  <link rel="stylesheet" href="assets/flat-font/flaticon.css">
  <!-- Slick Slider -->
  <link rel="stylesheet" href="assets/slick/slick-theme.css">
  <link rel="stylesheet" href="assets/slick/slick.css">
  <!-- Ticker css-->
  <link rel="stylesheet" href="assets/css/ticker.min.css">
  <!-- Nav Menu CSS -->
  <link rel="stylesheet" href="assets/css/sm-core-css.css">
  <link rel="stylesheet" href="assets/css/sm-mint.css">
  <link rel="stylesheet" href="assets/css/sm-style.css">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <!-- Main StyleSheet CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/fab-icon.png">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<style> 
div.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
  margin-top:5px;
}

.button {
  background-color: #f97821; /* Green */
  border-color: #f97821;
  color: #FFF;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.btn-shadow{
  
  box-shadow: 3px 1px 10px #FFF; 
}


.box-footer {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  border-top: 1px solid #f4f4f4;
  padding: 10px;
  background-color: #fff;
  vertical-align: bottom;
  height:auto;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
  border-color:#FFF;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
    box-shadow: 3px 1px 10px #252020;
    color: orange;
}
.btn-shadow{
  
  box-shadow: 3px 1px 10px #252020; 
}




</style>

<body>
  <!---Preloder-->
  <!-- /Preloder-->
  <!--Scroll Top-->
  <div class="scrollup"><i class="fas fa-long-arrow-alt-up scrollup-icon"></i></div>
  <!--Scroll Top-->
  <!-- Header Area-->
  <header class="header-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="main-nav" role="navigation">
            <!-- Mobile menu toggle button (hamburger/x icon) -->
            <input id="main-menu-state" type="checkbox" />
            <label class="main-menu-btn" for="main-menu-state">
              <span class="main-menu-btn-icon"></span>
            </label>
            <h2 class="nav-brand"><a href="#"><img class="top-logo" src="admin/banner/<?php echo $cp_logo; ?>" alt=""></a></h2>
            <!-- Sample menu definition -->
            <ul id="main-menu" class="sm sm-mint">
              <li><a href="index">Home</a></li>
            
              <li><a href="speakers">Speakers</a></li>
              
              <li><a href="contact-us">Contact</a></li>
              
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!--/Header Area-->
