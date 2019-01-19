<?php

//include_once '../classes/dbcon.php';


include_once '../classes/DBConnection.php';

include_once '../classes/Credit_Invoice.php';

include_once '../classes/debitor_control.php';

include_once '../classes/guarantor_control.php';




/* require_once '../classes/user_cotrol.php';
$uc = new user_function(); */
session_start();
//echo "ok";

$credit = new Credit_Invoice();
$gurantor = new guarantor_function();

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
  $TotalAmount = $_POST['TotalAmount'];
  $GrantAmount = $_POST['GrantAmount']; 
  
  $InterestRate = $_POST['InterestRate']; 
  $DailyEqualPayment = $_POST['DailyEqualPayment']; 
  $days = $_POST['Days'];
  
  $id = $_POST['idDebitors'];   
  $idArea = $_POST['idArea'];  
  $idUser = $_POST['idUser'];   

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



            $res = $credit->addCrediInvoice(bcadd(0, $TotalAmount, 2), $GrantAmount, $InterestRate, bcadd(0, $DailyEqualPayment, 2), $days, 0, 0, $id, $idArea, $idUser);



            if ($res > 0) {

                $gurantor = new guarantor_function();

                $g1 = $gurantor->guarantor_reg($g1fname, $g1lname, $g1phone1, $g1phone2, $g1address1, $g1address2, $g1nic, $res);

                $g2 = $gurantor->guarantor_reg($g2fname, $g2lname, $g2phone1, $g2phone2, $g2address1, $g2address2, $g2nic, $res);

                if ($g1 > 0 && $g2 > 0) {

   

    $respose["error"] = FALSE;
    

    $respose["loan_de"] = "Succes";

    echo json_encode($respose);
  //  return "true";
                }else{

                  $respose["error"] = TRUE;
                  $respose["error_msg"] = "gurantor request faile";
                 // return "false";
                 echo json_encode($respose);
              
              }

}else{

    $respose["error"] = TRUE;
    $respose["error_msg"] = "request faile";
   // return "false";
   echo json_encode($respose);

}

mysqli_close($con);

    

}




?>