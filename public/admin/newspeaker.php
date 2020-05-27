<?php
$_GET['mainmenu'] = 'systemsetup';
$_GET['submenu'] = 'adminuser';
include("header.inc.php");
$edit = mysqli_real_escape_string($conn, $_GET['edit']);

if (isset($_POST['savechange']) && $_POST['savechange'] == "savechange") {
    $ffullname = mysqli_real_escape_string($conn, $_POST['ffullname']);
    $eemailad = mysqli_real_escape_string($conn, $_POST['eemailad']);
    $ttelephone = mysqli_real_escape_string($conn, $_POST['ttelephone']);
    $spelized = mysqli_real_escape_string($conn, $_POST['spelized']);
    $profilexpereicne = mysqli_real_escape_string($conn, $_POST['profilexpereicne']);

    $passport = mysqli_real_escape_string($conn, $_POST['passport']);

    if ($ffullname == "") {
        $error1 = "Cannot be empty";
    } elseif ($eemailad == "") {
        $error2 = "Cannot be empty";
    } elseif ($ttelephone == "") {
        $error3 = "Cannot be empty";
    } elseif ($spelized == "") {
        $error4 = "Select an option";
    } elseif ($ffullname != "" || $$eemailad != "" || $ttelephone != "" || $spelized != "") {


        if ($passport == "") {

            mysqli_query($conn, "update oc_speaer set ocs_fullname='$ffullname',ocs_email='$eemailad',ocs_telephone='$ttelephone',ocs_category='$spelized',ocs_profile='$profilexpereicne' where  ocs_id='$edit'");

        } elseif ($passport != "") {


            $uploaddir = base_dir('admin/banner/');
            $uploadfile = $uploaddir . basename($_FILES['image_file']['name']);
            if ($_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
                $new_file_name = strtolower($file_name);
                $new_file_name = str_replace(' ', '-', $new_file_name);
                $new_file_name = substr($new_file_name, 0, -strlen($ext));
                $new_file_name .= $extension;
                $temp = explode(".", $_FILES["image_file"]["name"]);
                $new_file_name = rand(1, 999999999) . '.' . end($temp);

                if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploaddir . $new_file_name)) {


                    mysqli_query($conn, "update oc_speaer set ocs_fullname='$ffullname',ocs_email='$eemailad',ocs_telephone='$ttelephone',ocs_category='$spelized',ocs_profile='$profilexpereicne',ocs_image='$new_file_name' where  ocs_id='$edit'");


                }
            }

        }
        mysqli_query($conn, "insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','" . $_SESSION['myaccess'] . "','" . $_SESSION['myaccess'] . "','Bank Account Setup','Speaker Profile Updated Successfully $accnumber','$mydate','$mytime','$ip','$mycountry','$user_browser')");


        $msg = "Speaker Profile Updated Successfully";

        echo '<script>window.opener.location.reload()</script>';
        echo "<script>setTimeout('self.close()',2000);</script>";


    }
}

