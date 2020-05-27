<?php include("header.inc.php");


$limit = 9;  
if (isset($_GET["webinar"])) { $page  = $_GET["webinar"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 

$sql="select ocw_id,ocw_title,  ocw_category,ocw_date,ocw_brief,ocw_image,ocw_speaker,ocw_time from oc_webinar where ocw_status='Open' LIMIT $start_from, $limit";
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
      <?php while($rows=mysqli_fetch_array($result_opened))  {extract($rows); ?> <div class="col-lg-4 card"  style="margin-bottom: 15px">
          <div class="single-blog  wow fadeInUp" data-wow-delay=".4s">
            <a href="viewebinar?webinar=<?php echo $ocw_id; ?>" target="_blank">
              <div class="sb-img">
                <img src="admin/banner/<?php echo $ocw_image; ?>" alt="">
              </div>
            </a>
            <div class="sb-content">
              <span>Webinar</span>
              <a href="viewebinar?webinar=<?php echo $ocw_id; ?>">
                <h3><?php echo $ocw_title; ?></h3>
              </a>
              <p>


                <?php 

                $string = strip_tags($ocw_brief);
if (strlen($string) > 80) {

    // truncate string
    $stringCut = substr($string, 0, 80);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
}

echo $string;
?></p>
       <div class="box-footer">

            <a href="viewebinar?webinar=<?php echo $ocw_id; ?>" class="btn button">View The Webinar</a></div>
            </div>
           </div>


        </div>


       <?php } ?>
       
       
      </div>



<?php  
$sql = "SELECT COUNT(ocw) FROM oc_webinar where ocw_status='Open'";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
for ($i=1; $i<=$total_pages; $i++) { ?>
  
            <li class="active"><a href='index.php?webinar=<?php echo $i; ?>' class="btn btn-circle "><?php echo $i; ?></a></li></ul>

<?php  }?> 

<?php 
?>

  
  
    
    
 
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