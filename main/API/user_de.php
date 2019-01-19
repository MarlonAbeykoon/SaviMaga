<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
    
       

$query ="SELECT * FROM `user` WHERE `Status` ='1' ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();
    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 

        array_push($resuits, [
       
            

            'idUser'=> $row['idUser'],
            'Uname'=> $row['Uname'],
            'Pass' => $row['Pass'],
            'User_Type_idUser_Type'=> $row['User_Type_idUser_Type'],
            'User_Details_idUser_Details'=> $row['User_Details_idUser_Details'],
            'Status'=> $row['Status']
          ]);
       
    }
    $respose["user_de"] = $resuits;
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