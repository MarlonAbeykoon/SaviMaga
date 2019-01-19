<?php
date_default_timezone_set("Asia/Colombo");
include '../classes/dbcon.php';

$cid = $_POST['cid'];
$fdate = $_POST['fdate'];
$tdate = $_POST['tdate'];

$query = "SELECT
CollectorExpenses.idCollectorExpenses,
user_details.Fname,
user_details.Lname,
CollectorExpenses.Date,
CollectorExpenses.Details,
CollectorExpenses.Amount
FROM
CollectorExpenses
INNER JOIN `user` ON CollectorExpenses.user_idUser = `user`.idUser
INNER JOIN user_details ON `user`.User_Details_idUser_Details = user_details.idUser_Details 
WHERE CollectorExpenses.Date BETWEEN '$fdate' AND '$tdate' AND CollectorExpenses.Status = 1";

if ($cid != "" && $cid != null && $cid != 0) {
    $query = $query . " AND CollectorExpenses.user_idUser = $cid";
}

$query = $query . " ORDER BY CollectorExpenses.idCollectorExpenses DESC";
//////////////  QUERY THE MEMBER DATA INITIALLY LIKE YOU NORMALLY WOULD
//echo $query;
$sql = mysqli_query($con, $query);
//////////////////////////////////// Adam's Pagination Logic ////////////////////////////////////////////////////////////////////////
$nr = mysqli_num_rows($sql); // Get total of Num rows from the database query
if (isset($_POST['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_POST['pn']); // filter everything but numbers for security(new)
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
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $add1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add1 . '</a>';
} else if ($pn == $lastPage) {
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $sub1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub1 . '</a>';
    $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $sub2 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub2 . '</a>';
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $sub1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub1 . '</a>';
    $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $add1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add1 . '</a>';
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $add2 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add2 . '</a>';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $sub1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $sub1 . '</a>';
    $centerPages .= '<a class="paginate_button current" aria-controls="table1" data-dt-idx="1" tabindex="0">' . $pn . '</a>';
    $centerPages .= '<a href="javascript:void(0);" onclick="LoadPage2(' . $add1 . ')" class="paginate_button " aria-controls="table1" data-dt-idx="2" tabindex="0" >' . $add1 . '</a>';
}
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
$limit = 'LIMIT ' . ($pn - 1) * $itemsPerPage . ',' . $itemsPerPage;
// Now we are going to run the same query as above but this time add $limit onto the end of the SQL syntax
// $sql2 is what we will use to fuel our while loop statement below
$sql2 = mysqli_query($con, "$query
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
        $paginationDisplay .= '<span><a href="javascript:void();" onclick="LoadPage2(' . $previous . ')" class="paginate_button previous" aria-controls="table1" data-dt-idx="0" tabindex="0" id="table1_previous">Previous</a>';
    }
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= $centerPages;
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .= '</span><a href="javascript:void();" onclick="LoadPage2(' . $nextPage . ')" class="paginate_button next" aria-controls="table1" data-dt-idx="7" tabindex="0" id="example23_next">Next</a>';
    }
}
////////////////////////////////////////////////////////////////////////////////
$outputList = '';
?>


<div id="table1" class="dataTables_wrapper"><table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 362px;">Date</th>
                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 516px;">Collector</th>
                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 269px;">Amount</th>
                <th class="sorting" tabindex="0" aria-controls="example23" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 269px;">Description</th>
        </thead>
<!--        <tfoot>
            <tr><th rowspan="1" colspan="1">Date</th><th rowspan="1" colspan="1">Collector</th><th rowspan="1" colspan="1">Amount</th><th rowspan="1" colspan="1">Description</th></tr>
        </tfoot>-->
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($sql2)) {
                ?>
                <tr role="row" class="odd">
                    <td><?php echo $row['Date'] ?></td>  
                    <td><?php echo $row['Fname'] . " " . $row['Lname'] ?></td>  
                    <td><?php echo $row['Amount'] ?></td>  
                    <td><?php echo $row['Details'] ?></td>  
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!--<div class="dataTables_info" id="example23_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>-->
    <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
        <?php echo $paginationDisplay; ?>
    </div>
    
</div>


