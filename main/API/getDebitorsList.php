<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['cid'])){
  
    
 $cid = $_POST['cid'];

$sql = mysqli_query($con, "SELECT
collection_area_user.CollectionArea_idCollectionArea,
credit_invoice.TotalAmount,
credit_invoice.GrantAmount,
credit_invoice.idCredit_Invoice,
debitors.Fname,
debitors.Address1,
debitors.Address2
FROM
credit_invoice
INNER JOIN collection_area_user ON credit_invoice.CollectionArea_idCollectionArea = collection_area_user.CollectionArea_idCollectionArea
INNER JOIN debitors ON credit_invoice.Debitors_idDebitors = debitors.idDebitors
WHERE
collection_area_user.User_idUser = $cid AND
credit_invoice.Settled = 0 AND
credit_invoice.`Status` = 1
ORDER BY
credit_invoice.Debitors_idDebitors ASC");

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();

    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
      //  $respose["idCollectionArea"]= $row['idCollectionArea'];
       // $respose["CollectionArea"]= $row['CollectionArea'];

     

       array_push($resuits, [
        $row['idCollectionArea'],
        $row['CollectionArea']


        /* 'id'   => $row['idCollectionArea'],
        'Area' => $row['CollectionArea'] */
      ]);
       
    }
    $respose["idCollectionArea"] = $resuits;
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