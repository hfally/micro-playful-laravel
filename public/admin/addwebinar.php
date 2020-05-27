<?php
$_GET['mainmenu']='systemsetup';
$_GET['submenu']='adminuser';
include("header.inc.php"); 
$edit=mysqli_real_escape_string($conn,$_GET['edit']);



if(isset($_POST['reopen']) && $_POST['reopen']=="reopen"){

  mysqli_query($conn,"update oc_webinar set ocw_status='Open' where  ocw_id='$edit' ");


      $msg="Webinar Open Successfully";

       echo '<script>window.opener.location.reload()</script>'; 
 echo "<script>setTimeout('self.close()',2000);</script>";


}

if(isset($_POST['closeweb']) && $_POST['closeweb']=="closeweb"){


  mysqli_query($conn,"update oc_webinar set ocw_status='Closed' where  ocw_id='$edit' ");


      $msg="Webinar Closed Successfully";

       echo '<script>window.opener.location.reload()</script>'; 
 echo "<script>setTimeout('self.close()',2000);</script>";

}

if(isset($_POST['savechange']) && $_POST['savechange']=="savechange"){
$ttitle=mysqli_real_escape_string($conn,$_POST['ttitle']);
$spelized=mysqli_real_escape_string($conn,$_POST['spelized']);
$webdate=mysqli_real_escape_string($conn,$_POST['webdate']);
$rregister=mysqli_real_escape_string($conn,$_POST['rregister']);
$weblink=mysqli_real_escape_string($conn,$_POST['weblink']);
$sspeaker=mysqli_real_escape_string($conn,$_POST['sspeaker']);
$profilexpereicne=mysqli_real_escape_string($conn,$_POST['profilexpereicne']);
$wtime=mysqli_real_escape_string($conn,$_POST['wtime']);
$passport=mysqli_real_escape_string($conn,$_POST['passport']);
$sspeaker=mysqli_real_escape_string($conn,$_POST['sspeaker']);

if($ttitle==""){$error1="Cannot be empty";}
elseif($spelized==""){$error2="Cannot be empty";}
elseif($webdate==""){$error3="Cannot be empty";}
elseif($rregister==""){$error4="Select an option";}
elseif($weblink==""){$error5="Provide Link";}
elseif($profilexpereicne==""){$error6="Provide Webinar Brief";}
elseif($wtime==""){$error7="Provide Time";}
elseif($sspeaker==""){$error8="Select Speaker";}
elseif($ttitle!="" || $ $spelized!="" || $webdate!="" || $rregister!=""  || $profilexpereicne!="" || $weblink!="" || $wtime!="" || $sspeaker!=""){


if($passport==""){
$sql_speakder="update oc_webinar set ocw_title='$ttitle',ocw_category='$spelized',ocw_date='$webdate',ocw_register='$rregister',ocw_link='$weblink',ocw_brief='$profilexpereicne',ocw_time='$wtime',ocw_speaker='$sspeaker' where  ocw_id='$edit'";
$result_insert=mysqli_query($conn,$sql_speakder);

} elseif($passport!=""){


 $uploaddir = base_dir('admin/banner/');
$uploadfile = $uploaddir . basename($_FILES['image_file']['name']);
if ($_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
 $new_file_name = strtolower($file_name);
   $new_file_name = str_replace(' ', '-', $new_file_name); 
   $new_file_name = substr($new_file_name, 0, -strlen($ext));
   $new_file_name .= $extension;
   $temp = explode(".",$_FILES["image_file"]["name"]);
  $new_file_name = rand(1,999999999) . '.' .end($temp);
  
  if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploaddir.$new_file_name)) {

    $sql_speakder="update oc_webinar set ocw_title='$ttitle',ocw_category='$spelized',ocw_date='$webdate',ocw_register='$rregister',ocw_link='$weblink',ocw_brief='$profilexpereicne',ocw_time='$wtime',ocw_image='$new_file_name',ocw_speaker='$sspeaker' where  ocw_id='$edit'";
$result_insert=mysqli_query($conn,$sql_speakder);



}}

}



mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','Webinar','Webinar Updated Successfully $accnumber','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Webinar Updated Successfully";

       echo '<script>window.opener.location.reload()</script>'; 
 echo "<script>setTimeout('self.close()',2000);</script>";

  
}
}

