<?php include("header.inc.php");
$mydate=date('Y-m-d');


$speaker=mysqli_real_escape_string($conn,$_GET['speaker']);

if($speaker!=""){

$sql="select * from oc_speaer where    ocs_id='$speaker'";
$result_gt_details=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_gt_details)) {extract($rows);
}


}


 ?>

  <!-- Hero Section-->
  <section class="inner-hero inner-hero3">
    <div class="container">
      <div class="ih-content">
        <h1 class="wow fadeInUp" data-wow-delay=".4s"><?php echo $ocw_title; ?></h1>
        
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
                    <img src="admin/banner/<?php echo $ocs_image; ?>" alt="">
                  </div>
                </a>
                <div class="sb-content sbc-details">
                  <a href="">
                    <h2><?php echo $ocs_fullname; ?></h2>
                  </a>
          <span style="text-align: justify-all;"><?php echo $ocs_profile; ?></span>
                </div>
                
              </div>

          
              <!--End Blog comment section-->

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