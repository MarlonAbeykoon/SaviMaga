<?php
date_default_timezone_set("Asia/Colombo");
include '../classes/dbcon.php';

$cid = $_POST['cid'];

$sql = mysqli_query($con, "SELECT *
FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $cid Order by invoice_payments.DateTime Desc limit 1");

while ($results = mysqli_fetch_array($sql)) {
    $lastDate = $results['DateTime'];
   $lastDateOnly = explode(" ",$lastDate);
    $today = date("Y-m-d");

$datetime1 = date_create($lastDateOnly[0]);
$datetime2 = date_create($today);
$interval = date_diff($datetime1, $datetime2);
//echo $interval->format('%R%a days');
 $diff = $interval->format('%a');
if($diff>1){
    echo "One Or More Payments Didn't Make On time. Please Check Payment History.";
}
    
}