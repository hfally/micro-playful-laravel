<?php
$_GET['mainmenu']='systemsetup';
$_GET['submenu']='adminuser';
include("header.inc.php"); 
$edit=mysqli_real_escape_string($conn,$_GET['edit']);
$delete=mysqli_real_escape_string($conn,$_GET['delete']);
$activate=mysqli_real_escape_string($conn,$_GET['activate']);


if(isset($_POST['submit']) && $_POST['submit']=="submit"){

$fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
$eemail=mysqli_real_escape_string($conn,$_POST['eemail']);
$ttelephone=mysqli_real_escape_string($conn,$_POST['ttelephone']);
$ppswrd=mysqli_real_escape_string($conn,$_POST['ppswrd']);
$cpsd=mysqli_real_escape_string($conn,$_POST['cpsd']);


$site_salt="subinsblogsalt";
$mypassword=hash('sha256', $ppswrd.$site_salt.$p_salt);
$_SESSION['mypasskey']=$mypassword;
if($fullname==""){$error1="Provide  Name";}
elseif($eemail==""){$error2="Provide Email Address";}
  elseif($ttelephone=="") {$error3="Provide Telephone";}
elseif($ppswrd==""){$error4="Provide Password";}
elseif($cpsd==""){$error5="Confirm Password";}


elseif($fullname!="" || $eemail!="" || $ttelephone!="" || $ppswrd!="" || $cpsd!=""){

  if($ppswrd!=$cpsd){$error5="Password does not match";}else{

   $sql="select wa_email from wb_admin where wa_email='$eemail'";
   $result_check_email=mysqli_query($conn,$sql); 
   if(mysqli_num_rows($result_check_email)>0){$error2="Email already exist";}
   else{

    $sql="select wa_tel from  wb_admin where wa_tel='234".substr($ttelephone,1,10)."' ";
    $result_check_telephone=mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result_check_telephone)>0) {$error3="Telephone already exist";} else{

      mysqli_query($conn,"insert into wb_admin(wa_name,wa_email,wa_tel,wa_psd,wa_status,wa_session) values('$fullname','$eemail','234".substr($ttelephone,1,10)."','$mypassword','Active','')");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','New User Created','New User $eemail Created Successfully','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="User Added Successfully";
  }
}}}
}



if(isset($_POST['savechange']) && $_POST['savechange']=="savechange"){
$fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
$eemail=mysqli_real_escape_string($conn,$_POST['eemail']);
$ttelephone=mysqli_real_escape_string($conn,$_POST['ttelephone']);

if($fullname==""){$error1="Provide  Name";}
elseif($eemail==""){$error2="Provide Email Address";}
  elseif($ttelephone=="") {$error3="Provide Telephone";}
elseif($fullname!="" || $eemail!="" || $ttelephone!=""){
  mysqli_query($conn,"update wb_admin set wa_name='$fullname',wa_email='$eemail',wa_tel='$ttelephone' where wa='$edit'");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','Profile Updated','User Profile Updated $edit','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="User Profile Updated Successfully";
  }}

if($delete!=""){
mysqli_query($conn,"update  wb_admin set wa_status='Inactive' where wa='$delete'");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','User Profile Deactivated',' Profile Deactivated ID: $delete','$mydate','$mytime','$ip','$mycountry','$user_browser')");


}

if($activate!=""){
mysqli_query($conn,"update  wb_admin set wa_status='Active' where wa='$activate'");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','User Profile Activated',' Profile Activated ID: $delete','$mydate','$mytime','$ip','$mycountry','$user_browser')");


}
if($edit!=""){

$sql="select * from wb_admin where wa='$edit' ";
$result_octragon=mysqli_query($conn, $sql);
while($rows=mysqli_fetch_array($result_octragon)){extract($rows);}
$_POST['fullname']=$wa_name;
$_POST['eemail']=$wa_email;
$_POST['ttelephone']=$wa_tel;


}