if(isset($_POST['submit']) && $_POST['submit']=="submit"){

$ttitle=mysqli_real_escape_string($conn,$_POST['ttitle']);
$spelized=mysqli_real_escape_string($conn,$_POST['spelized']);
$webdate=mysqli_real_escape_string($conn,$_POST['webdate']);
$rregister=mysqli_real_escape_string($conn,$_POST['rregister']);
$weblink=mysqli_real_escape_string($conn,$_POST['weblink']);
$sspeaker=mysqli_real_escape_string($conn,$_POST['sspeaker']);
$profilexpereicne=mysqli_real_escape_string($conn,$_POST['profilexpereicne']);
$wtime=mysqli_real_escape_string($conn,$_POST['wtime']);
$passport=mysqli_real_escape_string($conn,$_POST['passport']);
$sspeaker=mysqli_real_escape_string($conn,$_POST['sspeaker']);

if($ttitle==""){$error1="Cannot be empty";}
elseif($spelized==""){$error2="Cannot be empty";}
elseif($webdate==""){$error3="Cannot be empty";}
elseif($rregister==""){$error4="Select an option";}
elseif($weblink==""){$error5="Provide Link";}
elseif($profilexpereicne==""){$error6="Provide Webinar Brief";}
elseif($wtime==""){$error7="Provide Time";}
elseif($sspeaker==""){$error8="Select Speaker";}
elseif($ttitle!="" || $ $spelized!="" || $webdate!="" || $rregister!=""  || $profilexpereicne!="" || $weblink!="" || $wtime!="" || $sspeaker!=""){

$sql="select ocl from oc_log";
$result_count=mysqli_query($conn,$sql); 
$count_run=mysqli_num_rows($result_count)+1;
$date=date('Ydm');
$bookingid='WEB'.$date.$count_run;
mysqli_query($conn,"insert into oc_log(ocl_id,ocl_detail,ocl_date,ocl_by) values('$bookingid','New Webinar','$mydate','Admin')");

if($passport==""){
$sql_speakder="insert into oc_webinar(ocw_id,ocw_title,ocw_category,ocw_date,ocw_register,ocw_link,ocw_brief,ocw_rdate,ocw_status,ocw_image,ocw_time,ocw_speaker) values('$bookingid','$ttitle','$spelized','$webdate','$rregister','$weblink','$profilexpereicne','$mydate','Open','','$wtime','$sspeaker')";
$result_insert=mysqli_query($conn,$sql_speakder);

} elseif($passport!=""){


 $uploaddir = 'banner/'; 
$uploadfile = $uploaddir . basename($_FILES['image_file']['name']);
if ($_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
 $new_file_name = strtolower($file_name);
   $new_file_name = str_replace(' ', '-', $new_file_name); 
   $new_file_name = substr($new_file_name, 0, -strlen($ext));
   $new_file_name .= $extension;
   $temp = explode(".",$_FILES["image_file"]["name"]);
  $new_file_name = rand(1,999999999) . '.' .end($temp);
  
  if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploaddir.$new_file_name)) {


$sql_speakder="insert into oc_webinar(ocw_id,ocw_title,ocw_category,ocw_date,ocw_register,ocw_link,ocw_brief,ocw_rdate,ocw_status,ocw_image,ocw_time,ocw_speaker) values('$bookingid','$ttitle','$spelized','$webdate','$rregister','$weblink','$profilexpereicne','$mydate','Open','$new_file_name','$wtime','$sspeaker')";
$result_insert=mysqli_query($conn,$sql_speakder);



}}

}



mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','New Webinar','Webinar Added Successfully $accnumber','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Webinar Added Successfully";

       echo '<script>window.opener.location.reload()</script>'; 
 echo "<script>setTimeout('self.close()',2000);</script>";

  
}
}
if($delete!=""){
mysqli_query($conn,"delete from oc_comm_setup where ocs='$delete'");

mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myaccess']."','".$_SESSION['myaccess']."','Commission Profile Deleted','Commission Profile Delete ID: $delete','$mydate','$mytime','$ip','$mycountry','$user_browser')");


}




if($edit!=""){
$sql="select * from oc_webinar where ocw_id='$edit' ";
$result_get_speakers=mysqli_query($conn,$sql);
while($rows=mysqli_fetch_array($result_get_speakers)) {extract($rows);}

$_POST['ttitle']=$ocw_title;
$_POST['spelized']=$ocw_category;
$_POST['webdate']=$ocw_date;
$_POST['rregister']=$ocw_register;
$_POST['weblink']=$ocw_link;
$_POST['sspeaker']=$ocw_speaker;
$_POST['profilexpereicne']=$ocw_brief;
$_POST['wtime']=$ocw_time;



}


?>

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Webinar</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <section id="section1">
                <h5><?php if($edit==""){ ?> Add  New <?php } ?> <?php if($edit!=""){ ?> Edit <?php } ?> Webinar</h5>
               
                <div class="row">
                  <div class="col-sm-12 mb-12">
                                       <span style="color: blue;"><?php echo $msg; ?></span>   

              <form role="form"  action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
