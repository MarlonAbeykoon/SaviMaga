<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
  $Amount = $_POST['Amount'];
  $Details = $_POST['Details']; 
  $Date = $_POST['Date']; 
  $user_idUser = $_POST['user_idUser']; 
   
       

 $query ="INSERT INTO CollectorExpenses (`Amount`,`Details`,`Date`,`Status`,`user_idUser`) VALUES ('$Amount', '$Details', '$Date','1','$user_idUser')";

$query_ex= mysqli_query($con,$query);

if($query_ex){

   

    $respose["error"] = FALSE;
    

    $respose["exprences_add"] = "Succes";

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