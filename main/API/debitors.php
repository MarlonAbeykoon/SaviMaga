<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['token'])){
  
    
       

$query ="SELECT * FROM `debitors` WHERE `Status` ='1' ";

$query_ex= mysqli_query($con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $resuits=array();

    $respose["error"] = FALSE;
    while($row=mysqli_fetch_array($query_ex)){ 
       /*  $respose["idDebitors"]= $row['idDebitors'];
        $respose["NIC"]= $row['NIC'];
        $respose["Fname"]= $row['Fname'];
        $respose["Lname"]= $row['Lname'];
        $respose["Address1"]= $row['Address1'];
        $respose["Address2"]= $row['Address2'];
        $respose["Pno1"]= $row['Pno1'];
        $respose["Pno2"]= $row['Pno2'];
        $respose["Email"]= $row['Email'];
        $respose["Status"]= $row['Status']; */
    
        
        array_push($resuits, [
       
            'idDebitors'=> $row['idDebitors'],
            'NIC'=> $row['NIC'],
            'idCollectionArea'=> $row['idCollectionArea'],
            'Fname'=> $row['Fname'],
            'Lname'=> $row['Lname'],
            'Address1'=> $row['Address1'],
            'Address2'=> $row['Address2'],
            'Pno1'=> $row['Pno1'],
            'Pno2'=> $row['Pno2'],
            /* 'Email'=> $row['Email'], */
            'Status'=> $row['Status']
          ]);
    }

    $respose["debitors_de"] = $resuits;

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