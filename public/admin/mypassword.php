<?php
$_GET['mainmenu']='systemsetup';
$_GET['submenu']='adminuser';


 include("header.inc.php"); 

$edit=mysqli_real_escape_string($conn,$_GET['edit']);




if(isset($_POST['submit']) && $_POST['submit']=="submit"){
$npswd=mysqli_real_escape_string($conn,$_POST['npswd']);
$conpswd=mysqli_real_escape_string($conn,$_POST['conpswd']);


$site_salt="subinsblogsalt";
$mypassword=hash('sha256', $npswd.$site_salt.$p_salt);

if($npswd==""){$error1="Cannot be empty";}
elseif($conpswd==""){$error2="Cannot be empty";}
elseif($npswd!="" || $conpswd!=""){

if($npswd!=$conpswd){$error2="Password does not match";}
elseif($npswd==$conpswd){

mysqli_query($conn,"update wb_admin set wa_psd='$mypassword' where  wa_email='".$_SESSION['myvendor']."' and wa_session='$mysession'");
$msg="Password Change Successfully";

 echo "<script>setTimeout(function () {
   window.location.href='dashboard';},3000);</script>";


}

}

}

?>

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Change Password</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <section id="section1">
                <h5>Change Password</h5>
               
                <div class="row">
                  <div class="col-sm-5 mb-3">
              <form role="form"  action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
                   <span style="color: blue;"><?php echo $msg; ?></span>   
                    <div class="list-with-gap">
                      <label>New Password   <span style="color: red; font-weight: bolder;"><?php echo $error1; ?></span></label>
                      <input type="password" class="form-control"  name="npswd" >
                    
                    <label>Confirm New  Password <span style="color: red; font-weight: bolder;"><?php echo $error2; ?></span></label>

                      <input type="password" class="form-control" name="conpswd">
                                           

</div>
<p></p>
<hr>

              <button type="submit" value="submit" name="submit" class="btn btn-primary btn-block">Change Password</button>
 </div>     </form>
                
           
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