<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['uid'])){
  
    
        $uid = $_POST['uid'];
        

$query ="SELECT c.`idCollectionArea`, c.`CollectionArea` FROM `collection_area_user` u JOIN `collectionarea` c ON u.`CollectionArea_idCollectionArea` = c.`idCollectionArea` WHERE u.`User_idUser` = '$uid' ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();

    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
      //  $respose["idCollectionArea"]= $row['idCollectionArea'];
       // $respose["CollectionArea"]= $row['CollectionArea'];

     

       array_push($resuits, [
       /*  $row['idCollectionArea'],
        $row['CollectionArea']
 */

         'id'   => $row['idCollectionArea'],
        'Area' => $row['CollectionArea'] 
      ]);
       
    }
    $respose["Area"] = $resuits;
    echo json_encode($respose);
  //  return "true";
}else{

    $respose["error"] = TRUE;
    $respose["error_msg"] = $uid;
   // return "false";
   echo json_encode($respose);

}

mysqli_close($con);

    

}




?>