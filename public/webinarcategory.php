<?php include("header.inc.php");

$category=mysqli_real_escape_string($conn,$_GET['category']);

if($category!=""){

$sql="select ocw_id,ocw_title,  ocw_category,ocw_date,ocw_brief,ocw_image,ocw_speaker,ocw_time from oc_webinar where ocw_status='Open' and ocw_category='$category'";
$result_opened=mysqli_query($conn,$sql);


}
 ?>
  <!-- Hero Section-->
  <section class="inner-hero inner-hero3">
    <div class="container">
      <div class="ih-content">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">Welcome</h1>
     
      </div>
    </div>
  </section>
  <!-- /Hero Section-->
  <!-- Blog Section-->
  <section class="blog blog-3 inner-blog">
    <div class="container">
      <div class="row">
        <?php while($rows=mysqli_fetch_array($result_opened))  {extract($rows); ?> <div class="col-md-4">
          <div class="single-blog  wow fadeInUp" data-wow-delay=".4s">
            <a href="viewebinar?webinar=<?php echo $ocw_id; ?>" target="_blank">
              <div class="sb-img">
                <img src="admin/banner/<?php echo $ocw_image; ?>" alt="">
              </div>
            </a>
            <div class="sb-content">
              <span><?php echo $newDate = date("M d, Y", strtotime($ocw_date)); ?> <?php echo $ocw_time; ?> | <?php  $sql="select wc_category from wb_category where wc_id='$ocw_category'";
$result_category=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_category)) {extract($rows); 

  echo $wc_category; } ?> </span>
              <a href="viewebinar?webinar=<?php echo $ocw_id; ?>">
                <h3><?php echo $ocw_title; ?></h3>
              </a>
              <p>


                <?php 

                $string = strip_tags($ocw_brief);
if (strlen($string) > 300) {

    // truncate string
    $stringCut = substr($string, 0, 300);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '... <a href="viewebinar?webinar='.$ocw_id.'">Read More</a>';
}

echo $string;
?></p>
            </div>
          </div>
        </div><?php } ?>
      
      </div>

      <div class="pagination">
        <ul>
          <li><a href="">&#x0003C;</a></li>
          <li><a href="">1</a></li>
          <li><a href="">2</a></li>
          <li><a href="">3</a></li>
          <li><a href="">&#x0003E;</a></li>
        </ul>
      </div>
    </div>

  </section>
  <!-- /Blog Section-->
 <?php include("footer.php"); ?>
  <!-- /Footer Section-->

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