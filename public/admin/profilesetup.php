<?php
$_GET['mainmenu']='profilesetup';
$_GET['submenu']='profilesetup';


 include("header.inc.php"); 

if(isset($_POST['submit']) && $_POST['submit']=="submit"){
$disname=mysqli_real_escape_string($conn,$_POST['disname']);
$pagetitle=mysqli_real_escape_string($conn,$_POST['pagetitle']);
$foottitle=mysqli_real_escape_string($conn,$_POST['foottitle']);
$contactphone1=mysqli_real_escape_string($conn,$_POST['contactphone1']);
$contectphone2=mysqli_real_escape_string($conn,$_POST['contectphone2']);
$contactemail=mysqli_real_escape_string($conn,$_POST['contactemail']);
$contactaddress=mysqli_real_escape_string($conn,$_POST['contactaddress']);
$cslogan=mysqli_real_escape_string($conn,$_POST['cslogan']);
$fbpage=mysqli_real_escape_string($conn,$_POST['fbpage']);
$twpage=mysqli_real_escape_string($conn,$_POST['twpage']);
$igpage=mysqli_real_escape_string($conn,$_POST['igpage']);
$passport = mysqli_real_escape_string($conn,base64_decode(substr($_POST['passport'], strpos($_POST['passport'], ",")+1)));

if($disname==""){$error1="Cannot be empty";}
elseif($pagetitle==""){$error2="Cannot be empty";}
elseif($foottitle==""){$error3="Cannot be empty"; }
elseif($contactphone1==""){$error4="Cannot be empty";}
elseif($contactemail==""){$error5="Cannot be empty";}
elseif($disname!="" || $pagetitle!="" || $foottitle!="" || $contactphone1!="" || $contactemail!=""){

$sql="select * from oc_profile ";
$result_check_oc=mysqli_query($conn,$sql); 
if(mysqli_num_rows($result_check_oc)<1){
if($passport!=""){


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
    
$sql_2="insert into oc_profile(cp_dpname,cp_ptitle,cp_ftitle,cp_tel,cp_phone,cp_addres,cp_email,cp_fb,cp_tw,cp_ig,cp_logo,cp_logo) values('$disname','$pagetitle','$foottitle','$contactphone1','$contectphone2','$contactaddress','$contactemail','$fbpage','$twpage','$igpage','$new_file_name','$cslogan')";
    $result_inset=mysqli_query($conn,$sql_2);
    
    
mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Create New Profile','New Company profile Setup','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Profile Created Successfully";
  }}

}elseif($passport==""){

$sql_2="insert into oc_profile(cp_dpname,cp_ptitle,cp_ftitle,cp_tel,cp_phone,cp_addres,cp_email,cp_fb,cp_tw,cp_ig,cp_logo,cp_slogan) values('$disname','$pagetitle','$foottitle','$contactphone1','$contectphone2','$contactaddress','$contactemail','$fbpage','$twpage','$igpage','','$cslogan')";
    $result_inset=mysqli_query($conn,$sql_2);
    
    
mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Create New Profile','New Company profile Setup','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Profile Created Successfully";

}





}elseif(mysqli_num_rows($result_check_oc)>0){

if($passport!=""){


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
    
$sql_2="update  oc_profile set cp_dpname='$disname',cp_ptitle='$pagetitle',cp_ftitle='$foottitle',cp_tel='$contactphone1',cp_phone='$contectphone2',cp_addres='$contactaddress',cp_email='$contactemail',cp_fb='$fbpage',cp_tw='$twpage',cp_ig='$igpage',cp_logo='$new_file_name',cp_slogan='$cslogan'";
    $result_inset=mysqli_query($conn,$sql_2);
    
    
mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Company Profile Updated','Company profile information was updated','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
  
      $msg="Profile Updated Successfully";
  }}



}elseif($passport==""){
$sql_2="update  oc_profile set cp_dpname='$disname',cp_ptitle='$pagetitle',cp_ftitle='$foottitle',cp_tel='$contactphone1',cp_phone='$contectphone2',cp_addres='$contactaddress',cp_email='$contactemail',cp_fb='$fbpage',cp_tw='$twpage',cp_ig='$igpage',cp_slogan='$cslogan'";
    $result_inset=mysqli_query($conn,$sql_2);
    
    
mysqli_query($conn,"insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','".$_SESSION['myvendor']."','".$_SESSION['myvendor']."','Company Profile Updated','Company profile information was updated','$mydate','$mytime','$ip','$mycountry','$user_browser')");
  
        $msg="Profile Updated Successfully";

}
}}}


