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
                                <li class="breadcrumb-item active">Manage Expenses</li>
                            </ol>
                        </div>
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Expenses</h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Expenses</h4>
                                    <h6 class="card-subtitle">You can only delete same day expenses.</h6>
                                    <div class="table-responsive m-t-40" id="table">
                                        <?php
//////////////  QUERY THE MEMBER DATA INITIALLY LIKE YOU NORMALLY WOULD

                                        $sql = mysqli_query($con, "SELECT
CollectorExpenses.idCollectorExpenses,
CollectorExpenses.Amount,
CollectorExpenses.Details,
CollectorExpenses.Date,
CollectorExpenses.`Status`,
CollectorExpenses.user_idUser
FROM
CollectorExpenses
ORDER BY
CollectorExpenses.idCollectorExpenses DESC
");
//////////////////////////////////// Adam's Pagination Logic ////////////////////////////////////////////////////////////////////////
                                        $nr = mysqli_num_rows($sql); // Get total of Num rows from the database query
                                        if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
                                            $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
                                            //$pn = ereg_replace("[^0-9]", "", $_GET['pn']); // filter everything but numbers for security(deprecated)
                                        } else { // If the pn URL variable is not present force it to be value of page number 1
                                            $pn = 1;
                                        }
//This is where we set how many database items to show on each page 
                                        $itemsPerPage = 10;
// Get the value of the last page in the pagination result set
                                        $lastPage = ceil($nr / $itemsPerPage);
// Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
                                        if ($pn < 1) { // If it is less than 1
                                            $pn = 1; // force if to be 1
                                        } else if ($pn > $lastPage) { // if it is greater than $lastpage
                                            $pn = $lastPage; // force it to be $lastpage's value
                                        }
