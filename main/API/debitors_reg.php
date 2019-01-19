<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
  $nic = $_POST['nic'];
  $fname = $_POST['fname']; 
  $lname = $_POST['lname']; 
  $address1 = $_POST['address1']; 
  $address2 = $_POST['address2']; 
  $pno1 = $_POST['pno1'];
  $pno2 = $_POST['pno2'];
  $email = $_POST['email'];    
       

 $query ="INSERT INTO debitors (`Fname`,`Lname`,`Address1`,`Address2`,`Pno1`,`Pno2`,`Email`,`Status`,`NIC`) VALUES ('$fname', '$lname', '$address1','$address2','$pno1','$pno2','$email', '1','$nic')";

$query_ex= mysqli_query($con,$query);

if($query_ex){

   

    $respose["error"] = FALSE;
    

    $respose["debitors_de"] = "Succes";

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