<?php include '../classes/dbcon.php'; ?>

<div class="jsgrid-grid-body" style="height: 325px;">
    <?php
    $dname = $_POST['dname'];
    $cname = $_POST['cname'];
    $date = $_POST['date'];
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
WHERE debitors.Fname like '$dname%' AND user_details.Fname like '$cname%' AND invoice_payments.DateTime like '$date%'
");
//////////////////////////////////// Adam's Pagination Logic ////////////////////////////////////////////////////////////////////////
    $nr = mysqli_num_rows($sql); // Get total of Num rows from the database query
    if (isset($_POST['pn'])) { // Get pn from URL vars if it is present
        $pn = preg_replace('#[^0-9]#i', '', $_POST['pn']); // filter everything but numbers for security(new)
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
WHERE debitors.Fname like '$dname%' AND user_details.Fname like '$cname%' AND invoice_payments.DateTime like '$date%'
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

