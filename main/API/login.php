<?php

include_once '../classes/dbcon.php';

$respose = array("error" => FALSE );



if(isset($_POST['uname']) && $_POST['pass']){


    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $query ="SELECT `idUser` FROM `user` WHERE `Uname`='$uname' AND `Pass`='$pass' AND `Status`='1' ";

    $query_ex= mysqli_query($con,$query);

    if(mysqli_num_rows($query_ex) > 0){

        $respose["error"] = FALSE;
        while($row=mysqli_fetch_array($query_ex)){
            $respose["idUser"]= $row['idUser'];
        }
        echo json_encode($respose);
        //  return "true";
    }else{

        $respose["error"] = TRUE;
        $respose["error_msg"] = "Login failed.";
        // return "false";
        echo json_encode($respose);

    }

    mysqli_close($con);



}




?>