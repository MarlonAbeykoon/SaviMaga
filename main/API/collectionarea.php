<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
    
       

$query ="SELECT * FROM `collectionarea` WHERE `Status` ='1' ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){
    $resuits=array();
    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
        /* $respose["idCollectionArea"]= $row['idCollectionArea'];
        $respose["CollectionArea"]= $row['CollectionArea'];
        $respose["Status"]= $row['Status']; */
        array_push($resuits, [
       
            
            'idCollectionArea'=> $row['idCollectionArea'],
            'CollectionArea'=> $row['CollectionArea'],
            'Status'=> $row['Status']
          ]);
    }

    $respose["area_de"] = $resuits;
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