// This creates the numbers to click in between the next and back buttons
// This section is explained well in the video that accompanies this script
                                        $centerPages = "";
                                        $sub1 = $pn - 1;
                                        $sub2 = $pn - 2;
                                        $add1 = $pn + 1;
                                        $add2 = $pn + 2;
                                        if ($pn == 1) {
                                            $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $add1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add1 . '</a>';
                                        } else if ($pn == $lastPage) {
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $sub1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub1 . '</a>';
                                            $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
                                        } else if ($pn > 2 && $pn < ($lastPage - 1)) {
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $sub2 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub2 . '</a>';
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $sub1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub1 . '</a>';
                                            $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $add1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add1 . '</a>';
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $add2 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add2 . '</a>';
                                        } else if ($pn > 1 && $pn < $lastPage) {
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $sub1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub1 . '</a>';
                                            $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
                                            $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage(' . $add1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add1 . '</a>';
                                        }
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
                                        $limit = 'LIMIT ' . ($pn - 1) * $itemsPerPage . ',' . $itemsPerPage;
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
                                        $sql2 = mysqli_query($con, "SELECT
CollectorExpenses.idCollectorExpenses,
CollectorExpenses.Amount,
CollectorExpenses.Details,
CollectorExpenses.Date,
CollectorExpenses.`Status`,
CollectorExpenses.user_idUser
FROM
CollectorExpenses
ORDER BY
CollectorExpenses.idCollectorExpenses DESC 
 $limit");
//////////////////////////////// END Adam's Pagination Logic ////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Adam's Pagination Display Setup /////////////////////////////////////////////////////////////////////
                                        $paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is ot equal to 1, if it is only 1 page we require no paginated links to display
                                        if ($lastPage > "1") {
                                            // This shows the user what page they are on, and the total number of pages
                                            $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage . '&nbsp;  &nbsp;  &nbsp; ';
                                            // If we are not on page 1 we can place the Back button
                                            if ($pn > 1) {
                                                $previous = $pn - 1;
                                                $paginationDisplay .= '<span><a href="javascript:void();" onclick="LoadPage(' . $previous . ')" class="paginate_button previous" aria-controls="table1" data-dt-idx="0" tabindex="0" id="table1_previous">Previous</a>';
                                            }
                                            // Lay in the clickable numbers display here between the Back and Next links
                                            $paginationDisplay .= $centerPages;
                                            // If we are not on the very last page we can place the Next button
                                            if ($pn != $lastPage) {
                                                $nextPage = $pn + 1;
                                                $paginationDisplay .= '</span><a href="javascript:void();" onclick="LoadPage(' . $nextPage . ')" class="paginate_button next" aria-controls="table1" data-dt-idx="7" tabindex="0" id="example23_next">Next</a>';
                                            }
                                        }
////////////////////////////////////////////////////////////////////////////////
                                        $outputList = '';
                                        ?>


                                        <div id="table1" class="dataTables_wrapper"><table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 362px;">Amount</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 516px;">Detail</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 269px;">Date</th>
                                                        <th   rowspan="1" colspan="1" aria-label="" style="width: 269px;"></th>
                                                </thead>
                                                <tfoot>
                                                    <tr><th rowspan="1" colspan="1">Amount</th><th rowspan="1" colspan="1">Detail</th><th rowspan="1" colspan="1">Date</th><th rowspan="1" colspan="1"></th></tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($sql2)) {
                                                        ?>
                                                        <tr role="row" class="odd">
                                                            <td>Rs.<?php echo $row['Amount'] ?></td>
                                                            <td><?php echo $row['Details'] ?></td>
                                                            <td><?php echo $row['Date'] ?></td>   
                                                            <td><a href="#" 
                                                                <?php
                                                                $today = date("Y-m-d");
                                                                $datetime1 = date_create($row['Date']);
                                                                $datetime2 = date_create($today);
                                                                $interval = date_diff($datetime1, $datetime2);
                                                                $diff = $interval->format('%a');
                                                                if($diff == 0){
                                                                   
                                                                ?>

                                                                   onclick="deleteExpenses('<?php echo $row['idCollectorExpenses']; ?>')" <?php }else{ ?> onclick="cantDeleteExpenses()"<?php }?>data-toggle="tooltip" data-original-title="Delete Expense"> <i class="fa fa-trash text-inverse m-r-10"></i>Delete</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <!--<div class="dataTables_info" id="example23_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>-->
                                            <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                                <?php echo $paginationDisplay; ?>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-----Row---->
                </div>
                <script >
                    function addExpenses() {
                        swal({
                            title: "Are you sure?",
                            text: "You want to Add new Expenses!",
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

                                var detail = document.getElementById("details").value;
                                var amount = document.getElementById("amount").value;

                                var dataString = 'detail=' + detail + '&amount=' + amount + '&type=1';
                                $.ajax({
                                    type: "POST",
                                    url: "Controller/ExpensesControl.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                        if (html === '1') {
                                            swal("Added!", "Expenses Added Successfuly.", "success");
                                            location.reload();
                                        } else {
                                            swal("System Error!", "", "error")
                                        }
                                        document.getElementById("preloader").style.display = "none"

                                    }
                                });

                            } else {
                                swal("Cancelled", "Expenses is not Added", "error");
                            }
                        });
                    }

                    function deleteExpenses(eid) {
                        swal({
                            title: "Are you sure?",
                            text: "You want to Delete this Expense!",
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


                                var dataString = 'eid=' + eid + '&status=0 &type=2';
                                $.ajax({
                                    type: "POST",
                                    url: "Controller/ExpensesControl.php",
                                    data: dataString,
                                    cache: false,
                                    success: function (html) {
                                        if (html === '1') {
                                            swal("Deleted!", "Expense Deleted Successfuly.", "success");
                                            location.reload();
                                        } else {
                                            swal("System Error!", "", "error")
                                        }
                                        document.getElementById("preloader").style.display = "none"

                                    }
                                });

                            } else {
                                swal("Cancelled", "Expense is not Deleted", "error");
                            }
                        });
                    }
                    
                    function cantDeleteExpenses(){
                        swal("Cancelled", "Can't Delete,Because this is not a Same Day expense.", "error");
                    }

                    function LoadPage(pn) {
                        document.getElementById("preloader").style.opacity = "0.3";
                        document.getElementById("preloader").style.display = "block";

                        var dataString = 'pn=' + pn;

                        $.ajax({
                            type: "POST",
                            url: "web/Expenses_Pagination.php",
                            data: dataString,
                            cache: false,
                            success: function (data) {
                                document.getElementById("preloader").style.display = "none";
                                document.getElementById('table').innerHTML = data;

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