$sql="select * from oc_profile";
$result_oc_profile=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_oc_profile)) {extract($rows); }
$_POST['disname']=$cp_dpname;
$_POST['pagetitle']=$cp_ptitle;
$_POST['foottitle']=$cp_ftitle;
$_POST['contactphone1']=$cp_tel;
$_POST['contectphone2']=$cp_phone;
$_POST['contactemail']=$cp_email;
$_POST['contactaddress']=$cp_addres;
$_POST['cslogan']=$cp_slogan;
$_POST['fbpage']=$cp_fb;
$_POST['twpage']=$cp_tw;
$_POST['igpage']=$cp_ig;

?>

    <!-- Main body -->
    <div class="main-body">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile Setup</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row">
        <div class="col">

          <div class="card">
            <div class="card-body">
              <section id="section1">
                <h5>Profile Setup</h5>
               
                <div class="row">
                  <div class="col-sm-6 mb-3">
              <form role="form"  action="<?php mysqli_real_escape_string($conn,($_SERVER["PHP_SELF"]));?>" method="post" enctype="multipart/form-data" >
                   <span style="color: blue;"><?php echo $msg; ?></span>   
                    <div class="list-with-gap">
                      <label>Display Name   <span style="color: red; font-weight: bolder;"><?php echo $error1; ?></span></label>
                      <input type="text" class="form-control"  name="disname" value="<?php echo $_POST['disname']; ?>">
                    
                    <label>Page Title  <span style="color: red; font-weight: bolder;"><?php echo $error2; ?></span></label>

                      <input type="text" class="form-control" name="pagetitle" value="<?php echo $_POST['pagetitle']; ?>">
                                           

                        <label>Footer Title   <span style="color: red; font-weight: bolder;"><?php echo $error3; ?></span></label>

                      <input type="text" class="form-control" name="foottitle" value="<?php echo $_POST['foottitle']; ?>">
                                          

                       <label>Contact Telephone 1  <span style="color: red; font-weight: bolder;"><?php echo $error4; ?></span></label>

                      <input type="text" class="form-control" name="contactphone1" value="<?php echo $_POST['contactphone1']; ?>">
                                           

                   <label>Contact Telephone 2</label>

                      <input type="text" class="form-control" name="contectphone2" value="<?php echo $_POST['contectphone2']; ?>">
                         <label>Contact Email   <span style="color: red; font-weight: bolder;"><?php echo $error5; ?></span> </label>

                      <input type="text" class="form-control" name="contactemail"  value="<?php echo $_POST['contactemail']; ?>">
                                          

                         <label>Contact Address </label>

                      <textarea class="form-control" name="contactaddress"><?php echo $_POST['contactaddress']; ?></textarea>
                      <label>Meta Tag </label>

                      <textarea type="text" class="form-control" name="cslogan"><?php echo $_POST['cslogan']; ?></textarea>
                      <label>Facebook Page </label>

                      <input type="text" class="form-control" name="fbpage" value="<?php echo $_POST['fbpage']; ?>">
                      <label>Twitter </label>

                      <input type="text" class="form-control" name="twpage" value="<?php echo $_POST['twpage']; ?>">
                      <label>Instagram </label>

                      <input type="text" class="form-control" name="igpage" value="<?php echo $_POST['igpage']; ?>">
                         <label>Logo </label>
  <?php if($cp_logo!=""){ ?>
<img src="banner/<?php echo $cp_logo; ?>" style="width:114px; height:127px;" /><?php } ?>

<a data-toggle='modal' href='#picture'><span id="results"><?php if(!empty($_POST['passport'])){echo '<img src="'.$_POST['passport'].'" width="114" height="127"/>'; }else{?><img src="faded_nopic.png" width="114" height="127"><?php }?></span></a> 
          
                                                <input type="hidden" name="passport" id="passport" value="<?php if(!empty($_POST['passport'])){echo $_POST['passport'];}?>" />

                   <input type="file" data-classbutton="btn btn-default" data-classinput="form-control inline" class="filestyle form-control input-circle" name="image_file" onchange="readURL(this);"  >   
              <button type="submit" value="submit" name="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                  </div>
                </form>
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

</body>

</html>