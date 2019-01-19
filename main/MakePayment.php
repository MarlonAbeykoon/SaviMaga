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
                                <li class="breadcrumb-item active">New Payment</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

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
                                            <tbody id="customers">
                                                <?php
                                                date_default_timezone_set("Asia/Colombo");
                                                $sql = mysqli_query($con, "SELECT
collection_area_user.CollectionArea_idCollectionArea,
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
debitors.Fname,
debitors.Lname,
debitors.Address1,
debitors.Address2,
credit_invoice.idCredit_Invoice
FROM
credit_invoice
INNER JOIN collection_area_user ON credit_invoice.CollectionArea_idCollectionArea = collection_area_user.CollectionArea_idCollectionArea
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
WHERE
collection_area_user.User_idUser = $user_de AND
credit_invoice.Settled = 0 AND
credit_invoice.`Status` = 1
ORDER BY
credit_invoice.Debitors_idDebitors ASC");
                                                $count = 1;
                                                while ($result = mysqli_fetch_array($sql)) {

                                                    $cid = $result['idCredit_Invoice'];

                                                    $sql2 = mysqli_query($con, "SELECT * FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $cid
Order by invoice_payments.DateTime Desc limit 1
");
                                                    $diff = 1;
                                                    $new = true;
                                                    while ($results = mysqli_fetch_array($sql2)) {
                                                        $new = false;
                                                        $payForDays = ($results['PayFor'] - 1);
                                                        $LastPayment = $results['DateTime'];
                                                        $lastDateOnly = explode(" ", $LastPayment);
                                                        $today = date("Y-m-d");
                                                        $datetime1 = date_create($lastDateOnly[0]);

                                                        $datetime1->modify("+" . $payForDays . " days");

                                                        $datetime2 = date_create($today);
                                                        $interval = date_diff($datetime1, $datetime2);
//echo $interval->format('%R%a days');
                                                        $diff = $interval->format('%R%a');
                                                    }
                                                    ?>
                                                    <tr <?php if ($diff <= 0) { ?>style="background-color: lightgreen;" <?php } ?>onclick="loadPaymentInfo(<?php echo $result['idCredit_Invoice']; ?>)">
                                                        <td><?php echo $count++; ?><input type="hidden" name="cid" value="<?php echo $result['idCredit_Invoice']; ?>" /></td>
                                                        <td><?php echo $result['Fname'] . " " . $result['Lname'] ?></td>
                                                        <td><?php echo $result['Address1'] . " " . $result['Address2']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Payment History</h4>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Payment form</h4>
                                </div>
                                <div class="card-body">
                                    <!--<form action="MakePayment.php" method="POST">-->
                                    <form id="form">
                                        <div class="form-body" id="paymentFormBody">
                                            <h3 class="card-title">Person Info</h3>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Full Name</label>
                                                        <input type="text" id="firstName" class="form-control" placeholder="" readonly>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">NIC</label>
                                                        <input type="text" id="lastName" class="form-control" placeholder="" readonly>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Address 1</label>
                                                        <input type="text" id="firstName" class="form-control" placeholder="" readonly>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Address 2</label>
                                                        <input type="text" id="lastName" class="form-control" placeholder="" readonly>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <h3 class="card-title">Payment Info</h3>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Daily Payment Amount</label>
                                                        <input type="text" id="dailyPay" class="form-control" placeholder="" readonly name="dailyPay">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Payment Date</label>
                                                        <input type="date" id="LastDate" class="form-control" placeholder="" readonly name="LastDate">
                                                    </div>

                                                    <!--/span-->
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Paying For</label>
                                                        <select class="form-control custom-select" id="payFor" >
                                                            <option value="1">1Day</option>
                                                            <option value="2">2Day</option>
                                                            <option value="3">3Day</option>
                                                            <option value="4">4Day</option>
                                                            <option value="5">5Day</option>
                                                            <option value="6">6Day</option>
                                                            <option value="7">7Day</option>
                                                            <option value="0">Full Amount</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Sub Total</label>
                                                        <input type="text" class="form-control" placeholder="" readonly id="subTot">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Penalty Amount</label>
                                                        <input type="text" id="dpay" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Total Amount</label>
                                                        <input type="text" id="dpay" class="form-control" placeholder="" readonly>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row" hidden>
                                                <div class="col-md-6" >
                                                    <div class="form-group">
                                                        <label class="control-label">Paid Amount</label>
                                                        <input type="text" id="dpay"  class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Balance</label>
                                                        <input type="text" id="dpay" class="form-control" placeholder="" readonly>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success" onclick="MakePayment(<?php echo $user_de; ?>);"> <i class="fa fa-check"></i> Save</button>
                                            <button type="reset" class="btn btn-inverse" onclick="loadPaymentInfo('0');">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->
                </div>
                <script >
                    function loadPaymentInfo(cid) {

                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var dataString = 'cid=' + cid;

                        $.ajax({
                            type: "POST",
                            url: "web/PaymentInfo.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("paymentFormBody").innerHTML = html;
                                loadPaymentHistory(cid);
                                loadCustomers();
                            }
                        });
                    }
                    function loadCustomers() {
                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var huid = document.getElementById('huserid').value;
                        var dataString = 'uid=' + huid;
                        $.ajax({
                            type: "POST",
                            url: "web/loadCustomersList.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("customers").innerHTML = html;
                            }
                        });
                    }

                    function loadPaymentHistory(cid) {
                        var dataString = 'cid=' + cid;

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
                    function CalculatePayment() {
                        var payFor = $("#payFor").val();
                        var dailyAmount = document.getElementById('dailyPay').value;
                        var addAmount = document.getElementById('addAmount').value;
                        var paidAmount = document.getElementById('paidAmount').value;
                        var totwithin = document.getElementById('totwithin').value;
                        var SettledAmount = document.getElementById('SettledAmount').value;
                        var subTot = 0;
                        if (payFor == '0') {
                            var subTot = totwithin - SettledAmount;
                        } else {
                            var subTot = payFor * dailyAmount;
                        }
                        var tot = parseFloat(subTot) + parseFloat(addAmount);
                        var balance = paidAmount - tot;
                        document.getElementById('subTot').value = subTot.toFixed(2);
                        document.getElementById('totAmount').value = tot.toFixed(2);
                        document.getElementById('balance').value = balance.toFixed(2);

                    }

                    function MakePayment(uid) {
                        swal({
                            title: "Are you sure?",
                            text: "You want to Make this Payment!",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#009efb",
                            confirmButtonText: "Yes!",
                            cancelButtonText: "No!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
//
                                document.getElementById("preloader").style.opacity = "0.3";
                                document.getElementById("preloader").style.display = "block";

                                var cid = document.getElementById('cid').value;
                                var dailyPay = document.getElementById('dailyPay').value;
                                var payFor = $("#payFor").val();
                                var addAmount = document.getElementById('addAmount').value;
                                var paidAmount = document.getElementById('paidAmount').value;
                                var dataString = 'uid=' + uid + '&cid=' + cid + '&dailyPay=' + dailyPay + '&payFor=' + payFor + '&addAmount=' + addAmount + '&paidAmount=' + paidAmount;

                                $.ajax({
                                    type: "POST",
                                    url: "Controller/SavePayment.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                        if (html.trim() === '1') {
                                            loadPaymentInfo(0);
                                            loadCustomers();
                                            successMessage();

                                        } else {
                                            errorMessage();
                                        }
                                        document.getElementById("preloader").style.display = "none"

                                    }
                                });
                            } else {
                                swal("Cancelled", "Payment is Canceled", "error");
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