if (isset($_POST['submit']) && $_POST['submit'] == "submit") {

    $ffullname = mysqli_real_escape_string($conn, $_POST['ffullname']);
    $eemailad = mysqli_real_escape_string($conn, $_POST['eemailad']);
    $ttelephone = mysqli_real_escape_string($conn, $_POST['ttelephone']);
    $spelized = mysqli_real_escape_string($conn, $_POST['spelized']);
    $profilexpereicne = mysqli_real_escape_string($conn, $_POST['profilexpereicne']);

    $passport = mysqli_real_escape_string($conn, $_POST['passport']);

    if ($ffullname == "") {
        $error1 = "Cannot be empty";
    } elseif ($eemailad == "") {
        $error2 = "Cannot be empty";
    } elseif ($ttelephone == "") {
        $error3 = "Cannot be empty";
    } elseif ($spelized == "") {
        $error4 = "Select an option";
    } elseif ($ffullname != "" || $$eemailad != "" || $ttelephone != "" || $spelized != "") {

        $sql = "select ocs_email  from oc_speaer where ocs_email='$eemailad' ";
        $result_check_email = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result_check_email) > 0) {
            $error2 = "Email already exist";
        } else {


            $sql = "select ocs_telephone  from oc_speaer where ocs_telephone='234" . substr($ttelephone, 1, 10) . "' ";
            $result_check_email = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result_check_email) > 0) {
                $error2 = "Telephone already exist";
            } else {


                $sql = "select ocl from oc_log";
                $result_count = mysqli_query($conn, $sql);
                $count_run = mysqli_num_rows($result_count) + 1;
                $date = date('Ydm');
                $bookingid = 'SP' . $date . $count_run;
                mysqli_query($conn, "insert into oc_log(ocl_id,ocl_detail,ocl_date,ocl_by) values('$bookingid','New Speaker','$mydate','Admin')");

                if ($passport == "") {
                    $sql_speakder = "insert into oc_speaer(ocs_id,ocs_fullname,ocs_email,ocs_telephone,ocs_category,ocs_profile,ocs_image,ocs_status) values('$bookingid','$ffullname','$eemailad','234" . substr($ttelephone, 1, 10) . "','$spelized','$profilexpereicne','$new_file_name','Active')";
                    $result_insert = mysqli_query($conn, $sql_speakder);

                } elseif ($passport != "") {


                    $uploaddir = 'banner/';
                    $uploadfile = $uploaddir . basename($_FILES['image_file']['name']);
                    if ($_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
                        $new_file_name = strtolower($file_name);
                        $new_file_name = str_replace(' ', '-', $new_file_name);
                        $new_file_name = substr($new_file_name, 0, -strlen($ext));
                        $new_file_name .= $extension;
                        $temp = explode(".", $_FILES["image_file"]["name"]);
                        $new_file_name = rand(1, 999999999) . '.' . end($temp);

                        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploaddir . $new_file_name)) {


                            $sql_speakder = "insert into oc_speaer(ocs_id,ocs_fullname,ocs_email,ocs_telephone,ocs_category,ocs_profile,ocs_image,ocs_status) values('$bookingid','$ffullname','$eemailad','234" . substr($ttelephone, 1, 10) . "','$spelized','$profilexpereicne','$new_file_name','Active')";
                            $result_insert = mysqli_query($conn, $sql_speakder);


                        }
                    }

                }
                mysqli_query($conn, "insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','" . $_SESSION['myaccess'] . "','" . $_SESSION['myaccess'] . "','Bank Account Setup','Speaker Profile Added Successfully $accnumber','$mydate','$mytime','$ip','$mycountry','$user_browser')");


                $msg = "Speaker Added Successfully";

                echo '<script>window.opener.location.reload()</script>';
                echo "<script>setTimeout('self.close()',2000);</script>";


            }
        }
    }
}
if ($delete != "") {
    mysqli_query($conn, "delete from oc_comm_setup where ocs='$delete'");

    mysqli_query($conn, "insert into oc_auditray(oca_user_type,oca_user_id,oca_login,oca_action,oca_action_describe,oca_action_date,oca_action_time,oca_ip,oca_location,oca_broswer) values('Admin','" . $_SESSION['myaccess'] . "','" . $_SESSION['myaccess'] . "','Commission Profile Deleted','Commission Profile Delete ID: $delete','$mydate','$mytime','$ip','$mycountry','$user_browser')");


}


if ($edit != "") {
    $sql = "select * from oc_speaer where ocs_id='$edit' ";
    $result_get_speakers = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_array($result_get_speakers)) {
        extract($rows);
    }

    $_POST['ffullname'] = $ocs_fullname;
    $_POST['eemailad'] = $ocs_email;
    $_POST['ttelephone'] = $ocs_telephone;
    $_POST['spelized'] = $ocs_category;
    $_POST['profilexpereicne'] = $ocs_profile;


}


