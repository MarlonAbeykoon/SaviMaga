<?php



include 'DBConnection.php';
session_start();


class login_function {



    private $con = '';



    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();

    }


function login($uname,$pass){


$query ="SELECT `idUser` FROM `user` WHERE `Uname`='$uname' AND `Pass`='$pass' AND `Status`='1' ";

$query_ex= mysqli_query($this->con,$query);

if(mysqli_num_rows($query_ex) > 0){

    while($row=mysqli_fetch_array($query_ex)){ 
        $_SESSION['user_de']= $row['idUser'];
    }
    return "true";
}else{

    return "false";

}

mysqli_close($this->con);
}
    


}



?>