<?php

include '../classes/dbcon.php';
date_default_timezone_set("Asia/Colombo");

$cid = $_POST['cid'];
$today = date("Y-m-d");

if (isset($_POST['cid'])) {
    $sql = mysqli_query($con, "SELECT
invoice_payments.idInvoice_Payments,
sum(invoice_payments.Amount) as Amount,
sum(invoice_payments.AdditionalAmount) as addAmount
FROM
invoice_payments
WHERE
invoice_payments.User_idUser = $cid AND
invoice_payments.DateTime like '$today%'");
} else {
    $sql = mysqli_query($con, "SELECT
invoice_payments.idInvoice_Payments,
sum(invoice_payments.Amount) as Amount,
sum(invoice_payments.AdditionalAmount) as addAmount
FROM
invoice_payments
WHERE
invoice_payments.DateTime like '$today%'");
}
$count = 1;

while ($result = mysqli_fetch_array($sql)) {
    $totAmount = $result['Amount'] + $result['addAmount'];
    echo $totAmount;
}
