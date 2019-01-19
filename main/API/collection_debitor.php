<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['area_id'])){
  
    
        $area_id = $_POST['area_id'];
        

$query ="SELECT d.`Fname`,d.`Lname`, i.`idCredit_Invoice` FROM `credit_invoice` i JOIN `debitors` d ON i.`Debitors_idDebitors` = d.`idDebitors` WHERE i.`CollectionArea_idCollectionArea` = '$area_id' AND i.`Status` ='1' And i.`Settled`='0' ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();

    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
      

       array_push($resuits, [
       

         
        'id' => $row['idCredit_Invoice'], 
        'debetor'   => $row['Fname']." ".$row['Lname']
      ]);
       
    }
    $respose["error_msg"] = "now errors";
    $respose["get_debetor"] = $resuits;
    echo json_encode($respose);
  //  return "true";
}else{

    $respose["error"] = TRUE;
    $respose["error_msg"] = $area_id;
   // return "false";
   echo json_encode($respose);

}

mysqli_close($con);

    

}




?>