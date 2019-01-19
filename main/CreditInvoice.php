<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php include 'head.php'; ?>
    <script>
        function LoadApplicant() {
            var id;

            for (i = 0; i < document.getElementsByName('radio').length; i++) {
                if (document.getElementsByName('radio')[i].checked) {
                    id = document.getElementsByName('radio')[i].value;
                }
            }

            var dataString = 'id=' + id;

            $.ajax({
                type: "POST",
                url: "web/newApplicant.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    document.getElementById("Applicant").innerHTML = html;

                }
            });
        }

        function Calculate() {
            var amount = document.getElementsByName("amount")[0].value;
            var days = document.getElementsByName("days")[0].value;
            var rate = document.getElementsByName("rate")[0].value;
            var interest = ((amount / 100) * rate);

            var dailyPay = (parseFloat((interest / 30) * days) + parseFloat(amount)) / days;
            var tot = dailyPay * days;
            document.getElementsByName("dpay")[0].value = dailyPay.toFixed(2);
            document.getElementsByName("tot")[0].value = tot.toFixed(2);
        }
        function BackwardCalculate() {
            var amount = document.getElementsByName("amount")[0].value;
            var days = document.getElementsByName("days")[0].value;
            var dailyPay = document.getElementsByName("dpay")[0].value;
            
           var fullinterestAmount = dailyPay * days - parseFloat(amount);
             var monthlyInterestAmount = (fullinterestAmount/days)*30;
            var rate =monthlyInterestAmount/(amount/100);
            
            document.getElementsByName("rate")[0].value = rate.toFixed(2);
            var tot = parseFloat(fullinterestAmount) +parseFloat(amount);
            document.getElementsByName("tot")[0].value = tot.toFixed(2);
        }
    </script>
    <body class="fix-header fix-sidebar card-no-border">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
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
                                <li class="breadcrumb-item active">New Loan Application</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    if ($_GET['msg'] == "success") {
                                        ?>
                                        <div class="alert alert-success alert-rounded">Loan Application Details Successfully Saved.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                    <?php } else if ($_GET['msg'] == "fail") { ?>
                                        <div class="alert alert-danger alert-rounded">Error: Please refill details and submit again.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                    <?php } ?>
                                    <h4 class="card-title">Loan Application</h4>
                                    <div class="form-group row p-t-20">
                                        <div class="col-sm-4">
                                            <div class="m-b-10">
                                                <label class="custom-control custom-radio">
                                                    <input id="Applicant1" name="radio" value="0" type="radio" class="custom-control-input" onclick="LoadApplicant()" checked="checked">
                                                    <span class="custom-control-label">Existing Applicant</span>
                                                </label>
                                            </div>
                                            <div class="m-b-10">
                                                <label class="custom-control custom-radio">
                                                    <input id="Applicant2" name="radio"  value="1" type="radio" class="custom-control-input" onclick="LoadApplicant()">
                                                    <span class="custom-control-label">New Applicant</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle"></h6>

                                    <form action="Controller/CreditInvoiceControl.php" class="form-horizontal" method="POST">
                                        <div class="form-body">
                                            <div id="Applicant" >

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Existing Applicants</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control custom-select" data-placeholder="Choose a Applicant" tabindex="1" name="extApplicant">
                                                                    <?php
                                                                    $sql = mysqli_query($con, "SELECT debitors.idDebitors,debitors.Fname,debitors.NIC FROM debitors");
                                                                    while ($result = mysqli_fetch_array($sql)) {
                                                                        ?>
                                                                        <option value="<?php echo $result['idDebitors'] ?>"><?php echo $result['Fname'] . " (" . $result['NIC'] . ")"; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div id="formBody">
                                                <h3 class="box-title">Loan Details</h3>
                                                <hr class="m-t-0 m-b-40">
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Collection Area</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control custom-select" data-placeholder="Choose a Area" tabindex="1" name="area">
                                                                    <?php
                                                                    $sql = mysqli_query($con, "SELECT * FROM collectionarea");
                                                                    while ($result = mysqli_fetch_array($sql)) {
                                                                        ?>
                                                                        <option value="<?php echo $result['idCollectionArea'] ?>"><?php echo $result['CollectionArea']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--                                                <h3 class="box-title">Loan Details</h3>
                                                                                                <hr class="m-t-0 m-b-40">-->
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Applying Amount</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="amount" onchange="Calculate();" required pattern="[0-9]+(\.[0-9][0-9]?)?">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Interest Rate</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="rate" onchange="Calculate();" required pattern="[0-9]+(\.[0-9][0-9]?)?">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Days</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" name="days" onchange="Calculate();" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Total with Interest</label>
                                                            <div class="col-md-9">
                                                                <input type="text" disabled class="form-control" name="tot" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Daily Payment</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="dpay" onchange="BackwardCalculate();">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <h3 class="box-title">Guarantors Details</h3>
                                                <hr class="m-t-0 m-b-40">
                                                <h4 class="box-title">First Guarantor</h4>
                                                <hr class="m-t-0 m-b-40">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">First Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1fname" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Last Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1lname" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Phone No1</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1phone1" placeholder="123456789" pattern="[0-9]{10}" title="10 Digit Phone No" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Phone No2</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1phone2" placeholder="123456789" pattern="[0-9]{10}" title="10 Digit Phone No" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Address 1</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1address1" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Address 2</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1address2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">NIC</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g1nic" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="box-title">Second Guarantor</h4>
                                                <hr class="m-t-0 m-b-40">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">First Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g2fname" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Last Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g2lname" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Phone No1</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g2phone1" placeholder="123456789" pattern="[0-9]{10}" title="10 Digit Phone No" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Phone No2</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g2phone2" placeholder="123456789" pattern="[0-9]{10}" title="10 Digit Phone No" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Address 1</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g2address1" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Address 2</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="g2address2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">NIC</label>
                                                            <div class="col-md-9">
                                                                <input type="text"  class="form-control" name="g2nic" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                                <button type="reset" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>



                    </div>


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


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:49 GMT -->
</html>