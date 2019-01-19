<?php

include '../classes/dbcon.php';
date_default_timezone_set("Asia/Colombo");

$cid = $_POST['cid'];
$today = date("Y-m-d");

if (isset($_POST['cid'])) {
    $sql = mysqli_query($con, "SELECT
sum(CollectorExpenses.Amount) as amount
FROM
CollectorExpenses
WHERE
CollectorExpenses.user_idUser = $cid AND
CollectorExpenses.Date = '$today'");
} else {
    $sql = mysqli_query($con, "SELECT
sum(CollectorExpenses.Amount) as amount
FROM
CollectorExpenses
WHERE
CollectorExpenses.Date = '$today'");
}
$count = 1;

while ($result = mysqli_fetch_array($sql)) {
    $totAmount = $result['amount'];
    echo $totAmount;
}
