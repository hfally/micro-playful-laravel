<?php

$_GET['mainmenu']='dashboard';

 include("header.inc.php"); 

 $themonth=date('Y-m');

 $mydate=date('Y-m-d');



$sql="select ocw from oc_webinar";
$result_count_webinar=mysqli_query($conn,$sql); 
$count_webinar=mysqli_num_rows($result_count_webinar);


$sql="select ocs from oc_speaer";
$result_count_speaker=mysqli_query($conn,$sql); 
$count_speaker=mysqli_num_rows($result_count_speaker);


$sql="select wwc from wb_web_count where wwc_date='$mydate'";
$result_count_visit=mysqli_query($conn,$sql); 
$count_view=mysqli_num_rows($result_count_visit);

$sql="select wwr from wb_webinar_register";
$result_count_register=mysqli_query($conn,$sql); 
$count_register=mysqli_num_rows($result_count_register);

 ?>

    <!-- Main body -->
    <div class="main-body">

      <div class="row gutters-sm">

        <!-- Website Audience Metrics -->



        <!-- Connections -->
    <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card h-100">
            <div class="card-body">
                            <div class="flex-center justify-content-start mb-2">
                <i data-feather="link" class="mr-2 font-size-lgs"></i>
                <h3 class="card-title mb-0 mr-auto"><?php echo number_format($count_webinar); ?></h3>
              </div>
              <a href="managewebinar">    <h6 class="text-primary">Uploaded Webinar</h6></a>
            </div>
          </div>
        </div>
        <!-- /Connections -->
 
        <!-- Your Articles -->
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <div class="flex-center justify-content-start mb-2">
                <i data-feather="book" class="mr-2 font-size-lgs"></i>
                <h3 class="card-title mb-0 mr-auto"><?php echo number_format($count_speaker); ?></h3>
              </div>
                <a href="speakers">   <h6 class="text-danger">Total Speakers</h6></a>
            </div>
          </div>
        </div>
        <!-- Your /Articles -->

        <!-- Your Photos -->
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <div class="flex-center justify-content-start mb-2">
                <i data-feather="image" class="mr-2 font-size-lgs"></i>
                <h3 class="card-title mb-0 mr-auto"><?php echo number_format($count_register); ?></h3>
              </div>
                <a href="registrations">  
  <h6 class="text-success">Total Registration</h6></a>
            </div>
          </div>
        </div></a>
        <!-- Your /Photos -->

        <!-- Page Likes -->
        <div class="col-sm-6 col-xl-3 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <div class="flex-center justify-content-start mb-2">
                <i data-feather="thumbs-up" class="mr-2 font-size-lgs"></i>
                <h3 class="card-title mb-0 mr-auto"><?php echo number_format($count_view); ?></h3>
              </div>
              <h6 class="text-info">Today's View</h6>
            </div>
          </div>
        </div>
        <!-- Page /Likes -->



    

      </div>

    </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->

  <!-- Main Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="plugins/feather-icons/feather.min.js"></script>
  <script src="js/script.min.js"></script>

  <!-- Plugins -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <script src="plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script>
    // Data example
    monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    data1 = [150, 110, 90, 115, 125, 160, 160, 140, 100, 110, 120, 120]
    data2 = [180, 140, 120, 135, 155, 170, 180, 150, 140, 150, 130, 130]
    data3 = [100, 90, 60, 70, 100, 75, 90, 85, 90, 100, 95, 88]

    // Chart options
    const options = {
      maintainAspectRatio: false, // disable the maintain aspect ratio in options then it uses the available height
      tooltips: {
        mode: 'index',
        intersect: false, // Interactions configuration: https://www.chartjs.org/docs/latest/general/interactions/
      },
      elements: {
        rectangle: {
          borderWidth: 1 // bar border width
        },
        line: {
          borderWidth: 1 // label border width
        }
      },
      legend: {
        display: false // hide label
      }
    }

    /***************** Website Audience Metrics *****************/
    new Chart('websiteAudienceMetrics', {
      type: 'bar',
      data: {
        labels: monthNames,
        datasets: [
          {
            backgroundColor: Chart.helpers.color(cyan).alpha(0.5).rgbString(),
            borderColor: cyan,
            data: data1
          },
          {
            backgroundColor: Chart.helpers.color(blue).alpha(0.5).rgbString(),
            borderColor: blue,
            data: data2
          }
        ]
      },
      options: options
    })

    /***************** Sessions By Channel *****************/
    new Chart('sessionsByChannel', {
      type: 'doughnut',
      data: {
        labels: ['Organic Search', 'Email', 'Referrral', 'Social Media'],
        datasets: [{
          data: [25, 20, 30, 25],
          backgroundColor: [
            Chart.helpers.color(red).alpha(0.5).rgbString(),
            Chart.helpers.color(blue).alpha(0.5).rgbString(),
            Chart.helpers.color(cyan).alpha(0.5).rgbString(),
            Chart.helpers.color(orange).alpha(0.5).rgbString(),
          ]
        }]
      },
      options: options
    })

    /***************** Device Sessions *****************/
    new Chart('deviceSessions', {
      type: 'line',
      data: {
        labels: monthNames,
        datasets: [
          {
            label: 'Mobile',
            backgroundColor: Chart.helpers.color(blue).alpha(0.1).rgbString(),
            borderColor: blue,
            tension: 0,
            pointRadius: 0,
            data: data2
          },
          {
            label: 'Desktop',
            backgroundColor: Chart.helpers.color(yellow).alpha(0.1).rgbString(),
            borderColor: yellow,
            tension: 0,
            pointRadius: 0,
            data: data1
          },
          {
            label: 'Other',
            backgroundColor: Chart.helpers.color(pink).alpha(0.1).rgbString(),
            borderColor: pink,
            tension: 0,
            pointRadius: 0,
            data: data3
          }
        ]
      },
      options: options
    })

    $(() => {
      /***************** Connections *****************/
      $('#connections').sparkline('html', {
        type: 'bar',
        barWidth: 8,
        height: 20,
        barColor: blue
      })

      /***************** Your Articles *****************/
      $('#yourArticles').sparkline('html', {
        type: 'bar',
        barWidth: 8,
        height: 20,
        barColor: red
      })

      /***************** Your Photos *****************/
      $('#yourPhotos').sparkline('html', {
        type: 'bar',
        barWidth: 8,
        height: 20,
        barColor: green
      })

      /***************** Your Photos *****************/
      $('#pageLikes').sparkline('html', {
        type: 'bar',
        barWidth: 8,
        height: 20,
        barColor: cyan
      })
    })
  </script>

</body>

</html>