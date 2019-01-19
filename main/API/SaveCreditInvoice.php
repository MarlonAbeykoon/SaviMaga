<?php

include_once '../classes/dbcon.php';
include_once '../classes/DBConnection.php';
include_once '../classes/Credit_Invoice.php';
include_once '../classes/debitor_control.php';

$respose = array("error" => FALSE);


if (isset($_POST['uid'])) {

    $uid = $_POST['uid'];

    try {
        $applicantid = $_POST['extApplicant'];
        $grantAmount = $_POST['amount'];
        $InterestRate = $_POST['rate'];
        $days = $_POST['days'];
        $area = $_POST['area'];

        $interest = ((($grantAmount * $InterestRate) / 100) / 30) * $days;
        $totalAmount = $grantAmount + $interest;
        $dailypay = ($grantAmount + $interest) / $days;

        echo bcadd(0, $dailypay, 2);
        if ($applicantid == "") {


            $fname = $_POST['firstName'];
            $lname = $_POST['lastName'];
            $nic = $_POST['nic'];
            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            $email = $_POST['email'];
            $address1 = $_POST['address1'];
            $address2 = $_POST['address2'];

            $debitor = new debitor_function();
            $id = $debitor->debitor_reg($nic, $fname, $lname, $address1, $address2, $phone1, $phone2, $email);
            echo $id;
            if ($id > 0) {
                $credit = new Credit_Invoice();
                $res = $credit->addCrediInvoice(bcadd(0, $totalAmount, 2), $grantAmount, $InterestRate, bcadd(0, $dailypay, 2), $days, 0, 0, $id, $area, $uid);

                if ($res) {
                    $respose["error"] = FALSE;
                    $respose["error_msg"] = $uid;
                    // return "false";
                    echo json_encode($respose);
                } else {
                    $respose["error"] = TRUE;
                    $respose["error_msg"] = $uid;
                    // return "false";
                    echo json_encode($respose);
                }
            }
        } else {

            $credit = new Credit_Invoice();
            $res = $credit->addCrediInvoice(bcadd(0, $totalAmount, 2), $grantAmount, $InterestRate, bcadd(0, $dailypay, 2), $days, 0, 0, $applicantid, $area, 6);

            if ($res) {
                $respose["error"] = FALSE;
                $respose["error_msg"] = $uid;
                // return "false";
                echo json_encode($respose);
            } else {
                $respose["error"] = TRUE;
                $respose["error_msg"] = $uid;
                // return "false";
                echo json_encode($respose);
            }
        }
//echo $res;
    } catch (Exception $e) {
        $respose["error"] = TRUE;
        $respose["error_msg"] = $uid;
        // return "false";
        echo json_encode($respose);
    }


    mysqli_close($con);
}
?>