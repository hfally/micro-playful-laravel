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
         <form role="form" method="post"enctype="multipart/form-data" action="<?php mysqli_real_escape_string($conn,$_SERVER["PHP_SELF"]);?>" name="form1" id="form1">       <h5><a href="addwebinar" class="btn btn-primary" onClick="return popup(this, 'stevie')"><i class="fa fa-plus"></i> New Webinar</a>   <input type="submit" name="Download" value="Download to Excel" class="btn btn-success"></h5> 
                                      
 </form>

               
                <div class="row">
                
                 <div class="col-sm-12 mb-3"><?php } ?>
                            <table <?php if(!isset($_POST['Download'])){ ?>
 id="example" <?php } ?> class="table table-striped table-bordered table-sm dt-responsive nowrap w-100">

                                    <thead>
            
              <tr>
                <th>S/N</th>
                <th>Webinar ID</th>
                <th>Title</th>
                <th>Category</th>
                                                <th>Webinar Date</th>

                                              
                                                <th>Speaker</th>
                                                  <th>Views</th>
                                                <th>Registers</th>

             
                <th>Status</th>

               
              
                <th></th>
              </tr>
            </thead>
            <!-- /Filter columns -->

            <tbody>
          <?php $sql="select * from oc_webinar  ORDER BY ocw DESC"; 
          $result_oc_admin=mysqli_query($conn,$sql); 
          while($rows=mysqli_fetch_array($result_oc_admin)) {extract($rows); ?>      <tr>
                  <td><?php echo $abc+=1; ?></td>
                  <td><?php echo $ocw_id; ?></td>
                  <td><?php echo $ocw_title; ?></td>
                                                      <td><?php  $sql="select wc_category from wb_category where wc_id='$ocw_category'";
$result_category=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_category)) {extract($rows); 

  echo $wc_category; } ?></td>
                                                      <td><?php echo $ocw_date; ?> <?php echo $ocw_time ?></td>
<td><?php $sql="select ocs_fullname from oc_speaer where ocs_id='$ocw_speaker'"; $result_speaker=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_speaker)) {extract($rows); echo $ocs_fullname; } ?></td>

<td><?php $sql="select wwct from web_webinar_count where wwct_wid='$ocw_id'";
$result_count_views=mysqli_query($conn,$sql); 
echo $count_views=mysqli_num_rows($result_count_views); ?></td>
                                                      <td><?php $sql="select wwr from wb_webinar_register where   wwr_webinar='$ocw_id'";
$result_count_register=mysqli_query($conn,$sql); 
echo $count_registered=mysqli_num_rows($result_count_register); ?></td>


                 
                                    <td><?php if($ocw_status=="Open"){ ?><span class="badge badge-success ml-auto badge-pill"><?php echo $ocw_status; ?></span><?php } ?> <?php if($ocw_status=="Closed"){ ?><span class="badge badge-danger ml-auto badge-pill"><?php echo $ocw_status; ?></span><?php } ?></td>
            

                 
                  <td><a href="addwebinar?edit=<?php echo $ocw_id; ?>" class="btn btn-icon rounded-circle btn btn-primary" onClick="return popup(this, 'stevie')"><i class="fa fa-pencil-alt"></i></a></a></td>
                
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