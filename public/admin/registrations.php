<?php
$_GET['mainmenu']='payments';
$_GET['submenu']='payments';



ini_set("display_errors","off");

if(isset($_POST['Download'])){
  
$date=date('Ymd');
$tim=date('H:s');
$filenamey=$date.$tim;


  header("Content-type: application/octet-stream");
          header("Content-Disposition:attachment; filename= $filenamey.xls");
          print "$header";
  }

include("header.inc.php"); 



?><?php if(!isset($_POST['Download'])){ ?>

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Webinars</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <section id="section1">
                <h5>Registrations</h5>
                         <form role="form" method="post"enctype="multipart/form-data" action="<?php mysqli_real_escape_string($conn,$_SERVER["PHP_SELF"]);?>" name="form1" id="form1">         <input type="submit" name="Download" value="Download to Excel" class="btn btn-success"></h5> 
                                      
 </form>
               
                <div class="row">
                
                 <div class="col-sm-12 mb-3"><?php } ?>
 <table <?php if(!isset($_POST['Download'])){ ?>
 id="example" <?php } ?> class="table table-striped table-bordered table-sm dt-responsive nowrap w-100">
                                    <thead>
            
              <tr>
                <th>S/N</th>
                <th>Webinar Title</th>
                <th>Date & Time</th>
                                                <th>Email</th>

                                              
                                                <th>Telephone</th>

             
                <th>Registration Date</th>

               
              
              </tr>
            </thead>
            <!-- /Filter columns -->

            <tbody>
          <?php $sql="select * from wb_webinar_register  ORDER BY wwr DESC"; 
          $result_oc_admin=mysqli_query($conn,$sql); 
          while($rows=mysqli_fetch_array($result_oc_admin)) {extract($rows); ?>      <tr>
                  <td><?php echo $abc+=1; ?></td>
                  <td><?php

$sql="select * from oc_webinar where    ocw_id='$wwr_webinar'";
$result_gt_details=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_gt_details)) {extract($rows);
}?> <?php echo $ocw_title; ?></td>
                  <td><?php echo $ocw_date; ?> <?php echo $ocw_time; ?></td>
                                                      

<td><?php echo $wwr_email; ?></td>
<td><?php echo $wwr_telephone; ?></td>



                 
            <td><?php echo $wwr_date; ?></td>


                 
                
                </tr><?php  } ?>


              </tbody></table><?php if(!isset($_POST['Download'])){ ?>

</div>
           
                </div>

                                 
              </section>
            </div>
          </div>

        </div>

      </div>

    </div>
    <!-- /Main body -->

  </div>
  <!-- /Main -->

  <!-- Search Modal -->
  <div class="modal" id="searchModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-1 p-lg-3">
          <form>
            <div class="input-group input-group-lg input-group-search">
              <div class="input-group-prepend">
                <button class="btn text-secondary btn-icon btn-lg" type="button" data-dismiss="modal">
                  <i class="fa fa-chevron-left"></i>
                </button>
              </div>
              <input type="text" class="form-control form-control-lg border-0 mx-1 px-0 px-lg-3" placeholder="Search..." autocomplete="off" required autofocus>
              <div class="input-group-append">
                <button class="btn text-secondary btn-icon btn-lg" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Search Modal -->

  <!-- Main Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="plugins/feather-icons/feather.min.js"></script>
  <script src="js/script.min.js"></script>

  <!-- Plugins -->
  <script src="plugins/autosize/autosize.min.js"></script>
  <script>
    autosize(document.querySelectorAll('textarea.autosize'))
  </script>

  <script type="text/javascript">
   
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#results').html('<img src='+e.target.result+' width=100 height=100>');
          $('#passport').val(e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

      <script src="plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js"></script>
  <script>
    $(() => {
      // Run datatable
      var table = $('#example').DataTable({
        drawCallback: function () {
          $('.dataTables_paginate > .pagination').addClass('pagination-sm') // make pagination small
        }
      })
      // Apply column filter
      $('#example .dt-column-filter th').each(function (i) {
        $('input', this).on('keyup change', function () {
          if (table.column(i).search() !== this.value) {
            table
            .column(i)
            .search(this.value)
            .draw()
          }
        })
      })
      // Toggle Column filter function
      var responsiveFilter = function (table, index, val) {
        var th = $(table).find('.dt-column-filter th').eq(index)
        val === true ? th.removeClass('d-none') : th.addClass('d-none')
      }
      // Run Toggle Column filter at first
      $.each(table.columns().responsiveHidden(), function (index, val) {
        responsiveFilter('#example', index, val)
      })
      // Run Toggle Column filter on responsive-resize event
      table.on('responsive-resize', function (e, datatable, columns) {
        $.each(columns, function (index, val) {
          responsiveFilter('#example', index, val)
        })
      })
    })
  </script>

    <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    $(() => {
      $('.summernote').summernote()

      $('.summernote-air').summernote({
        airMode: true
      })
    })
  </script>


</body>

</html><?php } ?>