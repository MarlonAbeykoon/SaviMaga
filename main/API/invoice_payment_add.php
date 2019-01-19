<?php

include_once '../classes/DBConnection.php';

require_once '../classes/Credit_Invoice.php';

include '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
  $userid = $_POST['uid'];

    $dailyPay = $_POST['dailyPay'];

    $payFor = $_POST['payFor'];

    $addAmount = $_POST['addAmount'];

    $paidAmount = $_POST['paidAmount'];

    $cid = $_POST['cid'];



    $subtot = 0;

//    $totalAmount = $subtot + $addAmount;



    /////////// validate/////////////



    $sql = mysqli_query($con, "SELECT * FROM credit_invoice WHERE credit_invoice.idCredit_Invoice = '$cid'");

    while ($results = mysqli_fetch_array($sql)) {

        $dailyPay = $results['DailyEqualPayment'];

        $TotalAmount = $results['TotalAmount'];

        $oldPaidAmount = $results['PaidAmount'];

        

        if($payFor != 0){

        $subtot = $dailyPay * $payFor;

        }else{

            $subtot = ($TotalAmount -$oldPaidAmount);

        }

    }





    ////////// validate ////////////







    $credit = new Credit_Invoice();

    $res = $credit->addnewPayment($cid, $subtot, $addAmount, $payFor, $userid);



    if ($res) {

        $res2 = $credit->updateCreditInvoice($cid, $subtot, $addAmount);
   

    $respose["error"] = FALSE;
    

    $respose["payement_de"] = "Succes";

    echo json_encode($respose);
  //  return "true";
}else{

    $respose["error"] = TRUE;
    $respose["error_msg"] = "request faile";
   // return "false";
   echo json_encode($respose);

}

mysqli_close($con);

    

}




?>