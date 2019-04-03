<?php

//include './DBConnection.php';



class debitor_function {

    private $con = '';

    public function __construct() {

        $dbcon1 = new dbcon();

        $this->con = $dbcon1->dbcon_function();
    }

    function debitor_reg($nic, $fname, $lname, $address1, $address2, $pno1, $pno2, $email,$dob) {

        $sql = "INSERT INTO debitors (`Fname`,`Lname`,`Address1`,`Address2`,`Pno1`,`Pno2`,`Email`,`Status`,`NIC`,`birth_day`) VALUES ('$fname', '$lname', '$address1','$address2','$pno1','$pno2','$email', '1','$nic','$dob')";


        if (mysqli_query($this->con, $sql)) {
            
            $last_id = $this->con->insert_id;

            return $last_id;
            
        } else {
            return "false";
        }
    }

    function debitor_update($id, $nic, $fname, $lname, $address1, $address2, $pno1, $pno2, $email,$dob) {



        $sql = "UPDATE debitors SET Fname ='$fname',Lname = '$lname',Address1='$address1',Address2='$address2',Pno1 = '$pno1',Pno2 = '$pno2',Email = '$email', NIC ='$nic',birth_day ='$dob', WHERE idDebitors = '$id'";



        if (mysqli_query($this->con, $sql)) {

            return "true";
        } else {

            //echo 'error:' . mysqli_error($con);

            return "false";
        }
    }

    function debitor_change_status($id, $status) {



        $sql = "UPDATE debitors SET Status ='$status' WHERE idDebitors = '$id'";



        if (mysqli_query($this->con, $sql)) {

            return "true";
        } else {

            // echo 'error:' . mysqli_error($con);

            return "false";
        }
    }

}

?>