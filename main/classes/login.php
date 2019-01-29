<?php



include 'DBConnection.php';
if(!isset($_SESSION)) {
     session_start();
}


class login_function {



    private $con = '';



    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();

    }


function login($uname,$pass){


 $query ="SELECT u.`idUser`,u.`User_Type_idUser_Type`,u.`debitors_idDebitors`,t.`Type` FROM `user` u join `user_type` t on u.`User_Type_idUser_Type` = t.`idUser_Type` WHERE u.`Uname`='$uname' AND u.`Pass`='$pass' AND u.`Status`='1' ";

$query_ex= mysqli_query($this->con,$query);

if(mysqli_num_rows($query_ex) > 0){

    while($row=mysqli_fetch_array($query_ex)){ 

        if($row['Type']=='customer'){
            $_SESSION['user_de']= $row['debitors_idDebitors'];
           
        }else{
        $_SESSION['user_de']= $row['idUser'];
        
        }

        $_SESSION['user_type']= $row['Type'];

        $succes_result = $row['Type'];
    }

    //echo $succes_result;
    return $succes_result;
}else{

    return "false";

}

mysqli_close($this->con);
}
    

function app_login($uid){


    $query ="SELECT t.`Type` FROM `user` u join `user_type` t on u.`User_Type_idUser_Type` = t.`idUser_Type` WHERE u.`idUser`='$uid' ";

$query_ex= mysqli_query($this->con,$query);

if(mysqli_num_rows($query_ex) > 0){

    $_SESSION['user_de']= $uid;
        

    while($row=mysqli_fetch_array($query_ex)){ 
$_SESSION['user_type']= $row['Type'];

    }


    return "true";

}else{

    return "false";

}


}





}



?>