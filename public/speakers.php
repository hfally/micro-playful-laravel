<?php include("header.inc.php");


$sql="select ocs_id,ocs_fullname,  ocs_category,ocs_profile,ocs_image from oc_speaer where ocs_status='Active'";
$result_opened=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result_opened);
 ?>
  <!-- Hero Section-->
  <section class="inner-hero inner-hero3">
    <div class="container">
      <div class="ih-content">
        <h1 class="wow fadeInUp" data-wow-delay=".4s">Welcome to <?php echo $cp_dpname; ?> Webinar Collection</h1>
     
      </div>
    </div>
  </section>
  <!-- /Hero Section-->
  <!-- Blog Section-->
  <section class="blog blog-3 inner-blog">
    <div class="container">
      <div class="row">
      <?php while($rows=mysqli_fetch_array($result_opened))  {extract($rows); ?> <div class="mt-2 col-md-6 card"   style="margin-bottom: 15px">
          <div class="single-blog  wow fadeInUp" data-wow-delay=".4s">
            <a href="viewspeakers?speaker=<?php echo $ocs_id; ?>" target="_blank">
              <div class="sb-img">
                <img src="admin/banner/<?php echo $ocs_image; ?>" alt="">
              </div>
            </a>
            <div class="sb-content">
              <span>Speaker</span>
              <a href="viewspeakers?speaker=<?php echo $ocs_id; ?>">
                <h3><?php echo $ocs_fullname; ?></h3>
              </a>
              <p>


                <?php 

                $string = strip_tags($ocs_profile);
if (strlen($string) > 100) {

    // truncate string
    $stringCut = substr($string, 0, 100);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
}

echo $string;
?></p>
<a href="viewspeakers?speaker=<?php echo $ocs_id; ?>" class="btn button">View Speaker</a>
            </div>
          </div>
        </div><div style="clear:both;"></div><?php } ?>
       
       
      </div>

    <?php if($count>15) { ?> <div class="pagination">
        <ul>
          <li><a href="">&#x0003C;</a></li>
          <li><a href="">1</a></li>
          <li><a href="">2</a></li>
          <li><a href="">3</a></li>
          <li><a href="">&#x0003E;</a></li>
        </ul>
      </div><?php } ?>
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