<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE);


$cid = $_POST['cid'];

$sql = mysqli_query($con, "SELECT *
FROM
invoice_payments
WHERE
invoice_payments.Credit_Invoice_idCredit_Invoice = $cid Order by invoice_payments.DateTime Desc");


$results = array();
$respose["error"] = FALSE;
if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_array($sql)) {

        array_push($results, [
            $row['DateTime'],
            $row['Amount'],
            $row['AdditionalAmount']]);
    }
}
?>