<div class="form-group">
                    <div class="col-sm-6 mb-3">
              <label>Title/Topic  <span style="color: red; font-weight: bolder;"><?php echo $error1; ?></span></label>
                      <input type="text" class="form-control" name="ttitle" value="<?php echo $_POST['ttitle']; ?>">                                
                                       </div>   </div>

                                                                              <div class="form-group">
<div class="col-sm-6 mb-3">
<label>Category  <span style="color: red; font-weight: bolder;"><?php echo $error2; ?></span></label>
  <select type="text" class="country form-control select2" name="spelized">
    
    <option value="">Select</option>

<?php $sql="select * from wb_category";
$result_category=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_category)) {extract($rows); ?>
  <option value="<?php echo $wc_id; ?>"<?php if($_POST['spelized']==$wc_id){ ?> selected <?php } ?>><?php echo $wc_category; ?></option>

<?php } ?>

  </select></div>   </div>
<div class="form-group">
                    <div class="col-sm-6 mb-3">
              <label>Date  <span style="color: red; font-weight: bolder;"><?php echo $error3; ?></span></label>

<input  name="webdate" type="text" class="form-control datepicker" placeholder="Choose date" value="<?php echo $_POST['webdate']; ?>">
                                
                                       </div>   </div>
                                       <div class="form-group">

                                          <div class="col-sm-6 mb-3">
              <label>Time  <span style="color: red; font-weight: bolder;"><?php echo $error7; ?></span></label>
                      <input type="time" class="form-control" name="wtime" value="<?php echo $_POST['wtime']; ?>">                                
                                       </div>   </div>


                                       <div class="form-group">
                    <div class="col-sm-6 mb-3">
              <label>Registration to access Webinar <span style="color: red; font-weight: bolder;"><?php echo $error4; ?></span></label>
<p>
                      <label>
                        <input type="radio" name="rregister" value="Yes"<?php if($_POST['rregister']=="Yes"){ ?> checked <?php } ?> id="rregister_0">
                        Yes</label>
                      <label>
                        <input type="radio" name="rregister" value="No"<?php if($_POST['rregister']=="No"){ ?> checked <?php } ?> id="rregister_1">
                        No</label>
                      <br>
                  </p>                                       </div>   </div>


                                         <div class="form-group">
                    <div class="col-sm-6 mb-3">
              <label> Webinar Link <span style="color: red; font-weight: bolder;"><?php echo $error5; ?></span></label>
                      <input type="text" class="form-control" name="weblink" value="<?php echo $_POST['weblink']; ?>">                                
                                       </div>   </div>
<div class="form-group">
                    <div class="col-sm-6 mb-3">
              <label> Speaker <span style="color: red; font-weight: bolder;"><?php echo $error8; ?></span></label>
<select  class="form-control bs-select" name="sspeaker">
    
    <option value="">Select</option>

<?php $sql="select ocs_id,ocs_fullname from oc_speaer";
$result_category=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_category)) {extract($rows); ?>
  <option value="<?php echo $ocs_id; ?>"<?php if($_POST['sspeaker']==$wc_id){ ?> selected <?php } ?>><?php echo $ocs_fullname; ?></option>

<?php } ?>

  </select>                                       </div>   </div>

                                     



<div class="form-group">
                    <div class="col-sm-7 mb-3">
              <label>Brief    <span style="color: red; font-weight: bolder;"><?php echo $error6; ?></span></label>
                        <textarea class="form-control summernote" name="profilexpereicne"><?php echo $_POST['profilexpereicne']; ?></textarea>
                                       </div>   </div>


                                                                              <div class="form-group">
<div class="col-sm-6 mb-3">
<label>Image</label>
<?php if($ocw_image!=""){ ?><img src="banner/<?php echo $ocw_image; ?>" style="width:150px; height:80px;" /><?php } ?>

<a data-toggle='modal' href='#picture'><span id="results"><?php if(!empty($_POST['passport'])){echo '<img src="'.$_POST['passport'].'" width="114" height="127"/>'; }else{?><img src="faded_nopic.png" width="150" height="80"><?php }?></span></a> 
          
                                                <input type="hidden" name="passport" id="passport" value="<?php if(!empty($_POST['passport'])){echo $_POST['passport'];}?>" />

                   <input type="file" data-classbutton="btn btn-default" data-classinput="form-control inline" class="filestyle form-control input-circle" name="image_file" onchange="readURL(this);"  >  </div>   </div>



              <button type="submit" value="submit" name="submit" class="btn btn-primary">Save</button>
