<?php
$_GET['mainmenu']='systemsetup';
$_GET['submenu']='adminuser';
include("header.inc.php"); 
$edit=mysqli_real_escape_string($conn,$_GET['edit']);
$delete=mysqli_real_escape_string($conn,$_GET['delete']);

if(isset($_POST['savechange']) && $_POST['savechange']=="savechange"){
$ccategory=mysqli_real_escape_string($conn,$_POST['ccategory']);


if($ccategory==""){$error1="Cannot be empty";}

elseif($ccategory!=""){

    $sql="select wc_category from wb_category where wc_category='$ccategory'";
    $result_check_services=mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result_check_services)>0){$error1="Cateory already exist";}else{





  mysqli_query($conn,"update wb_category set wc_category='$ccategory' where wc='$edit'");
mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','Category Updated','Category Updated $ccategory','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Category Updated Successfully";
  }}
}

if(isset($_POST['submit']) && $_POST['submit']=="submit"){
$ccategory=mysqli_real_escape_string($conn,$_POST['ccategory']);


if($ccategory==""){$error1="Cannot be empty";}

elseif($ccategory!=""){

    $sql="select wc_category from wb_category where wc_category='$ccategory'";
    $result_check_services=mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result_check_services)>0){$error1="Cateory already exist";}else{



$sql="select ocl from oc_log";
$result_count=mysqli_query($conn,$sql); 
$count_run=mysqli_num_rows($result_count)+1;
$date=date('ymd');
$bookingid=$date.$count_run;
mysqli_query($conn,"insert into oc_log(ocl_id,ocl_detail,ocl_date,ocl_by) values('$bookingid','Category','$mydate','Admin')");



  mysqli_query($conn,"insert into wb_category(wc_id,wc_category,wc_status) values('$bookingid','$ccategory','Active')");
mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','New Category Added','Category Added Successfully $accnumber','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Category Added Successfully";
  }
}}

if($delete!=""){
mysqli_query($conn,"delete from wb_category where wc='$delete'");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','Category Deleted','Category Deleted ID: $delete','$mydate','$mytime','$ip','$mycountry','$user_browser')");


}
if($edit!=""){

$sql="select * from wb_category where wc='$edit' ";
$result_octragon=mysqli_query($conn, $sql);
while($rows=mysqli_fetch_array($result_octragon)){extract($rows);}
$_POST['ccategory']=$wc_category;


}



?>

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <section id="section1">
                <h5><?php if($edit==""){ ?>Add New<?php } ?> <?php if($edit!=""){ ?> Edit <?php  } ?> Categories</h5>
               
                <div class="row">
                  <div class="col-sm-6 mb-3">
                                       <span style="color: blue;"><?php echo $msg; ?></span>   

              <form role="form"  action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
                    <div class="list-with-gap">
       <div class="col-sm-12">           
<div class="form-group">
              <label>Category  <span style="color: red; font-weight: bolder;"><?php echo $error1; ?></span></label>

                      <input type="text" class="form-control" name="ccategory" value="<?php echo $_POST['ccategory']; ?>">                                

                                       </div>   </div>
              <button type="submit" value="submit" name="submit" class="btn btn-primary">Save</button>
<?php if($edit!=""){ ?>
              <button type="submit" value="savechange" name="savechange" class="btn btn-danger">Save Changes</button>
<?php } ?>

 </div>     </form></div>
                 <div class="col-sm-6 mb-3">
                  <h4>Manage Categories</h4>
                            <table id="example" class="table table-striped table-bordered table-sm dt-responsive nowrap w-100">

                                    <thead>
            
              <tr>
                <th>S/N</th>
                <th>Categories</th>
                <th>Number of Webinars</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <!-- /Filter columns -->

            <tbody>
          <?php $sql="select * from wb_category"; 
          $result_oc_admin=mysqli_query($conn,$sql); 
          while($rows=mysqli_fetch_array($result_oc_admin)) {extract($rows); ?>      <tr>
                  <td><?php echo $ab+=1; ?></td>
                  <td><?php echo $wc_category; ?></td>
                  <td><?php $sql="select  ocw from oc_webinar where    ocw_category='$wc_id'";
                  $result_count_category=mysqli_query($conn,$sql); 
                 echo  $count_category=mysqli_num_rows($result_count_category); ?></td>

                                    <td><?php if($wc_status=="Active"){ ?><span class="badge badge-success ml-auto badge-pill"><?php echo $wc_status; ?></span><?php } ?> <?php if($wc_status=="Inactive"){ ?><span class="badge badge-danger ml-auto badge-pill"><?php echo $wc_status; ?></span><?php } ?></td>

                 
                  <td><a href="?edit=<?php echo $wc; ?>" class="btn btn-icon rounded-circle btn-primary"><i class="fa fa-pencil-alt"></i></a> <a href="?delete=<?php echo $wc; ?>" class="btn btn-icon rounded-circle btn-danger"><i class="material-icons">delete_outline</i></a></td>
                
                </tr><?php  } ?>


              </tbody></table>

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


</body>

</html>