?>

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <section id="section1">
                <h5><?php if($edit==""){ ?>Add New<?php } ?> <?php if($edit!=""){ ?> Edit <?php  } ?> User</h5>
               
                <div class="row">
                  <div class="col-sm-6 mb-6">
                                       <span style="color: blue;"><?php echo $msg; ?></span>   

              <form role="form"  action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
    <div class="form-group">
                    <div class="col-sm-12 mb-12">
              <label> Name  <span style="color: red; font-weight: bolder;"><?php echo $error1; ?></span></label>

<input  name="fullname" type="text" class="form-control" value="<?php echo $_POST['fullname']; ?>">
                                
                                       </div>   </div>

                                        <div class="form-group">
                    <div class="col-sm-12 mb-12">
              <label>Email Address  <span style="color: red; font-weight: bolder;"><?php echo $error2; ?></span></label>

<input  name="eemail" type="email" class="form-control" value="<?php echo $_POST['eemail']; ?>">
                                
                                       </div>   </div>

                                        <div class="form-group">
                    <div class="col-sm-12 mb-12">
              <label>Telephone  <span style="color: red; font-weight: bolder;"><?php echo $error3; ?></span></label>

<input  name="ttelephone" type="text" class="form-control" value="<?php echo $_POST['ttelephone']; ?>">
                                
                                       </div>   </div>


           <?php if($edit==""){ ?>                              <div class="form-group">
                    <div class="col-sm-12 mb-12">
              <label>Password  <span style="color: red; font-weight: bolder;"><?php echo $error4; ?></span></label>

<input  name="ppswrd" type="password" class="form-control" value="<?php echo $_POST['ppswrd']; ?>">
                                
                                       </div>   </div>

                                         <div class="form-group">
                    <div class="col-sm-12 mb-12">
              <label>Confirm Password  <span style="color: red; font-weight: bolder;"><?php echo $error5; ?></span></label>

<input  name="cpsd" type="password" class="form-control" value="<?php echo $_POST['cpsd']; ?>">
                                
                                       </div>   </div><?php  } ?>

                                         <div class="form-group">
                    <div class="col-sm-12 mb-12">
              <button type="submit" value="submit" name="submit" class="btn btn-primary">Add User</button>
<?php if($edit!=""){ ?>
              <button type="submit" value="savechange" name="savechange" class="btn btn-danger">Save Changes</button>
<?php } ?>

 </div>  </div>   </form></div>
                 <div class="col-sm-6 mb-3">
                  <h4>Manage Users</h4>
                            <table id="example" class="table table-striped table-bordered table-sm dt-responsive nowrap w-100">

                                    <thead>
            
              <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <!-- /Filter columns -->

            <tbody>
          <?php $sql="select * from wb_admin"; 
          $result_oc_admin=mysqli_query($conn,$sql); 
          while($rows=mysqli_fetch_array($result_oc_admin)) {extract($rows); ?>      <tr>
                  <td><?php echo $ab+=1; ?></td>
                  <td><?php echo $wa_name; ?></td>
                  <td><?php echo $wa_email; ?></td>
                  <td><?php echo $wa_tel; ?></td>

                                    <td><?php if($wa_status=="Active"){ ?><span class="badge badge-success ml-auto badge-pill"><?php echo $wa_status; ?></span><?php } ?> <?php if($wa_status=="Inactive"){ ?><span class="badge badge-danger ml-auto badge-pill"><?php echo $wa_status; ?></span><?php } ?></td>

                 
                  <td><a href="?edit=<?php echo $wa; ?>" class="btn btn-icon rounded-circle btn-primary"><i class="fa fa-pencil-alt"></i></a><?php if($wa_status=="Active"){ ?> <a href="?delete=<?php echo $wa; ?>" class="btn btn-icon rounded-circle btn-danger"><i class="material-icons">delete_outline</i></a><?php } ?> <?php if($wa_status=="Inactive"){ ?> <a href="?activate=<?php echo $wa; ?>" class="btn btn-icon rounded-circle btn-success"><i class="material-icons">refresh</i></a><?php } ?></td>
                
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