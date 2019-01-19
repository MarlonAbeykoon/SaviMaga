<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
    
       

$query ="SELECT * FROM `credit_invoice` WHERE `Status` ='1' ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();
    $respose["error"] = FALSE;

    while($row=mysqli_fetch_array($query_ex)){ 
        /* $respose["idCredit_Invoice"]= $row['idCredit_Invoice'];
        $respose["TotalAmount"]= $row['TotalAmount'];
        $respose["GrantAmount"]= $row['GrantAmount'];
        $respose["InterestRate"]= $row['InterestRate'];
        $respose["DailyEqualPayment"]= $row['DailyEqualPayment'];
        $respose["Days"]= $row['Days'];
        $respose["PaidAmount"]= $row['PaidAmount'];
        $respose["Settled"]= $row['Settled'];
        $respose["DateTime"]= $row['DateTime'];
        $respose["Debitors_idDebitors"]= $row['Debitors_idDebitors'];
        $respose["CollectionArea_idCollectionArea"]= $row['CollectionArea_idCollectionArea'];
        $respose["user_idUser"]= $row['user_idUser'];
        $respose["Status"]= $row['Status']; */

      array_push($resuits, [
       
            
            'idCredit_Invoice'=> $row['idCredit_Invoice'],
            'TotalAmount'=> $row['TotalAmount'],
            'GrantAmount'=> $row['GrantAmount'],
            'InterestRate'=> $row['InterestRate'],
            'DailyEqualPayment'=> $row['DailyEqualPayment'],
            'Days'=> $row['Days'],
            'PaidAmount'=> $row['PaidAmount'],
            'PenaltyPaid'=> $row['PenaltyPaid'],
            'Settled'=> $row['Settled'],
            'DateTime'=> $row['DateTime'],
            'Debitors_idDebitors'=> $row['Debitors_idDebitors'],
            'CollectionArea_idCollectionArea'=> $row['CollectionArea_idCollectionArea'],
            'user_idUser'=> $row['user_idUser'],
            'Status'=> $row['Status']
            
          ]);
    }

    $respose["crdit_de"] = $resuits;
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