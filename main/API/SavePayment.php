<?php

include_once '../classes/DBConnection.php';
require_once '../classes/Credit_Invoice.php';

$respose = array("error" => FALSE);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
    $userid = $_POST['uid'];
    $dailyPay = $_POST['dailyPay'];
    $payFor = $_POST['payFor'];
    $addAmount = $_POST['addAmount'];
    $paidAmount = $_POST['paidAmount'];
    $cid = $_POST['cid'];

    $subtot = $dailyPay * $payFor;
    $totalAmount = $subtot + $addAmount;


    $credit = new Credit_Invoice();
    $res = $credit->addnewPayment($cid, $dailyPay, $addAmount, $dailyPay, $userid);

    if ($res) {
        $res2 = $credit->updateCreditInvoice($cid, $dailyPay, $addAmount);
        echo $res2;
        if ($res2) {
            $respose["error"] = FALSE;
            $respose["error_msg"] = $uid;
            // return "false";
            echo json_encode($respose);
        }

//        header('Location:../MakePayment.php?msg=success');
    } else {
        $respose["error"] = TRUE;
        $respose["error_msg"] = $uid;
        // return "false";
        echo json_encode($respose);
//        header('Location:../MakePayment.php?msg=fail');
    }

//    echo $res;
} catch (Exception $e) {
//    echo 'Message: ' . $e->getMessage();
    $respose["error"] = TRUE;
    $respose["error_msg"] = $uid;
    // return "false";
    echo json_encode($respose);
}
