<?php



include_once '../classes/DBConnection.php';

include_once '../classes/Credit_Invoice.php';

include_once '../classes/debitor_control.php';

include_once '../classes/guarantor_control.php';





session_start();



/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

try {

    $user_de = $_SESSION['user_de'];



    $applicantid = $_POST['extApplicant'];

    $grantAmount = $_POST['amount'];

    $InterestRate = $_POST['rate'];

    $days = $_POST['days'];

    $area = $_POST['area'];



    $g1fname = $_POST['g1fname'];

    $g1lname = $_POST['g1lname'];

    $g1phone1 = $_POST['g1phone1'];

    $g1phone2 = $_POST['g1phone2'];

    $g1address1 = $_POST['g1address1'];

    $g1address2 = $_POST['g1address2'];

    $g1nic = $_POST['g1nic'];



    $g2fname = $_POST['g2fname'];

    $g2lname = $_POST['g2lname'];

    $g2phone1 = $_POST['g2phone1'];

    $g2phone2 = $_POST['g2phone2'];

    $g2address1 = $_POST['g2address1'];

    $g2address2 = $_POST['g2address2'];

    $g2nic = $_POST['g2nic'];

    $loan_type = $_POST['loan_type'];


    $credit = new Credit_Invoice();


$query= "SELECT * FROM `credit_invoice` WHERE `Debitors_idDebitors` ='$applicantid' and `Settled` ='0' and `Status` = '1'";

$have_loan = $credit -> getValue_rowcount($query);

if($have_loan > 0){

    header('Location:../CreditInvoice.php?msg=have_fail');
}else{



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

            

            

            $res = $credit->addCrediInvoice(bcadd(0, $totalAmount, 2), $grantAmount, $InterestRate, bcadd(0, $dailypay, 2), $days, 0, 0, $id, $area, $user_de, $loan_type);



            if ($res > 0) {

                $gurantor = new guarantor_function();

                $g1 = $gurantor->guarantor_reg($g1fname, $g1lname, $g1phone1, $g1phone2, $g1address1, $g1address2, $g1nic, $res);

                $g2 = $gurantor->guarantor_reg($g2fname, $g2lname, $g2phone1, $g2phone2, $g2address1, $g2address2, $g2nic, $res);

                if ($g1 > 0 && $g2 > 0) {

                    header('Location:../CreditInvoice.php?msg=success');

                }

            } else {

                header('Location:../CreditInvoice.php?msg=fail');

            }

        }

    } else {



        

        $res = $credit->addCrediInvoice(bcadd(0, $totalAmount, 2), $grantAmount, $InterestRate, bcadd(0, $dailypay, 2), $days, 0, 0, $applicantid, $area, $user_de, $loan_type);



        if ($res > 0) {

            $gurantor = new guarantor_function();

            $g1 = $gurantor->guarantor_reg($g1fname, $g1lname, $g1phone1, $g1phone2, $g1address1, $g1address2, $g1nic, $res);

            $g2 = $gurantor->guarantor_reg($g2fname, $g2lname, $g2phone1, $g2phone2, $g2address1, $g2address2, $g2nic, $res);

            if ($g1 > 0 && $g2 > 0) {

                header('Location:../CreditInvoice.php?msg=success');

            }

        } else {

            header('Location:../CreditInvoice.php?msg=fail');

        }

    }
}
//echo $res;

} catch (Exception $e) {

    echo 'Message: ' . $e->getMessage();

}

