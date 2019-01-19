<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php
    include 'head.php';
    ?>
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
                                <li class="breadcrumb-item active">Search</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>

                    <!-- row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Search Info</h4>
                                </div>
                                <div class="card-body">
                                    <!--<form action="MakePayment.php" method="POST">-->
                                    <form id="form">
                                        <div class="form-body" id="paymentFormBody">
                                            <h3 class="card-title">Collector Info</h3>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Collector</label>
                                                        <select class="form-control custom-select" data-placeholder="Select a Collector" tabindex="1" id="collector">
                                                            <option value="0">Select Collector</option>
                                                            <?php
                                                            $sql = mysqli_query($con, "SELECT
`user`.idUser,
user_details.Fname,
user_details.Lname
FROM
`user`
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details
WHERE
`user`.User_Type_idUser_Type = 3");
                                                            while ($result = mysqli_fetch_array($sql)) {
                                                                ?>
                                                                <option value="<?php echo $result['idUser'] ?>"><?php echo $result['Fname'] . " " . $result['Lname']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Area</label>
                                                        <select class="form-control custom-select" data-placeholder="Select an Area" tabindex="1" id="area">
                                                            <option value="0">Select Area</option>
                                                            <?php
                                                            $sql = mysqli_query($con, "SELECT
collectionarea.idCollectionArea,
collectionarea.CollectionArea
FROM
collectionarea
WHERE
collectionarea.`Status` = 1");
                                                            while ($result = mysqli_fetch_array($sql)) {
                                                                ?>
                                                                <option value="<?php echo $result['idCollectionArea'] ?>"><?php echo $result['CollectionArea']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                            </div>
                                            <!--/row-->

                                            <h3 class="card-title">Duration</h3>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">From Date</label>
                                                        <input type="date" id="fromDate" class="form-control" placeholder="" name="fromDate">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">To Date</label>
                                                        <input type="date" id="toDate" class="form-control" placeholder="" name="toDate">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success" onclick="LoadPage();"> <i class="fa fa-check"></i>Search</button>
                                            <button type="reset" class="btn btn-inverse" onclick="">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Search Result</h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Result Collected Amounts</h4>
                                    <h6 class="card-subtitle"></h6>
                                    <div class="table-responsive m-t-40" id="table">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Result for Expenses</h4>
                                    <h6 class="card-subtitle"><p>If you select Collector then Expenses result filtered by using Collector and Date Range, Otherwise retrieve all result according to the date range.</p></h6>
                                    <div class="table-responsive m-t-40" id="table2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-----Row---->

                


                </div>
                <script >
                    function LoadPage(pn) {

                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var cid = document.getElementById('collector').value;
                        var aid = document.getElementById('area').value;
                        var fdate = document.getElementById('fromDate').value;
                        var tdate = document.getElementById('toDate').value;
                        fdate = fdate + ' 00:00:00';
                        tdate = tdate + ' 23:59:59';
//                        alert(cid + " / " + aid + " / " + fdate + " / " + tdate + "pn:" + pn);

                        var dataString = 'pn=' + pn + '&cid=' + cid + '&aid=' + aid + '&fdate=' + fdate + '&tdate=' + tdate;
                        $.ajax({
                            type: "POST",
                            url: "web/Search1.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("table").innerHTML = html;
                                LoadPage2();
                                 document.getElementById("preloader").style.display = "none";
                            }
                        });
                    }
                    
                    function LoadPage2(pn) {

                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var cid = document.getElementById('collector').value;
                        var aid = document.getElementById('area').value;
                        var fdate = document.getElementById('fromDate').value;
                        var tdate = document.getElementById('toDate').value;
                        fdate = fdate + ' 00:00:00';
                        tdate = tdate + ' 23:59:59';
//                        alert(cid + " / " + aid + " / " + fdate + " / " + tdate + "pn:" + pn);

                        var dataString = 'pn=' + pn + '&cid=' + cid + '&aid=' + aid + '&fdate=' + fdate + '&tdate=' + tdate;
                        $.ajax({
                            type: "POST",
                            url: "web/Search2.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("table2").innerHTML = html;
                                 document.getElementById("preloader").style.display = "none"
                            }
                        });
                    }


                    function manualValidate(ev) {
//                        ev.target.checkValidity();
                        return false;
                    }
                    $("#form").bind("submit", manualValidate);
                </script>

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


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:49 GMT -->
</html>