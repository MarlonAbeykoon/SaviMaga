<!DOCTYPE html>
<html lang="en">

    <link href="../assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php include 'head.php'; ?>
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <body class="fix-header fix-sidebar card-no-border">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader" id="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ==========================header==================================== -->
            <?php include 'header.php'; ?>
            <!-- ==========================header finish==================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-6 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Assign Collection Areas</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Assign Area's to Collectors</h4>
                                </div>
                                <div class="card-body">
                                    <form id="form">
                                        <div class="form-body">
                                            <!--<h3 class="card-title">Manage Areas</h3>-->
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group has-success">
                                                        <label class="control-label">Select Collector :</label>
                                                        <select class="form-control custom-select" data-placeholder="Choose a Collector" tabindex="1" id="collector" onchange="LoadSelection()">
                                                            <option value="0">Select Collector</option>
                                                           
                                                            <?php
                                                            $sql = mysqli_query($con, "SELECT
`user`.idUser,
user_details.Fname
FROM
`user`
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details
WHERE
`user`.User_Type_idUser_Type = 3");
                                                            while ($result = mysqli_fetch_array($sql)) {
                                                                ?>
                                                                <option value="<?php echo $result['idUser'] ?>"><?php echo $result['Fname']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Assigned Areas :</label>
                                                        <p id="areas"></p>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                            </div>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="selectArea">
                                                        <label class="control-label">Assigned Areas for Collector</label>
                                                        <select id='pre-selected-options' multiple='multiple'>

                                                        </select>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" onclick="SaveAreasList();">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->

                </div>

                <!-- footer -->
                <!-- ============================================================== -->
                <?php
                include 'footer.php';
                ?>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>

    </body> 

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

    <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script>
                                                function LoadSelection() {
                                                    document.getElementById("preloader").style.opacity = "0.3";
                                                    document.getElementById("preloader").style.display = "block";
                                                    var uid = $("#collector").val()


                                                    var dataString = 'uid=' + uid;
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "web/AreasValueList.php",
                                                        data: dataString,
                                                        cache: false,
                                                        success: function (data) {

                                                            document.getElementById("areas").innerHTML = data;

                                                        }
                                                    });


                                                    $.ajax({
                                                        type: "POST",
                                                        url: "web/CollectorAndArea.php",
                                                        data: dataString,
                                                        cache: false,
                                                        success: function (data) {

                                                            document.getElementById("preloader").style.display = "none";
                                                            $("#pre-selected-options").empty().append(data);
                                                            $("#pre-selected-options").multiSelect('refresh');

                                                        }
                                                    });
                                                }

                                                function SaveAreasList() {
                                                    document.getElementById("preloader").style.opacity = "0.3";
                                                    document.getElementById("preloader").style.display = "block";

                                                    var uid = $("#collector").val();
                                                    var areas = $("#pre-selected-options").val();
                                                    var dataString = 'uid=' + uid + '&areas=' + areas;
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "Controller/SaveUserAndCollectionArea.php",
                                                        data: dataString,
                                                        cache: false,
                                                        success: function (data) {
                                                            document.getElementById("preloader").style.display = "none";
                                                            if (data === '1') {
                                                                successMessage();
                                                                LoadSelection();
                                                            } else {
                                                                errorMessage();
                                                                LoadSelection();
                                                            }
                                                        }
                                                    });

                                                }
                                                function successMessage() {
                                                    swal("Successfully Saved!", "", "success")
                                                }
                                                function errorMessage() {
                                                    swal("System Error!", "", "error")
                                                }

                                                function manualValidate(ev) {
                                                    //                        ev.target.checkValidity();
                                                    return false;
                                                }
                                                $("#form").bind("submit", manualValidate);
    </script>
    <script>
        $(document).ready(function () {

            // Switchery
            $('#pre-selected-options').multiSelect();
        });
    </script>

</html>