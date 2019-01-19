<?php

//include './DBConnection.php';
date_default_timezone_set("Asia/Colombo");

class expenses_function {

    private $con = '';

    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();
    }

    function new_expenses($details, $amount, $user_idUser) {

        $Date = date("Y-m-d");

        $sql = "INSERT INTO CollectorExpenses (`Amount`,`Details`,`Date`,`user_idUser`,`Status`) "
                . "VALUES ('$amount', '$details', '$Date','$user_idUser','1')";



        if (mysqli_query($this->con, $sql)) {
            return true;
        } else {

//             return 'error:' . mysqli_error($this->con);

            return false;
        }
    }

    function update_expenses($id, $status) {



        $sql = "UPDATE CollectorExpenses SET Status ='$status' WHERE idCollectorExpenses = '$id'";



        if (mysqli_query($this->con, $sql)) {

            return true;
        } else {

            //echo 'error:' . mysqli_error($con);

            return false;
        }
    }

//    function debitor_change_status($id, $status) {
//
//
//
//        $sql = "UPDATE debitors SET Status ='$status' WHERE idDebitors = '$id'";
//
//
//
//        if (mysqli_query($this->con, $sql)) {
//
//            return "true";
//        } else {
//
//            // echo 'error:' . mysqli_error($con);
//
//            return "false";
//        }
//    }
}

?>