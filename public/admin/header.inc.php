<?php include("mfile.php");

$mydate=date('Y-m-d');


?>

 <?php if(!isset($_POST['Download'])){ ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="msapplication-tap-highlight" content="no"/>
  <!-- Font & Icon -->
  <link rel="stylesheet" href="font/inter/inter.min.css">
  <link href="plugins/material-design-icons-iconfont/material-design-icons.min.css" rel="stylesheet">
  <link href="plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Plugins -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables/responsive.bootstrap4.min.css">


  <link rel="stylesheet" href="plugins/bootstrap-select/bootstrap-select.min.css">

  <link rel="stylesheet" href="plugins/flatpickr/flatpickr.min.css">
  <link rel="stylesheet" href="plugins/flatpickr/plugins/monthSelect/style.css">
  <link rel="stylesheet" href="plugins/clockpicker/bootstrap-clockpicker.min.css">
  <!-- Main Style -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">

      <link rel="stylesheet" href="plugins/bootstrap-select/bootstrap-select.min.css">


  <!-- CSS plugins goes here -->
  <!-- Main Style -->
  <link rel="stylesheet" href="plugins/perfect-scrollbar/perfect-scrollbar.min.css">
  <link rel="stylesheet" href="css/style.min.css" id="main-css">
  <link rel="stylesheet" href="css/sidebar-gray.min.css" id="theme-css"> <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
  <title><?php echo $cp_ptitle; ?></title>
</head>
<script type="text/javascript">
 
        function isNumberKey(evt, obj) {
 
            var charCode = (evt.which) ? evt.which : event.keyCode
            var value = obj.value;
            var dotcontains = value.indexOf(".") != -1;
            if (dotcontains)
                if (charCode == 46) return false;
            if (charCode == 46) return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
 

 
    </script>

  <SCRIPT TYPE="text/javascript">
  function popup(mylink, windowname) { 
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string') href=mylink;
    else href=mylink.href; 
    window.open(href, windowname, 'width=1000,height=800,scrollbars=yes'); 
    return false; 
  }
</SCRIPT>


<style>
div.ex1 {
  height: 500px;
  overflow: scroll;
}
</style>

<body>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar header -->
    <div class="sidebar-header" style="background-color: #FFF;">
      <a href="dashboard">
        <img src="banner/<?php echo $cp_logo; ?>" alt="LawPavilion" style="width:160px; ">
      </a>
      <a href="#" class="nav-link nav-icon rounded-circle ml-auto" data-toggle="sidebar">
        <i class="material-icons">close</i>
      </a>
    </div>
    <!-- /Sidebar header -->

    <!-- Sidebar body -->
    <div class="sidebar-body">
      <ul class="nav nav-sub">
        <li class="nav-label">DASHBOARD</li>
      <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="dashboard"){ ?> active <?php  } ?>" href="dashboard"><i data-feather="globe"></i>Dashboard</a>
        </li>

          <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="profilesetup"){ ?> active <?php  } ?>"  href="profilesetup">   <i class="nav-icon fas fa-th"></i> Profile</a>
        </li>
      
       
             
        <li class="nav-item">
          <a class="nav-link has-icon  <?php if($_GET['mainmenu']=="newupload"){ ?> active <?php  } ?>" href="users">   <i class="nav-icon fas fa-th"></i> Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="products"){ ?> active <?php  } ?>"  href="categories">   <i class="nav-icon fas fa-th"></i> Categories</a>
        </li>
         <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="products"){ ?> active <?php  } ?>"  href="speakers">   <i class="nav-icon fas fa-th"></i> Speakers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="products"){ ?> active <?php  } ?>"  href="managewebinar">   <i class="nav-icon fas fa-th"></i> Webinar</a>
        </li>
      
      
        <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="products"){ ?> active <?php  } ?>"  href="registrations">   <i class="nav-icon fas fa-th"></i> Registrations</a>
        </li>

      
             <li class="nav-item">
          <a class="nav-link has-icon <?php if($_GET['mainmenu']=="products"){ ?> active <?php  } ?>"  href="contactus">   <i class="nav-icon fas fa-th"></i> Contact Us</a>
        </li>

       
       
     




       
       
        <li class="nav-item">
          <a class="nav-link has-icon" href="logout"><i class="material-icons">exit_to_app</i>Log Out</a>
        </li>
      </ul>
    </div>
    <!-- /Sidebar body -->

  </div>
  <!-- /Sidebar -->

  <!-- Main -->
  <div class="main">

    <!-- Main header -->
    <div class="main-header">
      <a class="nav-link nav-link-faded rounded-circle nav-icon" href="#" data-toggle="sidebar"><i class="material-icons">menu</i></a>
     
      <ul class="nav nav-circle ml-auto">
        
        <li class="nav-item d-none d-sm-block"><a class="nav-link nav-link-faded nav-icon" href="" id="refreshPage"><i class="material-icons">refresh</i></a></li>
      
        <li class="nav-item dropdown ml-2">
          <a class="nav-link nav-link-faded rounded nav-link-img dropdown-toggle px-2" href="#" data-toggle="dropdown" data-display="static">
       <img src="img/user.svg" alt="LawPavilion" class="rounded-circle mr-2">


            <span class="d-none d-sm-block"><?php echo $_SESSION['myname']; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right pt-0 overflow-hidden">
            <div class="media align-items-center bg-warning text-white px-4 py-3 mb-2">
              <img src="img/user.svg" alt="Octramarket" class="rounded-circle" width="50" height="50">

              <div class="media-body ml-2 text-nowrap">
                <h6 class="mb-0"><?php echo $_SESSION['myname']; ?></h6>
              </div>
            </div>

                        <a class="dropdown-item has-icon" href="mypassword"><i class="mr-2" data-feather="lock"></i>Change Password</a>




            <a class="dropdown-item has-icon text-danger" href="logout"><i class="mr-2" data-feather="log-out"></i>Sign out</a>
          </div>
        </li>
      </ul>
    </div>
    <!-- /Main header --><?php } ?>