?>

<!-- Main body -->
<div class="main-body">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Speaker</li>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-body">
                    <section id="section1">
                        <h5><?php if ($edit == "") { ?> Add  New <?php } ?> <?php if ($edit != "") { ?> Edit <?php } ?>
                            Speaker</h5>

                        <div class="row">
                            <div class="col-sm-12 mb-12">
                                <span style="color: blue;"><?php echo $msg; ?></span>

                                <form role="form"
                                      action="<?php mysqli_real_escape_string($conn, ($_SERVER["PHP_SELF"])); ?>"
                                      method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="col-sm-5 mb-3">
                                            <label>Full Name <span
                                                        style="color: red; font-weight: bolder;"><?php echo $error1; ?></span></label>
                                            <input type="text" class="form-control" name="ffullname"
                                                   value="<?php echo $_POST['ffullname']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5 mb-3">
                                            <label>Email Address <span
                                                        style="color: red; font-weight: bolder;"><?php echo $error2; ?></span></label>
                                            <input type="text" class="form-control" name="eemailad"
                                                   value="<?php echo $_POST['eemailad']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5 mb-3">
                                            <label> Telephone <span
                                                        style="color: red; font-weight: bolder;"><?php echo $error3; ?></span></label>
                                            <input type="text" class="form-control" name="ttelephone"
                                                   value="<?php echo $_POST['ttelephone']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5 mb-3">
                                            <label>Specalization <span
                                                        style="color: red; font-weight: bolder;"><?php echo $error4; ?></span></label>
                                            <select type="text" class="country form-control select2" name="spelized">

                                                <option value="">Select</option>

                                                <?php $sql = "select * from wb_category";
                                                $result_category = mysqli_query($conn, $sql);
                                                while ($rows = mysqli_fetch_array($result_category)) {
                                                    extract($rows); ?>
                                                    <option value="<?php echo $wc_id; ?>"<?php if ($_POST['spelized'] == $wc_id) { ?> selected <?php } ?>><?php echo $wc_category; ?></option>

                                                <?php } ?>

                                            </select></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-7 mb-3">
                                            <label>Profile/Experiences</label>
                                            <textarea class="form-control summernote"
                                                      name="profilexpereicne"><?php echo $_POST['profilexpereicne']; ?></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-5 mb-3">
                                            <label>Picture</label>
                                            <?php if ($ocs_image != "") { ?><img src="banner/<?php echo $ocs_image; ?>"
                                                                                 style="width:114px; height:127px;" /><?php } ?>

                                            <a data-toggle='modal' href='#picture'><span
                                                        id="results"><?php if (!empty($_POST['passport'])) {
                                                        echo '<img src="' . $_POST['passport'] . '" width="114" height="127"/>';
                                                    } else { ?><img src="faded_nopic.png" width="114"
                                                                    height="127"><?php } ?></span></a>

                                            <input type="hidden" name="passport" id="passport"
                                                   value="<?php if (!empty($_POST['passport'])) {
                                                       echo $_POST['passport'];
                                                   } ?>"/>

                                            <input type="file" data-classbutton="btn btn-default"
                                                   data-classinput="form-control inline"
                                                   class="filestyle form-control input-circle" name="image_file"
                                                   onchange="readURL(this);"></div>
                                    </div>


                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Save
                                    </button>
                                    <?php if ($edit != "") { ?>
                                        <button type="submit" value="savechange" name="savechange"
                                                class="btn btn-danger">Save Changes
                                        </button>
                                    <?php } ?>

                            </div>
                            </form></div>


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
                        <input type="text" class="form-control form-control-lg border-0 mx-1 px-0 px-lg-3"
                               placeholder="Search..." autocomplete="off" required autofocus>
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
                $('#results').html('<img src=' + e.target.result + ' width=100 height=100>');
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

</html>