<!DOCTYPE html>
<html lang="en">


    <!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Mar 2018 17:36:45 GMT -->
    <?php include 'head.php'; ?>
    <!-- This is data table -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/jsgrid/dist/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="../assets/plugins/jsgrid/dist/jsgrid-theme.min.css" />
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
                        <!-- <div class="col-md-6 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div> -->
                        <div class="col-md-6 col-4 align-self-center">

                        </div>
                    </div>

                    <!-- Row -->


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Collected Info</h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"> </h4>
                                    <div id="basicgrid" class="jsgrid" style="position: relative; height: 500px; width: 100%;">
                                        <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                            <table class="jsgrid-table table table-striped table-hover">
                                                <tr class="jsgrid-header-row">
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 150px;">Name</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 100px;">Date</th>
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 70px;">Amount</th> 
                                                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 70px;">Add. Amount</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-center" style="width: 150px;">Collector</th>
                                                </tr>
                                                <tr class="jsgrid-filter-row">
                                                    <td class="jsgrid-cell" style="width: 150px;">
                                                        <input type="text" class="form-control input-sm" id="dname" onchange="LoadPage('1');">
                                                    </td>
                                                    <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;">
                                                        <input type="date" class="form-control input-sm" id="date" onchange="LoadPage('1');"></td>
                                                    <td class="jsgrid-cell jsgrid-align-right" style="width: 70px;">
                                                        <input type="number" class="form-control input-sm" readonly></td>
                                                    <td class="jsgrid-cell" style="width: 70px;">
                                                        <input type="number" class="form-control input-sm" readonly></td>
                                                    <td class="jsgrid-cell" style="width: 150px;">
                                                        <input type="text" class="form-control input-sm" id="collector" onchange="LoadPage('1');">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div id="table">
                                            <div class="jsgrid-grid-body" style="height: 325px;">
                                                <?php
//////////////  QUERY THE MEMBER DATA INITIALLY LIKE YOU NORMALLY WOULD
                                               
                                                $sql = mysqli_query($con, "SELECT
invoice_payments.Amount,
invoice_payments.AdditionalAmount,
invoice_payments.DateTime,
invoice_payments.User_idUser,
debitors.Fname as dfname,
debitors.Lname as dlname,
user_details.Fname as cfname,
user_details.Lname as clname
FROM
invoice_payments
INNER JOIN credit_invoice ON invoice_payments.Credit_Invoice_idCredit_Invoice = credit_invoice.idCredit_Invoice
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
INNER JOIN `user` ON invoice_payments.User_idUser = `user`.idUser
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details
WHERE debitors.Fname like '$dname%' 
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
                                                $itemsPerPage = 8;
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
                                                    $centerPages .= '<span class="jsgrid-pager-page jsgrid-pager-current-page">' . $pn . '</span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $add1 . ')">' . $add1 . '</a></span>';
                                                } else if ($pn == $lastPage) {
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $sub1 . ')">' . $sub1 . '</a></span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page jsgrid-pager-current-page">' . $pn . '</span>';
                                                } else if ($pn > 2 && $pn < ($lastPage - 1)) {
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $sub2 . ')">' . $sub2 . '</a></span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $sub1 . ')">' . $sub1 . '</a></span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page jsgrid-pager-current-page">' . $pn . '</span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $add1 . ')">' . $add1 . '</a></span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $add2 . ')">' . $add2 . '</a></span>';
                                                } else if ($pn > 1 && $pn < $lastPage) {
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $sub1 . ')">' . $sub1 . '</a></span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page jsgrid-pager-current-page">' . $pn . '</span>';
                                                    $centerPages .= '<span class="jsgrid-pager-page"><a href="javascript:void(0);" onclick="LoadPage(' . $add1 . ')">' . $add1 . '</a></span>';
                                                }
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
                                                $limit = 'LIMIT ' . ($pn - 1) * $itemsPerPage . ',' . $itemsPerPage;
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
                                                $sql2 = mysqli_query($con, "SELECT
invoice_payments.Amount,
invoice_payments.AdditionalAmount,
invoice_payments.DateTime,
invoice_payments.User_idUser,
debitors.Fname as dfname,
debitors.Lname as dlname,
user_details.Fname as cfname,
user_details.Lname as clname
FROM
invoice_payments
INNER JOIN credit_invoice ON invoice_payments.Credit_Invoice_idCredit_Invoice = credit_invoice.idCredit_Invoice
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
INNER JOIN `user` ON invoice_payments.User_idUser = `user`.idUser
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details
WHERE debitors.Fname like '$dname%' 
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
                                                        $paginationDisplay .= '<span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                    <a href="javascript:void();" onclick="LoadPage(' . $previous . ')">Prev</a></span>';
                                                    }
                                                    // Lay in the clickable numbers display here between the Back and Next links
                                                    $paginationDisplay .= $centerPages;
                                                    // If we are not on the very last page we can place the Next button
                                                    if ($pn != $lastPage) {
                                                        $nextPage = $pn + 1;
                                                        $paginationDisplay .= '<span class="jsgrid-pager-nav-button"><a href="javascript:void();" onclick="LoadPage(' . $nextPage . ')">Next</a></span>';
                                                    }
                                                }
////////////////////////////////////////////////////////////////////////////////
                                                $outputList = '';
                                                ?>
                                                <table class="jsgrid-table table table-striped table-hover">
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysqli_fetch_array($sql2)) {
                                                            ?>
                                                            <tr class="jsgrid-row">
                                                                <td class="jsgrid-cell" style="width: 150px;"><?php echo $row['dfname'] . " " . $row['dlname']; ?></td>
                                                                <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;"><?php echo $row['DateTime'] ?></td>
                                                                <td class="jsgrid-cell" style="width: 70px;"><?php echo $row['Amount'] ?></td>
                                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 70px;"><?php echo $row['AdditionalAmount'] ?></td>
                                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 150px;"><?php echo $row['cfname'] . " " . $row['clname']; ?></td>
                                                            <?php } ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="jsgrid-pager-container" style="">

                                                <?php echo $paginationDisplay; ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="jsgrid-load-shader" style="display: none; position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; z-index: 1000;"></div><div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div>                          
                                </div>
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

    <!-- All Jquery -->
    <!-- ============================================================== -->

</body>


<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->

<script>
    function LoadPage(pn) {
        document.getElementById("preloader").style.opacity = "0.3";
        document.getElementById("preloader").style.display = "block";
        
      var dname =  document.getElementById("dname").value;
      var cname =  document.getElementById("collector").value;
      var date =  document.getElementById("date").value;


        var dataString = 'pn=' + pn + '&dname=' + dname+'&cname='+cname+'&date='+date;

        $.ajax({
            type: "POST",
            url: "web/CollectedAmountReportAjax_Pagination.php",
            data: dataString,
            cache: false,
            success: function (data) {
                document.getElementById("preloader").style.display = "none";
                document.getElementById('table').innerHTML = data;

            }
        });

    }

</script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>


</html>