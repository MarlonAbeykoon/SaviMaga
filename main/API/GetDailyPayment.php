<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE);

$cid = $_POST['cid'];

$LastPayment;
if ($cid > 0) {


    $sql = mysqli_query($con, "SELECT
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
credit_invoice.PenaltyPaid,
debitors.Fname,
debitors.Address1,
debitors.Address2,
credit_invoice.idCredit_Invoice,
credit_invoice.DailyEqualPayment,
credit_invoice.PaidAmount,
credit_invoice.InterestRate,
credit_invoice.Days,
debitors.NIC,
debitors.Lname
FROM
credit_invoice
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
WHERE
credit_invoice.Settled = 0 AND
credit_invoice.`Status` = 1 AND
credit_invoice.idCredit_Invoice = $cid
");

if(mysqli_num_rows($sql) > 0){

    while ($results = mysqli_fetch_array($sql)) {

        $sql2 = mysqli_query($con, "SELECT * FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $cid
Order by invoice_payments.DateTime Desc limit 1
");
        $diff;
        while ($result = mysqli_fetch_array($sql2)) {
            $LastPayment = $result['DateTime'];
            $lastDateOnly = explode(" ", $LastPayment);
            $today = date("Y-m-d");
            $datetime1 = date_create($lastDateOnly[0]);
            $datetime2 = date_create($today);
            $interval = date_diff($datetime1, $datetime2);
//echo $interval->format('%R%a days');
            $diff = $interval->format('%a');
        }
//        if ($diff > 1) {
//            
//        }
        $dailyPayment = $results['DailyEqualPayment'];
    }
    //if ($res) {
        $respose["amount"] = $dailyPayment;
        $respose["lastDate"] = $LastPayment;
        $respose["dateDiff"] = $diff;
        $respose["error_msg"] = "now errors";
// return "false";
        echo json_encode($respose);
   // }

//echo $res;
 
    mysqli_close($con);

}else{

    $respose["error"] = TRUE;
    $respose["error_msg"] = "no result";
    // return "false";
    echo json_encode($respose);

}
}else{ 
    $respose["error"] = TRUE;
    $respose["error_msg"] = $cid;
    // return "false";
    echo json_encode($respose);
}
?>