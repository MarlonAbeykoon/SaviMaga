<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php include 'head.php'; ?>
    <script>
        function LoadTable() {
            var dataString = 'search=' + document.getElementById('serchText').value;

            $.ajax({
                type: "GET",
                url: "web/loanDetailsTable.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    document.getElementById("tableBody").innerHTML = html;
                    document.getElementById("fullHistory").innerHTML = "";

                }
            });
        }

    </script>
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
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search for..." id="serchText" onchange="LoadTable();">
                                            <div class="input-group-append">
                                                <button class="btn btn-info" type="button" onclick="LoadTable();">Go!</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- column -->
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><!-- Granted Loan Details --></h4>
                                                <div class="table-responsive">

                                                    <div id="tableBody">

                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>NIC</th>
                                                                    <th>Name</th>
                                                                    <th>Repay Amount</th>
                                                                    <th>Paid</th>
                                                                    <th>Progress</th>
                                                                    <th>Deadline</th>
                                                                    <th class="text-nowrap">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $nic = $_GET['nic'];
                                                                $sql = mysqli_query($con, "SELECT
                                                            debitors.NIC,
                                                            debitors.Fname,
                                                            credit_invoice.idCredit_Invoice,
                                                            credit_invoice.TotalAmount,
                                                            credit_invoice.TotalAmount,
                                                            credit_invoice.PaidAmount,
                                                            credit_invoice.DailyEqualPayment,
                                                            credit_invoice.Days,
                                                            credit_invoice.DateTime,
                                                            credit_invoice.InterestRate,
                                                            credit_invoice.Settled,
                                                            credit_invoice.Status
                                                            FROM
                                                            credit_invoice
                                                            INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
                                                            WHERE
                                                            debitors.NIC LIKE '$nic%' ORDER BY credit_invoice.DateTime desc
                                                            LIMIT 10");

                                                                while ($result = mysqli_fetch_array($sql)) {
                                                                    $date = new DateTime($result['DateTime']);
                                                                    $date->modify("+" . $result['Days'] . " days");
                                                                    ?>
                                                                    <tr onclick="loadPaymentInfo(<?php echo $result['idCredit_Invoice']; ?>)">
                                                                        <td><?php echo $result['NIC']; ?></td>
                                                                        <td><?php echo $result['Fname']; ?></td>
                                                                        <td><?php echo $result['TotalAmount']; ?></td>
                                                                        <td><?php echo $result['PaidAmount']; ?></td>
                                                                        <td>
                                                                            <div class="progress progress-xs margin-vertical-10 ">
                                                                                <?php
                                                                                $ccid = $result['idCredit_Invoice'];
                                                                                $sql2 = mysqli_query($con, "SELECT * FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $ccid
Order by invoice_payments.DateTime Desc limit 1
");

                                                                                $diff = 9999;

                                                                                while ($results = mysqli_fetch_array($sql2)) {
                                                                                    $LastPayment = $results['DateTime'];
                                                                                    $lastDateOnly = explode(" ", $LastPayment);
                                                                                    $datetime1 = date_create($lastDateOnly[0]);

                                                                                    $interval = date_diff($date, $datetime1);
                                                                                    $diff = $interval->format('%R%a');
                                                                                }
                                                                                if ($diff == 9999) {
                                                                                    $today = date("Y-m-d");
                                                                                    $datetime1 = date_create($today);
                                                                                    $interval = date_diff($date, $datetime1);
                                                                                    $diff = $interval->format('%R%a');
                                                                                }
//                                                                                echo $diff;
                                                                                ?>
                                                                                <div 
                                                                                <?php
                                                                                if ($diff <= 0 && $result['Settled'] == 1) {
                                                                                    echo 'class="progress-bar bg-success"';
                                                                                }else if($diff > 0 && $result['Settled'] == 1){
                                                                                    echo 'class="progress-bar bg-purple"';
                                                                                } else if ($diff < 0 && $result['Settled'] == 0) {
                                                                                    echo 'class="progress-bar bg-info"';
                                                                                } else {
                                                                                    echo 'class="progress-bar bg-danger"';
                                                                                }
                                                                                ?>
                                                                                      style="width: <?php echo (($result['PaidAmount'] / $result['TotalAmount']) * 100); ?>% ;height:6px;"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo $date->format("Y-m-d"); ?></td>
                                                                        <td class="text-nowrap">
                                                                            <?php
                                                                            if ($result['Status'] == 0) {
                                                                                echo 'Pending Approval';
                                                                            } else if ($result['Status'] == 1 && $result['Settled'] == 0) {
                                                                                echo 'Ongoing';
                                                                            } else if ($result['Settled'] == 1) {
                                                                                echo 'Completed';
                                                                            }else if ($result['Status'] == 3) {
                                                                                echo 'Rejected';
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->

                                    <div id="fullHistory"> </div>



                                </div>
                            </div>
                        </div>



                    </div>


                </div>

                <script >
                    function loadPaymentInfo(cid) {

                        document.getElementById("preloader").style.opacity = "0.3"
                        document.getElementById("preloader").style.display = "block";

                        var dataString = 'cid=' + cid;

                        $.ajax({
                            type: "POST",
                            url: "web/PaymentHistoryFull.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                document.getElementById("fullHistory").innerHTML = html;
                                document.getElementById("preloader").style.display = "none"
                            }
                        });
                    }
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