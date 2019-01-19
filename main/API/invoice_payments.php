<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
    
       

$query ="SELECT * FROM `invoice_payments` ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();
    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
        /* $respose["idInvoice_Payments"]= $row['idInvoice_Payments'];
        $respose["Amount"]= $row['Amount'];
        $respose["AdditionalAmount"]= $row['AdditionalAmount'];
        $respose["DateTime"]= $row['DateTime'];
        $respose["Credit_Invoice_idCredit_Invoice"]= $row['Credit_Invoice_idCredit_Invoice'];
        $respose["user_idUser"]= $row['user_idUser'];
        $respose["Status"]= $row['Status']; */
    
        array_push($resuits, [
       
            
            'idInvoice_Payments'=> $row['idInvoice_Payments'],
            'Amount'=> $row['Amount'],
            'AdditionalAmount'=> $row['AdditionalAmount'],
            'DateTime'=> $row['DateTime'],
	    'PayFor'=> $row['PayFor'],
            'Credit_Invoice_idCredit_Invoice'=> $row['Credit_Invoice_idCredit_Invoice'],
            'user_idUser'=> $row['User_idUser'],
            'Status'=> $row['Status']
          ]);
    }

    $respose["invoice_de"] = $resuits;

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