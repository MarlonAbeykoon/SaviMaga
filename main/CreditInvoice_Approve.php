<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php include 'head.php'; ?>

    <body class="fix-header fix-sidebar card-no-border">
        <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
                                <li class="breadcrumb-item active">Approval Pending Loans</li>
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
                                        <!--                                        <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Search for..." id="serchText" onchange="LoadTable();">
                                                                                    <div class="input-group-append">
                                                                                        <button class="btn btn-info" type="button" onclick="LoadTable();">Go!</button>
                                                                                    </div>
                                                                                </div>-->
                                    </div>

                                    <!-- column -->
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Approval Pending Loans</h4>
                                                <div class="table-responsive">

                                                    <div id="tableBody">

                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>NIC</th>
                                                                    <th>Name</th>
                                                                    <th>Loan Type</th>
                                                                    <th>Applied Amount</th>
                                                                    <th>Applied Date</th>
                                                                    <th></th>
                                                                    <th class="text-nowrap"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $sql = mysqli_query($con, "SELECT
                                                            debitors.NIC,
                                                            debitors.Fname,
                                                            debitors.Pno,
                                                            credit_invoice.idCredit_Invoice,
                                                            credit_invoice.TotalAmount,
                                                            credit_invoice.PaidAmount,
                                                            credit_invoice.DailyEqualPayment,
                                                            credit_invoice.Days,
                                                            credit_invoice.DateTime,
                                                            credit_invoice.InterestRate,
                                                            credit_invoice.type
                                                            FROM
                                                            credit_invoice
                                                            INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
                                                            WHERE
                                                            credit_invoice.Status = '0' AND credit_invoice.Settled = '0' AND
                                                            (debitors.NIC LIKE '%%' OR
                                                             debitors.Fname Like '%%')
                                                            LIMIT 10");

                                                                while ($result = mysqli_fetch_array($sql)) {
                                                                    $date = new DateTime($result['DateTime']);
//                                                                    $date->modify("+" . $result['Days'] . " days");
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $result['NIC']; ?></td>
                                                                        <td><?php echo $result['Fname']; ?></td>
                                                                        <td><?php echo $result['type']; ?></td>
                                                                        <td><?php echo $result['TotalAmount']; ?></td>
                                                                        <td><?php echo $date->format("Y-m-d"); ?></td>
                                                                        <td> 
                                                                            <a href="CreditInvoice_Details.php?nic=<?php echo $result['NIC']; ?>" target="_blank" data-toggle="tooltip" data-original-title="View Customer History"> <i class="fa fa-user-secret text-inverse m-r-10"></i>View Customer History</a>
                                                                        </td>
                                                                        <td class="text-nowrap">
                                                                            <a href="javascript:void(0)"  onclick="ApproveLoan('<?php echo $result['idCredit_Invoice']; ?>','<?php echo $result['Pno1']; ?>')" data-toggle="tooltip" data-original-title="Approve Loan"> <i class="fa fa-check-circle text-inverse m-r-10"></i>Approve</a>
                                                                            <a href="javascript:void(0)" onclick="RejectLoan('<?php echo $result['idCredit_Invoice']; ?>','<?php echo $result['Pno1']; ?>')" data-toggle="tooltip" data-original-title="Reject Loan"> <i class="fa fa-times-circle text-inverse m-r-10"></i>Reject</a>
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

                                </div>
                            </div>
                        </div>



                    </div>


                </div>

                <script >
                    function ApproveLoan(cid,phoneno) {

                        swal({
                            title: "Are you sure?",
                            text: "You want to Approve this Loan!",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#009efb",
                            confirmButtonText: "Yes!",
                            cancelButtonText: "No!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                document.getElementById("preloader").style.opacity = "0.3"
                                document.getElementById("preloader").style.display = "block";

                                var dataString = 'cid=' + cid + '&status=1';
                                $.ajax({
                                    type: "POST",
                                    url: "Controller/CreditInvoice_StatusChange.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                        if (html === '1') {
                                            swal("Approved!", "Loan Approved Successfuly.", "success");

                                            var user = "94771143449";
                                            var password = "1350";
                                            var text = "Dear Customer, We have approved your loan application. SaviMaga";
                                            var to = "94" + phoneno;

                                            var baseurl ="http://www.textit.biz/sendmsg";
                                            var url2 = baseurl+"/?id="+user+"&pw="+password+"&to="+to+"&text="+text;
                                            // Create a request variable and assign a new XMLHttpRequest object to it.
                                            var request = new XMLHttpRequest();

                                            // Open a new connection, using the GET request on the URL endpoint
                                            request.open('GET', url2, true);
                                            // Send request
                                            request.send();
                                            location.reload();

                                        } else {
                                            swal("System Error!", "", "error")
                                        }
                                        document.getElementById("preloader").style.display = "none"

                                    }
                                });

                            } else {
                                swal("Cancelled", "Loan is not Approved", "error");
                            }
                        });
                    }

                    function RejectLoan(cid,phoneno) {

                        swal({
                            title: "Are you sure?",
                            text: "You want to Reject this Loan!",
                            type: "error",
                            showCancelButton: true,
                            confirmButtonColor: "#009efb",
                            confirmButtonText: "Yes!",
                            cancelButtonText: "No!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                document.getElementById("preloader").style.opacity = "0.3"
                                document.getElementById("preloader").style.display = "block";

                                var dataString = 'cid=' + cid + '&status=3';
                                $.ajax({
                                    type: "POST",
                                    url: "Controller/CreditInvoice_StatusChange.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                        if (html === '1') {
                                            swal("Rejected!", "Loan Rejected Successfuly.", "success");

                                            var user = "94771143449";
                                            var password = "1350";
                                            var text = "Dear Customer, We have rejected your loan application. SaviMaga";
                                            var to = "94" + phoneno;

                                            var baseurl ="http://www.textit.biz/sendmsg";
                                            var url2 = baseurl+"/?id="+user+"&pw="+password+"&to="+to+"&text="+text;
                                            var request = new XMLHttpRequest();

                                            // Open a new connection, using the GET request on the URL endpoint
                                            request.open('GET', url2, true);
                                            // Send request
                                            request.send();
                                            location.reload();
                                        } else {
                                            swal("System Error!", "", "error")
                                        }
                                        document.getElementById("preloader").style.display = "none"

                                    }
                                });

                            } else {
                                swal("Cancelled", "Loan is not Rejected", "error");
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