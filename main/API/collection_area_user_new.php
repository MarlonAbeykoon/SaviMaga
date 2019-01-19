<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
    
       

$query ="SELECT * FROM `collection_area_user`c LEFT JOIN `user` u ON c.`User_idUser`= u.`idUser` WHERE u.`Status` ='1'  ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();
    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
       /*  $respose["idCollection_Area_User"]= $row['idCollection_Area_User'];
        $respose["CollectionArea_idCollectionArea"]= $row['CollectionArea_idCollectionArea'];
        $respose["User_idUser"]= $row['User_idUser'];
 */
        array_push($resuits, [
       
            
            'idCollection_Area_User'=> $row['idCollection_Area_User'],
            'CollectionArea_idCollectionArea'=> $row['CollectionArea_idCollectionArea'],
            'User_idUser'=> $row['User_idUser']
          ]);
    }

    $respose["area_user_de"] = $resuits;
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