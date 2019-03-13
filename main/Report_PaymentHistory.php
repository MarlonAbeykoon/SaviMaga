<!DOCTYPE html>
<html lang="en">


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
                                <li class="breadcrumb-item active">Report Payment History</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>


                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Select Collector</h4>
                                    <div class="col-md-6">
                                        <select class="form-control custom-select" data-placeholder="Choose a Collector" tabindex="1" id="collector" onchange="loadPaymentInfo(0)">
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
                            </div>
                        </div>
                    </div>
                    <!-- row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Customers</h4>
                                    <div class="table-responsive" style=" height:400px; overflow-y:scroll;">
                                        <table class="table full-color-table full-info-table hover-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>
                                            <tbody id="debtorBody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" id="phtitle">Payment History of</h4>
                                    <div class="table-responsive"style=" height:400px; overflow-y:scroll;">
                                        <table class="table full-color-table full-warning-table hover-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Pay For</th>
                                                    <th>Amount</th>
                                                    <th>Add.Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="PaymentHistory">
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Rs.</td>
                                                    <td>Rs.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->

                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" id="amountTitle">Total Collected Amount:</h4>
                                    <h4 id="colAmount">Rs:</h4>
                                    <h4 class="card-title" id="amountTitle">Total Expenses Amount:</h4>
                                    <h4 id="expAmount">Rs:</h4>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->


                </div>
                <script >
                    setInterval(function () {
                        loadPaymentInfo(0);
                    }, 1000 * 5 * 1);


                    function loadPaymentInfo(action) {

                        if (action === '1') {
                            document.getElementById("preloader").style.opacity = "0.3"
                            document.getElementById("preloader").style.display = "block";
                        }

                        var cid = $("#collector").val();

                        var dataString = 'cid=' + cid;

                        $.ajax({
                            type: "POST",
                            url: "web/Report_LiveFeedDebtor.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("debtorBody").innerHTML = html;
                                getCollectedAmount(cid);
                            }
                        });
                    }

                    function loadPaymentHistory(cid, name) {
                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var dataString = 'cid=' + cid;
                        document.getElementById("phtitle").innerHTML = "Payment History of " + name;



                        $.ajax({
                            type: "POST",
                            url: "web/PaymentHistorySmall.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("PaymentHistory").innerHTML = html;
                                document.getElementById("preloader").style.display = "none"

                            }
                        });
                    }

                    function getCollectedAmount(cid) {
                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var dataString = 'cid=' + cid;
                        //                        document.getElementById("amountTitle").innerHTML = "Total Collected Amount Collected By "+name+" :";


                        $.ajax({
                            type: "POST",
                            url: "web/getDailyCollectedAmount.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("colAmount").innerHTML = "Rs: " + html;
                                document.getElementById("preloader").style.display = "none"
                                getExpensesAmount(cid);
                            }
                        });
                    }


                    function getExpensesAmount(cid) {
                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var dataString = 'cid=' + cid;
                       
                        $.ajax({
                            type: "POST",
                            url: "web/getDailySpendExpenses.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                
                                document.getElementById("expAmount").innerHTML = "Rs: " + html;
                                document.getElementById("preloader").style.display = "none"
                            }
                        });
                    }

                    function successMessage() {
                        swal("Payment Successfull!", "", "success")
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