<?php if($edit!=""){ ?>
              <button type="submit" value="savechange" name="savechange" class="btn btn-info">Save Changes</button>
                       <?php if($ocw_status=="Open"){ ?>     <button type="submit" value="closeweb" name="closeweb" class="btn btn-danger">Close Web</button><?php } ?>

                                              <?php if($ocw_status=="Closed"){ ?>     <button type="submit" value="reopen" name="reopen" class="btn btn-success">Re-Open </button><?php } ?>


<?php } ?>

 </div>     </form></div>
                
           
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


   <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <script>
    $(() => {
      $('.bs-select').selectpicker({ style: 'btn' })
      $('.bs-select-sm').selectpicker({ style: 'btn btn-sm' })
      $('.bs-select-lg').selectpicker({ style: 'btn btn-lg' })
      $('.bootstrap-select').on('show.bs.select', function () {
        this.querySelector('.dropdown-toggle').classList.add('focus')
      }).on('hide.bs.select', function () {
        this.querySelector('.dropdown-toggle').classList.remove('focus')
      })
      $('.bs-select-creatable').selectpicker({
        style: 'btn',
        liveSearch: true,
        noneResultsText: 'Press Enter to add: <b>{0}</b>'
      })
      $('.bs-select-creatable .bs-searchbox .form-control').on('keyup', function (e) {
        const bs = this.closest('.bootstrap-select')
        if (bs.querySelector('.no-results')) {
          if (e.keyCode === 13) {
            let el = bs.querySelector('select')
            el.insertAdjacentHTML('afterbegin', `<option value="${$(this).val()}">${$(this).val()}</option>`)
            let newVal = $(el).val()
            Array.isArray(newVal) ? newVal.push(this.value) : newVal = this.value
            console.log(newVal)
            $(el).val(newVal)
            $(el).selectpicker('toggle')
            $(el).selectpicker('refresh')
            bs.querySelector('.dropdown-toggle').focus()
            this.value = ''
          }
        }
      })

      // Clearable
      function toggleClear(select, el) {
        el.style.display = select.value == '' ? 'none' : 'inline'
        if (select.value == '') {
          select.parentNode.querySelector('.filter-option').classList.remove('mr-4')
        } else {
          select.parentNode.querySelector('.filter-option').classList.add('mr-4')
        }
      }
      for (const el of document.querySelectorAll('select.bs-select, select.bs-select-sm, select.bs-select-lg')) {
        const clearEl = el.parentNode.nextElementSibling
        if (clearEl && clearEl.classList.contains('bs-select-clear')) {
          toggleClear(el, clearEl)
          el.addEventListener('change', function () {
            toggleClear(this, clearEl)
          })
        }
      }
      for (const el of document.querySelectorAll('.bs-select-clear')) {
        el.addEventListener('click', function () {
          const select = this.previousElementSibling.querySelector('select')
          $(select).selectpicker('val', '')
          select.dispatchEvent(new Event('change'))
        })
      }
    })
  </script>

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


    <script src="plugins/flatpickr/flatpickr.min.js"></script>
  <script src="plugins/flatpickr/plugins/monthSelect/index.js"></script>
  <script src="plugins/clockpicker/bootstrap-clockpicker.min.js"></script>
  <script>
    $(() => {
      // Inline
      flatpickr('.datepicker-inline', {
        inline: true,
      })

      // Basic
      flatpickr('.datepicker')

      // Datetime
      flatpickr('.datetimepicker', {
        enableTime: true
      })

      // Allow Input
      flatpickr('.datepicker-input', {
        allowInput: true
      })

      // External elements
      flatpickr('.datepicker-wrap', {
        allowInput: true,
        clickOpens: false,
        wrap: true,
      })

      // Date Range
      flatpickr('.daterangepicker', {
        mode: 'range'
      })
      flatpickr('.daterangepicker-wrap', {
        allowInput: true,
        clickOpens: false,
        wrap: true,
        mode: 'range'
      })

      // Multiple Dates
      flatpickr('.datepicker-multiple', {
        mode: 'multiple'
      })
      flatpickr('.datepicker-multiple-wrap', {
        allowInput: true,
        clickOpens: false,
        wrap: true,
        mode: 'multiple'
      })

      // Month Picker
      flatpickr('.monthpicker', {
        plugins: [
          new monthSelectPlugin({
            shorthand: true,
            dateFormat: 'Y-m',
            altFormat: 'Y-m',
          })
        ]
      })
      flatpickr('.monthpicker-wrap', {
        allowInput: true,
        clickOpens: false,
        wrap: true,
        plugins: [
          new monthSelectPlugin({
            shorthand: true,
            dateFormat: 'Y-m',
            altFormat: 'Y-m',
          })
        ]
      })

      // Time Picker
      flatpickr('.timepicker', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        minuteIncrement: 1,
      })
      flatpickr('.timepicker-wrap', {
        allowInput: true,
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        minuteIncrement: 1,
        clickOpens: false,
        wrap: true,
      })

      // Clock Picker
      $('.clockpicker').clockpicker({ autoclose: true })
    })
  </script>


</body>

</html>